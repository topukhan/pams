<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Phase1;
use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\ProjectProposalApprovalRequest;
use App\Models\ProjectReport;
use App\Models\ProposalFeedback;
use App\Models\Supervisor;
use App\Models\User;
use App\Notifications\ProjectProposalNotification;
use App\Notifications\ProposalFeedbackNotification;
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

    //Supervisor Approved Groups
    public function approvedGroups()
    {
        $approved_groups = Project::where('supervisor_id', auth()->guard('supervisor')->user()->id)->get();
        return view('frontend.supervisor.group.approvedGroups', compact('approved_groups'));
    }

    //Supervisor Approved Group Details 
    public function approvedGroupDetails(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        // $members = $group->groupMembers;
        return view('frontend.supervisor.group.approvedGroupDetails', compact('group'));
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
        try {
            if ($proposal) {
                if ($response == 'approved') {
                    $proposal->update(['supervisor_feedback' => 'accepted']);
                    // for student notify
                    $members = GroupMember::where('group_id', $proposal->group_id)->get();
                    $students = User::whereIn('id', $members->pluck('user_id'))->get();
                    foreach ($students as $student) {
                        $student->notify(new ProjectProposalNotification($proposal->group_id, $proposal));
                    }
                    //notify coordinator
                    $coordinator = User::where('role', 'coordinator')->first();
                    $coordinator->notify(new ProjectProposalNotification($proposal->group_id, $proposal));
                    return redirect()->route('supervisor.proposalList')->withMessage('Proposal Accepted & sent to coordinator for approval');
                } elseif ($response == 'denied') {
                    try {
                        DB::beginTransaction();
                        ProposalFeedback::create([
                            'group_id' => $proposal->group_id,
                            'is_denied' => true,
                            'denied_by' => auth()->guard('supervisor')->user()->id,

                        ]);
                        $proposal->update(['supervisor_feedback' => 'rejected']);
                        $proposal_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
                        $proposal_feedback->update(['is_denied' => true]);
                        $proposal->delete();
                        DB::commit();
                        // for student notify
                        $members = GroupMember::where('group_id', $proposal_feedback->group_id)->get();
                        $students = User::whereIn('id', $members->pluck('user_id'))->get();
                        foreach ($students as $student) {
                            $student->notify(new ProposalFeedbackNotification($proposal_feedback));
                        }
                        return redirect()->route('supervisor.proposalList')->withDenied('You denied the project proposal');
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return redirect()->back()->withInput()->with('errors', $th->getMessage());
                    }
                } else {
                    $request->validate([
                        'suggest' => 'required'
                    ]);
                    try {
                        DB::beginTransaction();
                        ProposalFeedback::create([
                            'group_id' => $request->group_id,
                            'suggestion' => $request->suggest
                        ]);

                        $proposal->update(['supervisor_feedback' => 'suggestion']);
                        DB::commit();
                        // for student notify
                        $members = GroupMember::where('group_id', $proposal->group_id)->get();
                        $students = User::whereIn('id', $members->pluck('user_id'))->get();
                        foreach ($students as $student) {
                            $student->notify(new ProjectProposalNotification($proposal->group_id, $proposal));
                        }
                        return redirect()->route('supervisor.proposalList')->withMessage('Suggestion Made Successfully');
                    } catch (Throwable $th) {
                        DB::rollback();
                        return redirect()->back()->withInput()->with('error', $th->getMessage());
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function projectReportList()
    {
        $id = auth()->guard('supervisor')->user()->id;
        $projects = Project::where('supervisor_id', $id)->get();

        $project_ids = $projects->pluck('id');
        $project_reports = ProjectReport::whereIn('project_id', $project_ids)->get();


        return view('frontend.supervisor.project.projectReportList', compact('projects', 'project_reports'));
    }

    public function projectReportDetails(ProjectReport $project_report)
    {
        return view('frontend.supervisor.project.projectReportDetails', compact('project_report'));
    }

    // Assistance
    public function assistance()
    {
        return view('frontend.supervisor.aside.assistance');
    }

    // Change Password
    public function changePassword()
    {
        return view('frontend.supervisor.aside.changePassword');
    }
}
