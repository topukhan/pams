<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\ProjectProposal;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //Supervisor Dashboard
    public function dashboard(){
        return view('frontend.supervisor.dashboard');
    }

    //Student Group Requests 
    public function groupRequests(){
        $proposals = ProjectProposal::all();
        return view('frontend.supervisor.groupRequests', compact('proposals'));
    }

    //Students Request Group Details 
    public function groupRequestDetails(Request $request){
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);
        return view('frontend.supervisor.groupRequestDetails', compact('group', 'proposal'));
    }

    

    //Supervisor Approved Groups
    public function approvedGroups(){
        return view('frontend.supervisor.approvedGroups');
    }

    //Supervisor Rejected Groups
    public function rejectedGroups(Request $request){
        // dd('hrer');
        $id = ($request->id);
        $proposal = ProjectProposal::find($id);
        try {
            if($proposal){
                $proposal->delete();
                return redirect()->intended('/supervisor/groupRequests')->withMessage('Proposal Deleted Successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    

    //Supervisor Login
    public function login(){
        return view('frontend.supervisor.login');
    }

}
