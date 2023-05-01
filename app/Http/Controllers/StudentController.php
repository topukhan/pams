<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard(){
        return view('frontend.student.dashboard');
    }

    // Create Group
    public function createGroup(){
        return view('frontend.student.createGroup');
    }

    //Proposal Form
    public function proposalForm(){
        return view('frontend.student.proposalForm');
    }

    //Proposal Change Form
    public function proposalChangeForm(){
        return view('frontend.student.proposalChangeForm');
    }

    //Pending Groups
    public function pendingGroups(){
        return view('frontend.student.pendingGroups');
    }

    //Pending Group Details 
    public function pendingGroupDetails(){
        return view('frontend.student.pendingGroupDetails');
    }
}
