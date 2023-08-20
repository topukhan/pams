<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\ProjectProposal;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //Student Group Requests 
    public function groupRequests()
    {
        $proposals = ProjectProposal::all();
        return view('frontend.supervisor.group.groupRequests', compact('proposals'));
    }

    //Students Request Group Details 
    public function groupRequestDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);
        return view('frontend.supervisor.group.groupRequestDetails', compact('group', 'proposal'));
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
        return view('frontend.supervisor.group.groupRequestDetails', compact('group', 'proposal'));
    }



    //Supervisor Approved Groups
    public function approvedGroups()
    {
        $approved_groups = ApprovedGroup::all();
        return view('frontend.supervisor.group.approvedGroups', compact('approved_groups'));
    }

    //Supervisor Approved Group Details 
    public function approvedGroupDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $approved = ApprovedGroup::find($request->approved_id);
        return view('frontend.supervisor.group.approvedGroupDetails', compact('group', 'approved'));
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
        return view('frontend.supervisor.task.assignTask', ['groups' => $groups]);
    }

    //Supervisor Login
    public function login()
    {
        return view('frontend.supervisor.login');
    }

    
    // Project Proposal list
    public function proposalList()
    {
        $proposals = ProjectProposal::all();
        return view('frontend.supervisor.proposal.proposalList', compact('proposals'));
    }

    //project Proposal list
    public function proposalDetails(Request $request)
    {
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);

        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        } 
        return view('frontend.supervisor.proposal.proposalDetails', compact('group', 'proposal', 'members'));
    }

    //project Proposal Suggestion to student
    public function proposalSuggest()
    {
        return view('frontend.supervisor.proposal.proposalSuggest');
    }

    // public function 

}
