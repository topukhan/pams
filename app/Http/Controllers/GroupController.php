<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GroupController extends Controller
{
     // Create Group
     public function createGroup(){
        return view('frontend.student.createGroup');
    }

    // Store Group
    public function storeGroup(Request $request){
        $email = implode(',', $request->email);
        $member = implode(',', $request->member);
        $student_ID = implode(',', $request->student_ID);
        $batch = implode(',', $request->batch);
        $phone = implode(',', $request->phone);

        try {
            Group::create([
                'group_name' => $request->group_name,
                'email' => $email,
                'member' => $member,
                'student_ID' => $student_ID,
                'batch' => $batch,
                'phone' => $phone

            ]);
            return redirect()->route('student.dashboard')->withMessage("Group Has Been Created!");
        } catch (QueryException $e) {

            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }


    //My Group
    public function myGroup(){     
        $groups = Group::all();
        return view('frontend.student.myGroup', ['groups' => $groups]);
    }

     //My Group Details 
     public function myGroupDetails(){
        return view('frontend.student.myGroupDetails');
    }


   
}
