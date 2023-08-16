<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\RequestToCoordinator;
use App\Models\GroupMember;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('frontend.coordinator.requests', compact('requests', 'serialOffset'));
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
        return view('frontend.coordinator.formedGroupsList', compact('groups', 'requestedGroupId', 'id', 'request_id', 'serialOffset'));
    }

    //Request Details
    public function requestDetails(RequestToCoordinator $request)
    {

        return view('frontend.coordinator.requestDetails', compact('request'));
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
        return view('frontend.coordinator.requestGroupDetails');
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

        return view('frontend.coordinator.requestGroupMembersDetails', compact('group', 'groupMembers', 'request', 'students'));
    }

    //Request Group Members Details
    public function requestToPropose()
    {
        return view('frontend.coordinator.requestToPropose');
    }
}
