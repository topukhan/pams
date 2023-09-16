<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ApprovedGroup;
use App\Models\Domain;
use App\Models\File;
use App\Models\Group;
use App\Models\ProposalFeedback;
use App\Models\GroupMember;
use App\Models\OldTitle;
use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\ProjectReport;
use App\Models\RequestToCoordinator;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\Notifications\GroupRequestNotification;
use App\Notifications\ProjectProposalNotification;
use App\Notifications\GroupRequestToCoordinator;
use App\Notifications\IndividualRequestToCoordinator;
use App\Notifications\ProposalSuggestionCanceledNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class StudentController extends Controller
{

    public function supervisorAvailability(Request $request)
    {
        try {
            $domains = Domain::all();
            // $query = Supervisor::query();

            if ($request->ajax()) {
                $selectedDomain = $request->input('domain');

                if ($selectedDomain) {
                    $supervisorUserIds = DB::table('domain_user')
                        ->where('domain_id', $selectedDomain)
                        ->join('users', 'domain_user.user_id', '=', 'users.id')
                        ->where('users.role', 'supervisor')
                        ->pluck('users.id');
                    // Fetch supervisors using the user IDs
                    $supervisors = Supervisor::whereIn('user_id', $supervisorUserIds)->with('user')->get();
                    $domainName = Domain::where('id', $selectedDomain)->value('name');

                    // Log::debug('Selected Domain: ' . $domainName);
                    // Log::debug('Supervisor User IDs: ' . $supervisorUserIds->implode(', '));
                } else {
                    $supervisors = [];
                }

                return response()->json(['supervisors' => $supervisors, 'domainName' => $domainName]);
            }

            $supervisors = Supervisor::all();

            return view('frontend.student.dashboard.supervisorAvailability', compact('supervisors', 'domains'));
        } catch (\Exception $e) {
            Log::error('Error retrieving supervisors: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while loading data.'], 500);
        }
    }

    public function proposalForm(Request $request)
    {
        $supervisor_id = $request->id;
        $sup_dom_name = null;
        $selected_supervisor = null;
        if ($supervisor_id) {
            $selected_supervisor = User::where('id', $supervisor_id)->first();
            //Selected supervisor domain name (filtered)
            $sup_dom_name = $request->domain_name;
        }
        $id = Auth::guard('student')->user()->id;
        $group = Group::where('id', function ($query) use ($id) {
            $query->select('group_id')
                ->from('group_members')
                ->where('user_id', $id)
                ->first();
        })->first();
        $proposalSubmitted = null;
        $in_project = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            // Check if a proposal from the group already exists
            $existingProposal = ProjectProposal::where('group_id', $group->id)->first();
            $proposalSubmitted = $existingProposal !== null;
            $in_project = Project::where('group_id', $group->id)->exists();
        }
        $supervisors = Supervisor::where('availability', true)->get();

        $domains = Domain::all();
        return view('frontend.student.proposal.proposalForm', compact('supervisors', 'in_project', 'sup_dom_name', 'domains', 'selected_supervisor', 'group', 'proposalSubmitted'));
    }


    //Proposal Store in db
    public function storeProposalForm(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'title' => 'required',
            'course' => 'required',
            'supervisor_id' => 'required',
            'domain' => 'required',
            'project_type' => 'required',
            'description' => 'required'
        ]);
        if ($request->old_title) {
            $request->validate([
                'reason' => 'required'
            ]);
        }
        try {
            DB::beginTransaction();

            $proposalData = [
                'group_id' => $request->group_id,
                'title' => $request->title,
                'course' => $request->course,
                'supervisor_id' => $request->supervisor_id,
                'domain' => $request->domain,
                'project_type' => $request->project_type,
                'description' => $request->description,
                'created_by' => Auth::guard('student')->user()->id
            ];
            if ($request->reason) {
                $proposalData += [
                    'reason' => serialize($request->reason),
                ];
            }
            $proposal = ProjectProposal::create($proposalData);
            if ($request->old_title) {
                $data = [
                    'group_id' => $request->group_id,
                    'supervisor_id' => $request->old_supervisor_id,
                    'old_title' => $request->old_title,
                    'created_by' => Auth::guard('student')->user()->id
                ];
                OldTitle::create($data);
            }

            $existing_feedback = ProposalFeedback::where('group_id', $request->group_id)->first();
            if ($existing_feedback) {
                $existing_feedback->delete();
            }
            DB::commit();

            //notify supervisor
            $supervisor = User::where('id', $request->supervisor_id)->first();

            $supervisor->notify(new ProjectProposalNotification($request->group_id, $proposal));
            return redirect()->route('student.dashboard')->withMessage("Proposal Submitted!");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    // Project proposal feedback/status
    public function proposalStatus()
    {

        $id = Auth::guard('student')->user()->id;
        $group_id = GroupMember::where('user_id', $id)->value('group_id');
        $proposal = ProjectProposal::where('group_id', $group_id)->first();
        $is_denied = ProposalFeedback::where('group_id', $group_id)->where('is_denied', 1)->exists();
        $proposal_feedback = null;
        $supervisor = null;
        $in_project = Project::where('group_id', $group_id)->exists();
        if ($proposal) {
            $proposal_feedback = ProposalFeedback::where('group_id', $group_id)->first();
            $supervisor = User::where('id', $proposal->supervisor_id)->first();
        }
        return view('frontend.student.proposal.proposalStatus', compact('proposal', 'in_project', 'is_denied', 'proposal_feedback', 'supervisor'));
    }

    //If supervisor's suggestion accept then existing project proposal will modified
    public function editProposalForm(ProjectProposal $proposal)
    {
        $id = Auth::guard('student')->user()->id;
        $group = Group::where('id', function ($query) use ($id) {
            $query->select('group_id')
                ->from('group_members')
                ->where('user_id', $id)
                ->first();
        })->first();
        $supervisor = User::where('id', $proposal->supervisor_id)->select('first_name', 'last_name')->first();


        $supervisor_name = $supervisor->first_name . ' ' . $supervisor->last_name;
        $domains = Domain::all();

        return view('frontend.student.proposal.editProposalForm', compact('proposal', 'group', 'supervisor_name', 'domains'));
    }


    //Update existing proposal based on suggestion from supervisor
    public function proposalUpdate(Request $request)
    {
        $proposal = ProjectProposal::where('id', $request->proposal_id)->first();

        $request->validate([
            'title' => 'required',
            'course' => 'required',
            'domain' => 'required',
            'project_type' => 'required',
            'description' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $proposal->update([
                'title' => $request->title,
                'course' => $request->course,
                'domain' => $request->domain,
                'project_type' => $request->project_type,
                'supervisor_feedback' => 'pending',
                'description' => $request->description
            ]);

            $proposal_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
            $proposal_feedback->delete();
            DB::commit();
            return redirect()->route('student.dashboard')->withMessage("Proposal Updated!");
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    //Supervisor's suggestion denied delete the proposal
    public function proposalDelete(Request $request)
    {
        $proposal = ProjectProposal::where('id', $request->proposal_id)->first();
        $proposal_feedback = ProposalFeedback::where('group_id', $proposal->group_id)->first();
        //notify supervisor
        $supervisor = User::find($proposal->supervisor_id);
        $group = Group::find($proposal->group_id);
        try {
            DB::beginTransaction();
            $proposal->delete();
            $proposal_feedback->delete();
            DB::commit();
            //notify supervisor
            $supervisor->notify(new ProposalSuggestionCanceledNotification($group->name));
            return redirect()->route('student.proposalStatus')->withMessage('Cancelled, Make a new Proposal');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    //Proposal Change Form // re proposal form 
    public function proposalChangeForm(Project $project)
    {
        $group_id = GroupMember::where('user_id', auth()->guard('student')->user()->id)->value('group_id');
        $supervisors = Supervisor::where('availability', 1)->get();
        $has_old_title = OldTitle::where('group_id', $group_id)->exists();
        $domains = Domain::all();
        return view('frontend.student.proposal.proposalChangeForm', compact('project', 'supervisors', 'domains', 'has_old_title'));
    }

    //Pending Groups
    public function pendingGroups()
    {
        return view('frontend.student.group.pendingGroups');
    }

    //Pending Group Details 
    public function pendingGroupDetails()
    {
        return view('frontend.student.group.pendingGroupDetails');
    }

    // Tasklist
    public function taskList()
    {
        return view('frontend.student.task.taskList');
    }

    // Task Details
    public function taskDetails()
    {
        return view('frontend.student.task.taskDetails');
    }

    // Upcoming Events
    public function upcomingEvents()
    {
        return view('frontend.student.event.upcomingEvents');
    }

    // Upcoming Event Details
    public function upcomingEventDetails()
    {
        return view('frontend.student.event.upcomingEventDetails');
    }

    // Assistance
    public function assistance()
    {
        return view('frontend.student.aside.assistance');
    }

    // Change Password
    public function changePassword()
    {
        return view('frontend.student.aside.changePassword');
    }

    // previous Projects
    public function previousProjects()
    {
        return view('frontend.student.dashboard.previousProjects');
    }

    // Individual Request
    public function groupMemberRequest(Request $request)
    {
        $id = Auth::guard('student')->user()->id;
        $can_request = RequestToCoordinator::where(function ($query) use ($id) {
            $query->whereIn('user_id', [$id]);
        })
            ->doesntExist();
        return view('frontend.student.request.groupMemberRequest', compact('id', 'can_request'));
    }

    // Request for join a group 
    public function requestToCoordinator(Request $request)
    {

        try {
            $request->validate([
                'reason' => 'required'
            ]);
            //notify
            $coordinator = User::where('role', 'coordinator')->first();

            if ($request->id) {
                $request_to_coordinator = RequestToCoordinator::create([
                    'user_id' => $request->id,
                    'reason' => $request->reason,
                    'note' => $request->note
                ]);
                $coordinator->notify(new IndividualRequestToCoordinator($request->id, $request_to_coordinator->id));
            } else {
                $request_to_coordinator = RequestToCoordinator::create([
                    'group_id' => $request->group_id,
                    'reason' => $request->reason,
                    'note' => $request->note
                ]);
                $coordinator->notify(new GroupRequestToCoordinator($request->group_id, $request_to_coordinator->id));
                // notify group members about request sent to coordinator
                $group = Group::find($request->group_id);
                $member_ids = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
                $auth_id = [auth()->guard('student')->user()->id];
                $remaining_members = array_diff($member_ids, $auth_id);
                $members = User::whereIn('id', $remaining_members)->get();
                $name = auth()->guard('student')->user()->first_name . ' ' . auth()->guard('student')->user()->last_name;
                Notification::send($members, new GroupRequestNotification($name, $request->reason));
            }


            return redirect()->route('student.dashboard')->withMessage('Request Sent! Check back later');
        } catch (\Exception $e) {

            return redirect()->route('student.groupMemberRequest')->with('error', 'Request failed. Please try again later.');
        }
    }

    // Group Request to coordinator
    public function requestToCoordinatorForm(Request $request)
    {
        $group_id = $request->group_id;
        $can_request = RequestToCoordinator::where(function ($query) use ($group_id) {
            $query->whereIn('group_id', [$group_id]);
        })
            ->doesntExist();
        return view('frontend.student.request.requestToCoordinator', compact('group_id', 'can_request'));
    }

    // student My project
    public function myProject()
    {
        $id = Auth::guard('student')->user()->id;
        $group = Group::where('id', function ($query) use ($id) {
            $query->select('group_id')
                ->from('group_members')
                ->where('user_id', $id)
                ->first();
        })->first();
        $can_propose = $group->can_propose == 1;
        $members = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }
        $project = Project::where('group_id', $group->id)->first();
        $supervisor = User::where('id', $project->supervisor_id)->first();

        return view('frontend.student.project.myProject', compact('group', 'members', 'can_propose', 'project', 'supervisor'));
    }


    public function getStarted()
    {
        return view('frontend.student.dashboard.getStarted');
    }

    public function reportSubmission()
    {
        $group_id = GroupMember::where('user_id', auth()->guard('student')->user()->id)->value('group_id');
        $project = Project::where('group_id', $group_id)->first();
        return view('frontend.student.project.reportSubmission', compact('project'));
    }

    public function reportStore(Request $request, Project $project)
    {

        $id = Auth::guard('student')->user()->id;
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file.*' => 'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg',
        ]);


        try {
            DB::beginTransaction();
            $project_report = ProjectReport::create([
                'project_id' => $project->id,
                'user_id' => $id,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('projectReports', $filename, 'public');
                    $new_file = File::create([
                        'project_report_id' => $project_report->id,
                        'filename' => $filename,
                    ]);
                }
            }
            DB::commit();

            return redirect()->back()->withMessage('Report Submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating Report: ' . $e->getMessage());
        }
    }
}
