<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Create Group
    public function createGroup()
    {
        return view('frontend.student.createGroup');
    }

    // Store Group
    public function storeGroup(Request $request)
    {


        try {
            $group = Group::create([
                'name' => $request->group_name,

            ]);
        } catch (QueryException $e) {

            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        // Create entry in group_members table for each member
        foreach ($request->email as $key => $email) {
            try {
                GroupMember::create([
                    'group_id' => $group->id,
                    'email' => $email,
                    'member' => $request->member[$key],
                    'student_ID' => $request->student_ID[$key],
                    'batch' => $request->batch[$key]
                ]);
            } catch (QueryException $e) {
                return redirect()->back()->withInput()->withErrors('Something went wrong!');
            }
        }
        return redirect()->route('student.dashboard')->withMessage("Group Has Been Created!");
    }


    //My Group
    public function myGroup()
    {
        $groups = Group::all();
        return view('frontend.student.myGroup', ['groups' => $groups]);
    }

    //My Group Details 
    public function myGroupDetails()
    {
        return view('frontend.student.myGroupDetails');
    }
}
