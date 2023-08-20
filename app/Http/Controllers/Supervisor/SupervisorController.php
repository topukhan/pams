<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\ProjectProposal;
use App\Models\ProjectProposalApprovalRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'title' => $approved->title,
                'course' => $approved->course,
                'supervisor_id' => $approved->supervisor_id,
                'cosupervisor' => $approved->cosupervisor,
                'domain' => $approved->domain,
                'type' => $approved->type
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
    public function assignTask()
    {
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

    // supervisor response
    public function proposalResponse(Request $request, $proposal_id)
    {
        $response = $request->input('response');
        $proposal = ProjectProposal::find($proposal_id);
        // $proposal->update([
            // 'status' => $response,
        // ]);
        if ($response == 1) {

            $proposal->update([
                'status' => 'Supervisor Approved',
                'supervisor_feedback' => 1, // Assuming 1 means 'Approved'
            ]);
            // Create an approval request without supervisor_feedback
            $approvalRequestData = $proposal->toArray();
            $approvalRequestData['proposal_id'] = $proposal->id; // Set the proposal ID explicitly

            // Unset the fields you don't want in the second table
            unset($approvalRequestData['supervisor_feedback']);
            unset($approvalRequestData['status']);

            $approvalRequest = ProjectProposalApprovalRequest::create($approvalRequestData);


            // Redirect to the coordinator for final approval
            return redirect()->route('coordinator.projectApproval', ['request_id' => $approvalRequest->id]);
        } elseif ($response == 2) {
            $proposal->update([
                'status' => 'Supervisor Denied',
                'supervisor_feedback' => 2, // Assuming 2 means 'Denied'
            ]);
            return redirect()->route('supervisor.proposalList');
        } elseif ($response == 3) {
            $proposal->update([
                'status' => 'Supervisor Suggest',
                'supervisor_feedback' => 3, // Assuming 2 means 'Denied'
            ]);
            // Handle "Suggest" response
            return redirect()->route('supervisor.proposalSuggest', ['proposal_id' => $proposal_id]);
        }

     

        return redirect()->back()->with('success', 'Proposal response recorded.');
    }
 


    //project Proposal list
    public function proposalSuggest()
    {
        return view('frontend.supervisor.proposal.proposalSuggest');
    }
}
