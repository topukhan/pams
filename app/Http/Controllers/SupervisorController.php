<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //Supervisor Dashboard
    public function dashboard(){
        return view('frontend.supervisor.dashboard');
    }

    //Student Group Requests 
    public function groupRequests(){
        return view('frontend.supervisor.groupRequests');
    }

    //Students Pending Group Details 
    public function pendingGroupDetails(){
        return view('frontend.supervisor.pendingGroupDetails');
    }

    //Supervisor Approved Groups
    public function approvedGroups(){
        return view('frontend.supervisor.approvedGroups');
    }

}
