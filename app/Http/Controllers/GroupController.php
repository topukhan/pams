<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PendingGroup;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        return view('frontend.student.createGroup', compact('domains', 'students', 'loggedInStudent'));
    }

    // Store Group
    public function storeGroup(Request $request)
    {
        $request->validate([
            'project_type' => 'required',
            'domain' => 'required',
            'group_name' => 'min:6',
            'email' => 'required',
            'name' => 'required',
            'student_id' => 'required',
            'batch' => 'required',
        ]);
        // before entry to groups, first store it in pending groups. 
        // After confirm or getting feedbacks then store to main-> (groups) table 
        try{
            $members = json_encode($request->ids);
            $pending_group = PendingGroup::create([
                'project_type' => $request->project_type,
                'domain' => $request->domain,
                'name' => $request->group_name,
                'members' => $members,
                'positive_status' => 1, // acceptance count minimum 2 required to create a group
                'member_feedback' => 1, // Initial feedback status is 1
            ]);
            dd($request);

        }catch (QueryException $e) {

            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        // create group
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

    // Group Request
    public function groupRequest(){

        $id = Auth::guard('student')->user()->id;
        $idJson = json_encode($id);
        $pending_group = PendingGroup::whereJsonContains('members', $idJson)->first();
        $memberIds = json_decode($pending_group->members, true);
        $users = User::whereIn('id', $memberIds)->get();
        // dd($pending_group->members);
        return view('frontend.student.groupRequest', compact('pending_group', 'users'));
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
