<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use validator;

class GroupController extends Controller
{
    // Create Group
    public function createGroup()
    {
        $domains = Domain::all();
        $students = User::with('student')->where('role','student')->get();
        $loggedInStudentEmail = Auth::guard('student')->user()->email;
        return view('frontend.student.createGroup', compact('domains', 'students', 'loggedInStudentEmail'));
    }

    // Store Group
    public function storeGroup(Request $request)
    {
        dd('here');
        $validator = Validator::make($request->all(),[
            'project_type' => 'required',
            'domain' => 'required',
            'group_name' => 'min:4', 
            'email' => 'required',
            'name' => 'required',
            'student_id' => 'required',
            'batch' => 'required',
        ]);
        if ($validator->passes()) {
            return response()->json(['success'=>'Group Created']);
        }
        return response()->json(['error' => $validator->errors()]);

        try {
            $group = Group::create([
                'name' => $request->group_name,
                'topic' => $request->topic,

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
                    'name' => $request->name[$key],
                    'student_id' => $request->student_id[$key],
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
    public function myGroupDetails(Request $request)
    {
        $id = $request->group;
        $group_members = GroupMember::where('group_id', $id)->get();
        return view('frontend.student.myGroupDetails', ['group_members' => $group_members]);
    }
}
