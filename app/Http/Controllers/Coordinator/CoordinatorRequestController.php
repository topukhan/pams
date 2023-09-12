<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\RequestToCoordinator;
use App\Models\GroupMember;
use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\ProposalFeedback;
use App\Models\OldTitle;
use App\Models\Student;
use App\Models\User;
use App\Notifications\GroupUpdateNotification;
use App\Notifications\ProjectApprovalNotification;
use App\Notifications\SupervisorReallocationNotification;
use App\Notifications\ProposalFeedbackNotification;
use App\Notifications\ProposalPermissionGrantedNotification;
use App\Notifications\RequestedStudentAddedToGroup;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CoordinatorRequestController extends Controller
{
    //Request
    public function requests()
    {
        $requests = RequestToCoordinator::paginate(6);
        foreach ($requests as $request) {
            $request->shortNote = Str::limit($request->note, 25, '...');
        }
        $serialOffset = ($requests->currentPage() - 1) * $requests->perPage();
        return view('frontend.coordinator.request.group.requests', compact('requests', 'serialOffset'));
    }

    public function formedGroupsLists(RequestToCoordinator $request)
    {
        //here $request is request from student to coordinator
        $requestedGroupId = $request->group_id;
        $id = $request->user_id;
        $request_id = $request->id;
        $groups = Group::paginate(7);
        $serialOffset = ($groups->currentPage() - 1) * $groups->perPage();
        return view('frontend.coordinator.request.group.formedGroupsList', compact('groups', 'requestedGroupId', 'id', 'request_id', 'serialOffset'));
    }

    //Request Details
    public function requestDetails(RequestToCoordinator $request)
    {

        return view('frontend.coordinator.request.group.requestDetails', compact('request'));
    }

    // Both individual and group request single/multiple student add to a group
    public function requestedStudentAddToGroup(Request $request)
    {
        $request_id = $request->request_id;
        $group_id = $request->input('group_id');
        $selectedUserIds = $request->input('user_id', []);
        if (!is_array($selectedUserIds)) {
            $selectedUserIds = [$selectedUserIds];
        }


        try {
            // Check if any of the selected users are already in a group
            $userInGroup = GroupMember::whereIn('user_id', $selectedUserIds)->exists();

            if (!$userInGroup) {
                $group = Group::find($group_id);

                if ($group) {
                    DB::beginTransaction();
                    // Insert into the group_members table for each selected user
                    foreach ($selectedUserIds as $user_id) {
                        GroupMember::create([
                            'group_id' => $group_id,
                            'user_id' => $user_id,
                        ]);
                    }
                    if (count($group->groupMembers) >= 3) {
                        $group->update(['can_propose' => 1]);
                    }
                    if (count($selectedUserIds) == 1) {
                        $user = User::where('id', $request->user_id)->first();
                        $user->notify(new  RequestedStudentAddedToGroup($user->id));

                        $groupMemberIds = $group->groupMembers->pluck('user_id')->toArray();
                        foreach ($groupMemberIds as $member_id) {
                            if ($member_id != $user->id) {
                                $member = User::where('id', $member_id)->first();
                                $member->notify(new  RequestedStudentAddedToGroup($user->id, $member->id));
                            }
                        }
                    }
                    if (count($selectedUserIds) > 1) {

                        $added_members = User::whereIn('id', $selectedUserIds)->get();
                        foreach ($added_members as $member) {
                            $member->notify(new  GroupUpdateNotification(true, false, $member->id, false));
                        }

                        $members = GroupMember::where('group_id', $group_id)->pluck('user_id')->toArray();

                        $group_members_without_added = array_diff($members, $added_members->pluck('id')->toArray());
                        $group_members = User::whereIn('id', $group_members_without_added)->get();
                        foreach ($group_members as $member) {
                            $member->notify(new  GroupUpdateNotification(true, false, false, $member->id));
                        }
                    }

                    // Delete the group join request
                    RequestToCoordinator::where('id', $request_id)->delete();

                    DB::commit();

                    return redirect()->route('coordinator.requests')->with('message', 'Students added to the group successfully.');
                } else {
                    DB::rollback();
                    return redirect()->route('coordinator.requests')->with('error', 'Group not found.');
                }
            } else {
                RequestToCoordinator::where('id', $request_id)->delete();
                return redirect()->route('coordinator.requests')->with('error', 'One or more selected students are already in a group.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // Merge Group 
    public function transferGroupMembers(Request $request)
    {
        $requestedGroupId = $request->input('requested_group_id');
        $receiverGroupId = $request->input('receiver_group_id');

        DB::beginTransaction();

        try {
            $requestedGroup = Group::find($requestedGroupId);
            $receiverGroup = Group::find($receiverGroupId);

            if (!$requestedGroup || !$receiverGroup) {
                DB::rollback();
                return redirect()->back()->with('error', 'One or more groups not found.');
            }

            $requestedMembers = GroupMember::where('group_id', $requestedGroup->id)->pluck('user_id')->unique()->toArray();
            $requestedUsers = User::whereIn('id', $requestedMembers)->get();
            //for notify
            $receiverGroupMemberIds = GroupMember::where('group_id', $receiverGroup->id)->pluck('user_id')->unique()->toArray();
            $receiverGroupMembers = User::whereIn('id', $receiverGroupMemberIds)->get();
            //requested users will be notify they are merged with a group
            foreach ($requestedUsers as $member) {
                $member->notify(new  GroupUpdateNotification(false, true, $member->id, false));
            }
            // receiver group members will be notify a group is merged with them 
            foreach ($receiverGroupMembers as $member) {
                $member->notify(new  GroupUpdateNotification(false, true, false, $member->id));
            }
            // Insert transferred members into the group_members table of the receiver group
            foreach ($requestedMembers as $user_id) {
                GroupMember::create([
                    'group_id' => $receiverGroupId,
                    'user_id' => $user_id,
                ]);
            }

            if (count($receiverGroup->groupMembers) >= 4) {
                $receiverGroup->update(['can_propose' => 1]);
            }
            // Delete the requested group and its join request
            $requestedGroup->delete();
            RequestToCoordinator::where('group_id', $requestedGroupId)->delete();
            DB::commit();

            return redirect()->route('coordinator.requests')->with('message', 'Group members transferred successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while transferring group members.');
        }
    }

    //Request Group Details
    public function requestGroupDetails()
    {
        return view('frontend.coordinator.request.group.requestGroupDetails');
    }

    //Request Group Members Details
    public function requestGroupMembersDetails(Group $group, RequestToCoordinator $request)
    {

        $members = GroupMember::where('group_id', $group->id)->pluck('user_id')->unique()->toArray();
        // $members = json_decode($group->members);
        $groupMembers = Student::whereIn('user_id', $members)->get();
        // Available students
        $groupsMembers = GroupMember::pluck('user_id')->flatten()->unique();
        $pendingGroupsMembers = GroupInvitation::pluck('user_id')->flatten()->unique();

        // Decode JSON data to get arrays of integers
        // $groupsMembersArray = $groupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();
        // $pendingGroupsMembersArray = $pendingGroupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();

        $students = Student::whereNotIn('user_id', $groupsMembers)
            ->whereNotIn('user_id', $pendingGroupsMembers)
            ->get();

        return view('frontend.coordinator.request.group.requestGroupMembersDetails', compact('group', 'groupMembers', 'request', 'students'));
    }

    //Request Group Members Details
    public function requestToPropose()
    {
        return view('frontend.coordinator.request.group.requestToPropose');
    }
    //Incomplete Group's Approve for proposal
    public function groupApproveForProposal(RequestToCoordinator $request)
    {
        $requestedGroupId = $request->group_id;
        $group = Group::where('id', $requestedGroupId)->first();
        try {
            DB::beginTransaction();
            $group->update(['can_propose' => 1]);

            $member_ids = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $group_members = User::whereIn('id', $member_ids)->get();
            foreach ($group_members as $member) {
                $member->notify(new ProposalPermissionGrantedNotification($member->id));
            }
            $request->delete();
            DB::commit();
            return redirect()->route('coordinator.requests')->withMessage('Permission Given for Proposal');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function projectApproval(Request $request, $request_id)
    {
        try {
            DB::beginTransaction();

            // Retrieve the approval request based on the provided $requestId
            $approvalRequest = ProjectProposal::findOrFail($request_id);

            // Update the approval status in the approval request
            $approvalRequest->update([
                'coordinator_approval' => 'Approved',
            ]);

            // You can also update other fields as needed

            // Additional logic if needed, such as sending notifications, etc.

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('coordinator.dashboard')->with('success', 'Coordinator Approval Recorded');
    }

    public function proposalList()
    {
        $proposals = ProjectProposal::where('supervisor_feedback', 'accepted')->get();

        return view('frontend.coordinator.request.proposal.proposalList', compact('proposals'));
    }

    public function proposalDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);
        $supervisor = User::find($proposal->supervisor_id);
        $propose_again = OldTitle::where('group_id', $proposal->group_id)->exists();
        $same_supervisor = OldTitle::where('group_id', $proposal->group_id)
        ->where('supervisor_id', $supervisor->id)
        ->exists();
        $id = OldTitle::where('group_id', $proposal->group_id)->value('supervisor_id');
        $old_supervisor = User::find($id);
        // dd($old_supervisor);
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }
        return view('frontend.coordinator.request.proposal.proposalDetails', compact('group', 'proposal', 'members', 'supervisor', 'propose_again','old_supervisor', 'same_supervisor'));
    }


    public function projectApprove(Request $request, ProjectProposal $proposal)
    {
        try {
            if ($proposal) {
                $is_allocated = Project::where('group_id', $proposal->group_id)->exists();
                if (!$is_allocated) {
                    if ($request->response == 1) {
                        try {
                            DB::beginTransaction();

                            $project = Project::create([
                                'group_id' => $proposal->group_id,
                                'title' => $proposal->title,
                                'course' => $proposal->course,
                                'supervisor_id' => $proposal->supervisor_id,
                                'coordinator_id' => Auth::guard('coordinator')->user()->id,
                                'domain' => $proposal->domain,
                                'project_type' => $proposal->project_type,
                                'description' => $proposal->description,
                            ]);
                            $group = Group::where('id', $proposal->group_id)->first();
                            $group->update(['project_id' => $project->id]);

                            $has_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                            if ($has_feedback) {
                                $has_feedback->delete();
                            }
                            $proposal->delete();
                            DB::commit();
                            // for student notify
                            $members = GroupMember::where('group_id', $project->group_id)->get();
                            $students = User::whereIn('id', $members->pluck('user_id'))->get();
                            foreach ($students as $student) {
                                $student->notify(new ProjectApprovalNotification($project));
                            }
                            //for supervisor notify
                            $supervisor = User::find($project->supervisor_id);
                            $supervisor->notify(new ProjectApprovalNotification($project));
                            return redirect()->route('coordinator.proposalList')->withMessage("Project Allocated to This Group Successfully!");
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            return redirect()->back()->with('error', $th->getMessage());
                        }
                    }
                    if ($request->response == 2) {
                        $has_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                        try {
                            DB::beginTransaction();
                            if ($has_feedback) {
                                $has_feedback->update(['is_denied' => 1]);
                            } else {
                                $proposal_feedback = ProposalFeedback::create([
                                    'group_id' => $proposal->group_id,
                                    'is_denied' => 1,
                                    'denied_by' => auth()->guard('coordinator')->user()->id,
                                ]);
                            }
                            // supervisor notify
                            $supervisor = User::find($proposal->supervisor_id);
                            $supervisor->notify(new ProposalFeedbackNotification($proposal_feedback));

                            $proposal->delete();
                            DB::commit();
                            // for student notify
                            $members = GroupMember::where('group_id', $proposal_feedback->group_id)->get();
                            $students = User::whereIn('id', $members->pluck('user_id'))->get();
                            foreach ($students as $student) {
                                $student->notify(new ProposalFeedbackNotification($proposal_feedback));
                            }
                            return redirect()->route('coordinator.proposalList')->withMessage("Project Proposal Denied");
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            return redirect()->back()->with('error', $th->getMessage());
                        }
                    }
                } else {
                    $proposal->delete();
                    return redirect()->route('coordinator.proposalList')->with('error', "A Project is Already Allocated to This Group!");
                }
            } else {

                return redirect()->route('coordinator.proposalList')->with('error', 'Proposal not found.');
            }
        } catch (Throwable $th) {
            return redirect()->back()->withInput()->with('errors', $th->getMessage());
        }
    }
    // Project title change or supervisor change 
    public function reProposalFeedback(Request $request, ProjectProposal $proposal){
        try {
            $project = Project::where('group_id', $proposal->group_id)->first();
            // dd($project );
            if ($proposal && $project) {
                $old_title = OldTitle::where('group_id', $proposal->group_id)->first();
                if ($old_title) {
                    if ($request->response == 1) {
                        try {
                            DB::beginTransaction();

                            $project->update([
                                'group_id' => $proposal->group_id,
                                'title' => $proposal->title,
                                'course' => $proposal->course,  
                                'supervisor_id' => $proposal->supervisor_id,
                                'coordinator_id' => Auth::guard('coordinator')->user()->id,
                                'domain' => $proposal->domain,
                                'project_type' => $proposal->project_type,
                                'description' => $proposal->description,
                            ]);
                            $group = Group::where('id', $proposal->group_id)->first();
                            $group->update(['project_id' => $project->id]);

                            $has_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                            if ($has_feedback) {
                                $has_feedback->delete();
                            }
                            $proposal->delete();
                            DB::commit();
                            // for student notify
                            $members = GroupMember::where('group_id', $project->group_id)->get();
                            $students = User::whereIn('id', $members->pluck('user_id'))->get();
                            foreach ($students as $student) {
                                $student->notify(new ProjectApprovalNotification($project));
                            }
                            //for supervisor notify
                            $new_supervisor = User::find($project->supervisor_id);
                            $new_supervisor->notify(new ProjectApprovalNotification($project));
                            $old_supervisor = User::find($old_title->supervisor_id);
                            $old_supervisor->notify(new SupervisorReallocationNotification($old_title));
                            return redirect()->route('coordinator.proposalList')->withMessage("Project Re-Allocated to This Group Successfully!");
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            return redirect()->back()->with('error', $th->getMessage());
                        }
                    }
                    if ($request->response == 2) {
                        $has_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                        try {
                            DB::beginTransaction();
                            if ($has_feedback) {
                                $has_feedback->update(['is_denied' => 1]);
                            } else {
                                $proposal_feedback = ProposalFeedback::create([
                                    'group_id' => $proposal->group_id,
                                    'is_denied' => 1,
                                    'denied_by' => auth()->guard('coordinator')->user()->id,
                                ]);
                            }
                            // supervisor notify
                            $supervisor = User::find($proposal->supervisor_id);
                            $supervisor->notify(new ProposalFeedbackNotification($proposal_feedback));

                            $proposal->delete();
                            DB::commit();
                            // for student notify
                            $members = GroupMember::where('group_id', $proposal_feedback->group_id)->get();
                            $students = User::whereIn('id', $members->pluck('user_id'))->get();
                            foreach ($students as $student) {
                                $student->notify(new ProposalFeedbackNotification($proposal_feedback));
                            }
                            return redirect()->route('coordinator.proposalList')->withMessage("Project Proposal Denied");
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            return redirect()->back()->with('error', $th->getMessage());
                        }
                    }
                } else {
                    $proposal->delete();
                    return redirect()->route('coordinator.proposalList')->with('error', "Existing Project not found!");
                }
            } else {

                return redirect()->route('coordinator.proposalList')->with('error', 'Proposal not found.');
            }
        } catch (Throwable $th) {
            return redirect()->back()->withInput()->with('errors', $th->getMessage());
        }
    }
}
