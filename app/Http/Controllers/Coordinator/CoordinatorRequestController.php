<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\RequestToCoordinator;
use App\Models\GroupMember;
use App\Models\ProjectProposalApprovalRequest;
use App\Models\Student;
use App\Models\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // dd($request->group_id);
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

    public function requestedStudentAddToGroup(Request $request)
    {
        $request_id = $request->request_id;
        $group_id = $request->input('group_id');
        $selectedUserIds = $request->input('user_id', []);
        if (!is_array($selectedUserIds)) {
            $selectedUserIds = [$selectedUserIds];
        }

        DB::beginTransaction();

        try {
            // Check if any of the selected users are already in a group
            $userInGroup = GroupMember::whereIn('user_id', $selectedUserIds)->exists();

            if (!$userInGroup) {
                $group = Group::find($group_id);

                if ($group) {
                    // Insert into the group_members table for each selected user
                    foreach ($selectedUserIds as $user_id) {
                        GroupMember::create([
                            'group_id' => $group_id,
                            'user_id' => $user_id,
                        ]);
                    }
                    if (count($group->groupMembers) >= 4) {
                        $group->update(['can_propose' => 1]);
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
                DB::rollback();
                RequestToCoordinator::where('id', $request_id)->delete();
                return redirect()->route('coordinator.requests')->with('error', 'One or more selected students are already in a group.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while adding the students to the group.');
        }
    }

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
        // dd($students);

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

            $request->delete();
            // dd($group);
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
            $approvalRequest = ProjectProposalApprovalRequest::findOrFail($request_id);

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
        $proposals = ProjectProposalApprovalRequest::all();

        return view('frontend.coordinator.request.proposal.proposalList', compact('proposals'));
    }

    public function proposalDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $proposal = ProjectProposalApprovalRequest::find($request->proposal_id);

        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }
        return view('frontend.coordinator.request.proposal.proposalDetails', compact('group', 'proposal', 'members'));
    }


    public function projectApprove(Request $request, $request_id)
    {
        // Find the project proposal approval request
        $request = ProjectProposalApprovalRequest::find($request_id);

        // dd($request);
        try {
            DB::beginTransaction();

            // Create a new record in the approved_groups table
            ApprovedGroup::create([
                'group_id' => $request->group_id,
                'title' => $request->title,
                'course' => $request->course,
                'supervisor_id' => $request->supervisor_id,
                'cosupervisor' => $request->cosupervisor,
                'coordinator_id' => auth('coordinator')->user()->id, // Assuming coordinator's ID is stored in users table
                'domain' => $request->domain,
                'project_type' => $request->project_type,
                'description' => $request->description,
            ]);

            // Delete the project proposal approval request
            $request->delete();

            DB::commit();

            return redirect()->route('coordinator.proposalList')->with('success', 'Request approved. Group data transferred.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
}
