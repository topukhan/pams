<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\RequestToCoordinator;
use App\Models\GroupMember;
use App\Models\PendingGroup;
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
        $id = $request->user_id;
        $request_id = $request->id;
        $groups = Group::paginate(7);
        $serialOffset = ($groups->currentPage() - 1) * $groups->perPage();
        return view('frontend.coordinator.formedGroupsList', compact('groups', 'id', 'request_id', 'serialOffset'));
    }

    //Request Details
    public function requestDetails(RequestToCoordinator $request)
    {

        return view('frontend.coordinator.requestDetails', compact('request'));
    }

    public function requestedStudentAddToGroup(Request $request)
    {
        //request_id is unique request id for Group join request
        $request_id = $request->request_id;
        $user_id = $request->input('user_id');
        $group_id = $request->input('group_id');
        // dd($group_id);
        DB::beginTransaction();

        try {
            // Check if the user is already in a group
            $userInGroup = GroupMember::where('user_id', $user_id)->exists();

            if (!$userInGroup) {
                // Update the members column of the group
                Group::where('id', $group_id)
                    ->update([
                        'members' => DB::raw("JSON_ARRAY_APPEND(members, '$', $user_id)")
                    ]);

                // Insert into the group_members table
                GroupMember::create([
                    'group_id' => $group_id,
                    'user_id' => $user_id
                ]);

                // Delete the group join request
                RequestToCoordinator::where('id', $request_id)->delete();

                DB::commit();

                return redirect()->route('coordinator.requests')->with('message', 'Student added to the group successfully.');
            } else {
                DB::rollback();
                RequestToCoordinator::where('id', $request_id)->delete();
                return redirect()->route('coordinator.requests')->with('error', 'Student is already in a group.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while adding the student to the group.');
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
        
        $members = json_decode($group->members);
        $groupMembers = Student::whereIn('user_id',$members)->get();
        // Available students
        $groupsMembers = Group::pluck('members')->flatten()->unique();
        $pendingGroupsMembers = PendingGroup::pluck('members')->flatten()->unique();

        // Decode JSON data to get arrays of integers
        $groupsMembersArray = $groupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();
        $pendingGroupsMembersArray = $pendingGroupsMembers->map(fn ($item) => json_decode($item, true))->flatten()->unique()->toArray();
        
        $students = Student::whereNotIn('user_id', $groupsMembersArray)
        ->whereNotIn('user_id', $pendingGroupsMembersArray)
        ->get();
       
        return view('frontend.coordinator.requestGroupMembersDetails', compact('group', 'groupMembers', 'request', 'students'));
    }

    //Request Group Members Details
    public function requestToPropose()
    {
        return view('frontend.coordinator.requestToPropose');
    }
}
