<?php

namespace App\Http\Controllers;

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
use validator;

class GroupController extends Controller
{
    // Create Group
    public function createGroup()
    {
        $domains = Domain::all();
        $id = Auth::guard('student')->user()->id;
        $loggedInStudent = User::where('id', $id)->with('student')->first();

        $students = Student::whereJsonContains('project_type', 'project')
            ->orWhereJsonContains('project_type', 'thesis')
            ->orWhereNull('project_type')
            ->get();
//test try 
            $this->transferPendingGroups();
        return view('frontend.student.createGroup', compact('domains', 'students', 'loggedInStudent'));
    }

    // Store Group
    public function storeGroup(Request $request)
    {
        $request->validate([
            'project_type' => 'required',
            'domain' => 'required',
            'email' => 'required',
            'name' => 'required',
            'student_id' => 'required',
            'batch' => 'required',
        ]);

        // before entry to groups, first store it in pending groups. 
        // After confirm or getting feedbacks then store to main-> (groups) table 
        try {
            DB::beginTransaction();

            $members = json_encode($request->ids);

            $pending_group = PendingGroup::create([
                'project_type' => $request->project_type,
                'domain' => $request->domain,
                'name' => $request->group_name,
                'members' => $members,
                'positive_status' => 1, // acceptance count minimum 2 required to create a group
                'member_feedback' => 1, // Initial feedback status is 1
                'created_by' => $request->creator_id,
            ]);

            // pending Group info insert into group invitation table
            $membersArray = json_decode($members);
            foreach ($membersArray as $member) {
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
            return redirect()->route('student.createGroup')->withMessage('Request Sent!');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }

        // create group
        // try {
        //     $group = Group::create([
        //         'name' => $request->group_name,
        //         'topic' => $request->topic,

        //     ]);
        // } catch (QueryException $e) {

        //     return redirect()->back()->withInput()->withErrors('Something went wrong!');
        // }
        // Create entry in group_members table for each member
        // foreach ($request->email as $key => $email) {
        //     try {
        //         GroupMember::create([
        //             'group_id' => $group->id,
        //             'email' => $email,
        //             'name' => $request->name[$key],
        //             'student_id' => $request->student_id[$key],
        //             'batch' => $request->batch[$key]
        //         ]);
        //     } catch (QueryException $e) {
        //         return redirect()->back()->withInput()->withErrors('Something went wrong!');
        //     }
        // }
        // return redirect()->route('student.dashboard')->withMessage("Group Has Been Created!");
    }

    // Group Request
    public function groupRequest()
    {
        $id = Auth::guard('student')->user()->id;
        $loggedInStudent = User::where('id', $id)->first();
        $idJson = json_encode($id);
        $pending_group = PendingGroup::whereJsonContains('members', $idJson)->first();
        $users = null;
        $invitation = null;
        if ($pending_group) {
            $memberIds = json_decode($pending_group->members, true);
            $users = User::whereIn('id', $memberIds)->get();
            $invitation = GroupInvitation::where('user_id', $id)->first()->id;
            // dd($group_id);
            // $invitations = GroupInvitation::where('group_id', $group_id)->get();
        }

        return view('frontend.student.groupRequest', compact('pending_group', 'users', 'invitation', 'loggedInStudent'));
    }

    public function groupRequestResponse(Request $request, GroupInvitation $invitation, PendingGroup $pending_group)
    {
        try {
            DB::beginTransaction();

            // Update the group invitation status
            $invitation->update([
                'status' => $request->response,
            ]);
            // Call the method to check and transfer pending groups
            $this->transferPendingGroups();

            $id = $request->id;
            $isPositive = $request->response == 1 ? 1 : 0;

            $pending_group = PendingGroup::whereJsonContains('members', $id)->first();

            // Update positive_status column based on current value
            $pending_group->positive_status = $isPositive === 1 ? $pending_group->positive_status + 1 : $pending_group->positive_status;
            $pending_group->member_feedback = $pending_group->member_feedback + 1;
            $pending_group->update();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        return redirect()->route('student.groupRequest')->withMessage('Response Recorded');
    }

    // Add a new method for transferring pending groups to groups table
    public function transferPendingGroups()
{
    $pendingGroups = PendingGroup::where('positive_status', '>=', 2)->where('member_feedback', 4)->get();

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
            $membersArray = json_decode($pendingGroup->members);
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

            // Delete the pending group entry after transferring data
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
        $groups = Group::all();
        return view('frontend.student.myGroup', ['groups' => $groups]);
    }

    //My Group Details 
    public function myGroupDetails(Request $request)
    {
        $id = $request->group;
        $group_members = GroupMember::where('group_id', $id)->get();
        return view('frontend.student.myGroupDetails', ['group_members' => $group_members]);
    }
}
