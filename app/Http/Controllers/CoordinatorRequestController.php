<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupJoinRequest;
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoordinatorRequestController extends Controller
{
    //Request
    public function requests()
    {
        $requests = GroupJoinRequest::paginate(6);
        foreach ($requests as $request) {
            $request->shortNote = Str::limit($request->note, 25, '...');
        }
        $serialOffset = ($requests->currentPage() - 1) * $requests->perPage();
        return view('frontend.coordinator.requests', compact('requests', 'serialOffset'));
    }

    public function formedGroupsLists(GroupJoinRequest $request)
    {
        //here $request is request from student to coordinator
        $id = $request->user_id;
        $request_id = $request->id;
        $groups = Group::paginate(7);
        $serialOffset = ($groups->currentPage() - 1) * $groups->perPage();
        return view('frontend.coordinator.formedGroupsList', compact('groups', 'id', 'request_id', 'serialOffset'));
    }

    //Request Details
    public function requestDetails(GroupJoinRequest $request)
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
                GroupJoinRequest::where('id', $request_id)->delete();

                DB::commit();

                return redirect()->route('coordinator.requests')->with('message', 'Student added to the group successfully.');
            } else {
                DB::rollback();
                GroupJoinRequest::where('id', $request_id)->delete();
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
     public function requestGroupMembersDetails()
     {
         return view('frontend.coordinator.requestGroupMembersDetails');
     }

     //Request Group Members Details
     public function requestToPropose()
     {
         return view('frontend.coordinator.requestToPropose');
     }
}
