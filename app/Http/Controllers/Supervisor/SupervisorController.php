<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\ProjectProposalApprovalRequest;
use App\Models\ProposalFeedback;
use App\Models\Supervisor;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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

    // Project Proposal list
    public function proposalList()
    {
        $id = Auth::guard('supervisor')->user()->id;
        $proposals = ProjectProposal::where('supervisor_id', $id)
            ->Where('supervisor_feedback', 'pending')
            ->get();
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
    public function proposalSuggest($group_id, $proposal_id)
    {

        return view('frontend.supervisor.proposal.proposalSuggest', compact('group_id', 'proposal_id'));
    }

    public function proposalResponse(Request $request)
    {
        $id = $request->proposal_id;
        $proposal = ProjectProposal::where('id', $id)->first();
        $response = $request->response;
        // dd($proposal);
        try {
            if ($proposal) {
                if ($response == 'approved') {
                    $proposal->update(['supervisor_feedback' => 'accepted']);
                    return redirect()->route('supervisor.proposalList')->withMessage('Proposal Accepted & sent to coordinator for approval');
                } elseif ($response == 'denied') {
                    try {
                        DB::beginTransaction();
                        ProposalFeedback::create([
                            'group_id' => $proposal->group_id,
                            'is_denied' => true,
                        ]);
                        $proposal->update(['supervisor_feedback' => 'rejected']);
                        $proposal_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                        $proposal_feedback->update(['is_denied' => true]);
                        $proposal->delete();
                        DB::commit();
                        return redirect()->route('supervisor.proposalList')->withDenied('You denied the project proposal');
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return redirect()->back()->withInput()->with('errors', $th->getMessage());
                    }
                } elseif ($request->suggest) {
                    $request->validate([
                        'suggest' => 'required'
                    ]);
                    try {
                        DB::beginTransaction();
                        // $proposal_feedback = ProposalFeedback::where('group_id', $request->group_id)->first();
                        // dd($proposal_feedback);
                        ProposalFeedback::create([
                            'group_id' => $request->group_id,
                            'suggestion' => $request->suggest
                        ]);

                        $proposal->update(['supervisor_feedback' => 'suggestion']);
                        DB::commit();
                        return redirect()->route('supervisor.proposalList')->withMessage('Suggestion Made Successfully');
                    } catch (Throwable $th) {
                        DB::rollback();
                        dd($th->getMessage());
                        return redirect()->back()->withInput()->with('errors', $th->getMessage());
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

   ////////////////////////////////////////////////////////////////////

    //Supervisor Evaluation
    public function evaluateGroups()
    {
        $id = auth()->guard('supervisor')->user()->id;
        $projects = Project::where('supervisor_id', $id)->get();
        return view('frontend.supervisor.evaluate.groups',  compact('projects'));
    }
    //Supervisor Evaluation
    public function evaluation(Request $request)
    {
        $project = Project::find($request->project_id);
        // $groupMembers = GroupMember::where('group_id', $project->group_id)
        // ->with('user') // Load the associated user information
        // ->get();
       
        $supervisor = Supervisor::find($project->supervisor_id);
        $group = Group::find($request->group_id);
        $proposal = ProjectProposal::find($request->proposal_id);
        $supervisor = User::find($project->supervisor_id);
        // dd($supervisor);

        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }

        return view('frontend.supervisor.evaluate.evaluation', compact('group', 'project', 'members', 'supervisor'));
    }
}
