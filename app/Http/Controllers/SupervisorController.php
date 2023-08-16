<?php

namespace App\Http\Controllers;

use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\ProjectProposal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //Supervisor Dashboard
    public function dashboard()
    {
        return view('frontend.supervisor.dashboard');
    }

    //Student Group Requests 
    public function groupRequests()
    {
        $proposals = ProjectProposal::all();
        return view('frontend.supervisor.groupRequests', compact('proposals'));
    }

    //Students Request Group Details 
    public function groupRequestDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);
        return view('frontend.supervisor.groupRequestDetails', compact('group', 'proposal'));
    }

    // Store approved group to table 
    public function storeApproveGroup(Request $request)
    {
        
        $approved = ProjectProposal::find($request->proposal_id);
        try {
            $store = ApprovedGroup::create([
                'group_id' => $approved->group_id,
                'title'=> $approved->title,
                'course'=> $approved->course,
                'supervisor_id'=> $approved->supervisor_id,
                'cosupervisor'=> $approved->cosupervisor,
                'domain'=> $approved->domain,
                'type'=> $approved->type
            ]);
            if ($approved) {
                $approved->delete();
            }
            return redirect()->route('supervisor.groupRequests')->withMessage("Proposal Approved!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        return view('frontend.supervisor.groupRequestDetails', compact('group', 'proposal'));
    }



    //Supervisor Approved Groups
    public function approvedGroups()
    {
        $approved_groups = ApprovedGroup::all();
        return view('frontend.supervisor.approvedGroups', compact('approved_groups'));
    }

    //Supervisor Approved Group Details 
    public function approvedGroupDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $approved = ApprovedGroup::find($request->approved_id);
        return view('frontend.supervisor.approvedGroupDetails', compact('group', 'approved'));
    }

    //Supervisor Rejected Groups
    public function rejectedGroups(Request $request)
    {
        $id = ($request->id);
        $proposal = ProjectProposal::find($id);
        try {
            if ($proposal) {
                $proposal->delete();
                return redirect()->intended('/supervisor/groupRequests')->withMessage('Proposal Deleted Successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // assign task
    public function assignTask(){
        $groups = Group::all();
        return view('frontend.supervisor.assignTask', ['groups' => $groups]);
    }

    //Supervisor Login
    public function login()
    {
        return view('frontend.supervisor.login');
    }

    // Project Proposal list
    public function proposalList()
    {
        return view('frontend.supervisor.proposalList');
    }

    //project Proposal list
    public function proposalDetails()
    {
        return view('frontend.supervisor.proposalDetails');
    }

    //project Proposal list
    public function proposalSuggest()
    {
        return view('frontend.supervisor.proposalSuggest');
    }
}
