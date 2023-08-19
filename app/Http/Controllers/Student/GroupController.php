<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupMember;
use App\Models\PendingGroup;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    // Create Group
    public function createGroup()
    {
        $domains = Domain::all();
        $id = Auth::guard('student')->user()->id;
        $loggedInStudent = User::where('id', $id)->with('student')->first();
        $groupsMembers = GroupMember::pluck('user_id')->unique();
        $pendingGroupsMembers = GroupInvitation::pluck('user_id')->unique();

        $students = Student::whereNotIn('user_id', $groupsMembers)
            ->whereNotIn('user_id', $pendingGroupsMembers)
            ->get();

        return view('frontend.student.group.createGroup', compact('domains', 'students', 'loggedInStudent'));
    }

    // Store Group
    public function storeGroup(Request $request)
    {
        $request->validate([
            'project_type' => 'required',
            'domain' => 'required',
            'email.*' => 'required|email',
            'name' => 'required',
            'student_id' => 'required',
            'batch' => 'required',
        ]);

        // before entry to groups, first store it in pending groups. 
        // After confirm or getting feedbacks then store to main-> (groups) table 
        try {
            DB::beginTransaction();

            $members = $request->ids;
            $pending_group = PendingGroup::create([
                'project_type' => $request->project_type,
                'domain' => $request->domain,
                'name' => $request->group_name,
                'positive_status' => 1, // acceptance count minimum 2 required to create a group
                'member_feedback' => 1, // Initial feedback status is 1
                'created_by' => $request->creator_id,
            ]);

            // pending Group info insert into group invitation table

            foreach ($members as $member) {
                if ($member == $request->creator_id) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                GroupInvitation::create([
                    'group_id' => $pending_group->id,
                    'user_id' => $member,
                    'status' => $status,
                ]);
            }

            DB::commit();

            // Redirect to success page or show success message
            return redirect()->route('student.dashboard')->withMessage('Group Request Sent to selected Members!');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    // Group Request
    public function groupRequest()
    {
        $id = Auth::guard('student')->user()->id;
        $loggedInStudent = User::where('id', $id)->first();

        $group_id = GroupInvitation::where('user_id', $id)->value('group_id');
        $user_ids = GroupInvitation::where('group_id', $group_id)->pluck('user_id')->toArray();
        $pending_group = PendingGroup::where('id', $group_id)->first();


        $users = null;
        $invitation = null;
        if ($user_ids) {
            $users = User::whereIn('id', $user_ids)->get();
            //accept reject option 
            $invitation = GroupInvitation::where('user_id', $id)->first()->id;
            // $invitations = GroupInvitation::where('group_id', $group_id)->get();
        }
        //for delete if all rejected
        $this->deletePendingGroups();

        return view('frontend.student.group.groupRequest', compact('pending_group', 'users', 'invitation', 'loggedInStudent'));
    }

    public function groupRequestResponse(Request $request, GroupInvitation $invitation, PendingGroup $pending_group)
    {
        try {
            DB::beginTransaction();

            // Update the group invitation status
            $invitation->update([
                'status' => $request->response,
            ]);

            // $id = $request->user_id;
            $isPositive = $request->response == 1 ? 1 : 0;
            // dd($request->pending_group_id);
            $pending_group = PendingGroup::where('id', $request->pending_group_id)->first();

            // $pending_group = PendingGroup::whereJsonContains('members', $id)->first();

            // Update positive_status column based on current value
            $pending_group->positive_status = $isPositive == 1 ? $pending_group->positive_status + 1 : $pending_group->positive_status;
            $pending_group->member_feedback = $pending_group->member_feedback + 1;
            $pending_group->update();

            // Call the method to check and transfer pending groups
            $this->transferPendingGroups();
            //for delete if all rejected
            $this->deletePendingGroups();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        return redirect()->route('student.groupRequest')->withMessage('Response Recorded');
    }

    // Add a new method for transferring pending groups to groups table
    public function transferPendingGroups()
    {
        $pendingGroups = PendingGroup::where('positive_status', '>=', 2)->where('member_feedback', '>=', 4)->get();

        foreach ($pendingGroups as $pendingGroup) {
            try {
                DB::beginTransaction();
                // Create a new group entry
                $group = Group::create([
                    'name' => $pendingGroup->name,
                    'project_type' => $pendingGroup->project_type,
                    'domain' => $pendingGroup->domain,
                    // Add any other required fields for the group here
                ]);

                // Get the members with status 1 from group_invitations
                $membersArray = GroupInvitation::where('group_id', $pendingGroup->id)->pluck('user_id')->unique()->toArray();

                // dd($membersArray);
                // $membersArray = json_decode($pendingGroup->members);
                $acceptedMembers = GroupInvitation::whereIn('user_id', $membersArray)
                    ->where('status', 1)
                    ->pluck('user_id')
                    ->toArray();

                // Transfer group members from pending_group to group_members table
                foreach ($acceptedMembers as $member) {
                    $groupMember = GroupMember::where('user_id', $member)->first();
                    if ($groupMember) {
                        $groupMember->update(['group_id' => $group->id]);
                    } else {
                        GroupMember::create([
                            'group_id' => $group->id,
                            'user_id' => $member,
                            // Add any other required fields for group members here
                        ]);
                    }
                }
                if(count($group->groupMembers) >= 4){
                    $group->update(['can_propose' => 1]);
                }
                // Update the members column in the group table with accepted member user_ids
                // $group->update(['members' => json_encode($acceptedMembers)]);

                // Delete the pending group entry after transferring data
                $pendingGroup->delete();

                DB::commit();
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
                // Handle any errors during the transfer process
                // You can log the error or redirect to an error page if needed
            }
        }
    }


    public function deletePendingGroups()
    {
        $pendingGroups = PendingGroup::where('positive_status', '=', 1)->where('member_feedback', '>=', 4)->get();

        foreach ($pendingGroups as $pendingGroup) {
            try {
                DB::beginTransaction();


                // Delete the pending group
                $pendingGroup->delete();

                DB::commit();
            } catch (QueryException $e) {
                DB::rollBack();
                // Handle any errors during the transfer process
                // You can log the error or redirect to an error page if needed
            }
        }
    }

    //My Group
    public function myGroup()
    {
        $id = Auth::guard('student')->user()->id;
        $group = Group::where('id', function ($query) use ($id) {
            $query->select('group_id')
                ->from('group_members')
                ->where('user_id', $id)
                ->first();
        })->first();
        $members = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }

        return view('frontend.student.group.myGroup', compact('group', 'members'));
    }

    //My Group Details 
    public function myGroupDetails(Request $request)
    {
        $id = $request->group;
        $group_members = GroupMember::where('group_id', $id)->get();
        return view('frontend.student.group.myGroupDetails', ['group_members' => $group_members]);
    }
}
