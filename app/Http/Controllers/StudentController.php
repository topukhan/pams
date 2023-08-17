<?php

namespace App\Http\Controllers;

use App\Models\ApprovedGroup;
use App\Models\Domain;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\ProjectProposal;
use App\Models\RequestToCoordinator;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{
    // public function supervisorAvailability()
    // {
    //     $supervisors = Supervisor::all();
    //     $domains = Domain::all();
    //     return view('frontend.student.dashboard.supervisorAvailability', compact('supervisors','domains'));
    // }


    // public function supervisorAvailability(Request $request)
    // {
    //     $query = Supervisor::query();
    //     $domains = Domain::all();
    //     if ($request->ajax()) {
    //         $selectedDomain = $request->input('domain');
    //         $supervisors = $query->where('domain', $selectedDomain)->get();         
    //         return response()->json(['supervisors' => $supervisors]);
    //     }    
    //     $supervisors = $query->get();    
    //     return view('frontend.student.dashboard.supervisorAvailability', compact('supervisors', 'domains'));
    // }

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
                    $supervisors = Supervisor::whereIn('user_id', $supervisorUserIds)->get();

                    // Log::debug('Selected Domain: ' . $selectedDomain);
                    // Log::debug('Supervisor User IDs: ' . $supervisorUserIds->implode(', '));
                } else {
                    $supervisors = [];
                }

                return response()->json(['supervisors' => $supervisors]);
            }

            $supervisors = Supervisor::all();

            return view('frontend.student.dashboard.supervisorAvailability', compact('supervisors', 'domains'));
        } catch (\Exception $e) {
            Log::error('Error retrieving supervisors: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while loading data.'], 500);
        }
    }


    // public function supervisorAvailability(Request $request)
    //     {
    //         $query = Supervisor::query();
    //         $domains = Domain::all();
    //         if ($request->ajax()) {
    //             $supervisors = $query->where(['domain'=>$request->domain])->get();
    //             return response()->json(['supervisors' => $supervisors]);
    //         }     
    //         $supervisors = $query->get();     
    //         return view('frontend.student.dashboard.supervisorAvailability', compact('supervisors', 'domains'));
    //     }



    public function proposalForm(Request $request)
    {
        $id = Auth::guard('student')->user()->id;
        $group = Group::where('id', function ($query) use ($id) {
            $query->select('group_id')
                ->from('group_members')
                ->where('user_id', $id)
                ->first();
        })->first();
        $members = null;
        $proposalSubmitted = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
            // Check if a proposal from the group already exists
            $existingProposal = ProjectProposal::where('group_id', $group->id)->first();
            $proposalSubmitted = $existingProposal !== null;
        }
        $supervisors = Supervisor::all();
        $domains = Domain::all();
        return view('frontend.student.proposal.proposalForm', compact('supervisors', 'domains', 'id', 'group', 'members', 'proposalSubmitted'));
    }


    //Proposal Store in db
    public function storeProposalForm(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'course' => 'required',
            'supervisor_id' => 'required',
            'cosupervisor' => 'required',
            'domain' => 'required',
            'project_type' => 'required',
            'description' => 'required'
        ]);
        try {
            ProjectProposal::create([
                'group_id' => $request->group_id,
                'title' => $request->title,
                'course' => $request->course,
                'supervisor_id' => $request->supervisor_id,
                'cosupervisor' => $request->cosupervisor,
                'domain' => $request->domain,
                'project_type' => $request->project_type,
                'description' => $request->description
            ]);
            return redirect()->route('student.dashboard')->withMessage("Proposal Submitted!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }

    //Proposal Change Form
    public function proposalChangeForm()
    {
        return view('frontend.student.proposal.proposalChangeForm');
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

    // group member Request
    public function groupMemberRequest()
    {
        $id = Auth::guard('student')->user()->id;
        return view('frontend.student.request.groupMemberRequest', compact('id'));
    }

    // Request for join a group 
    public function requestToCoordinator(Request $request)
    {

        try {
            $request->validate([
                'reason' => 'required'
            ]);

            if ($request->id) {
                RequestToCoordinator::create([
                    'user_id' => $request->id,
                    'reason' => $request->reason,
                    'note' => $request->note
                ]);
            } else {
                RequestToCoordinator::create([
                    'group_id' => $request->group_id,
                    'reason' => $request->reason,
                    'note' => $request->note
                ]);
            }


            return redirect()->route('student.groupMemberRequest')->withMessage('Request Sent! Check back later');
        } catch (\Exception $e) {

            return redirect()->route('student.groupMemberRequest')->with('error', 'Request failed. Please try again later.');
        }
    }

    // requestToCoordinator
    public function requestToCoordinatorForm(Request $request)
    {
        $group_id = $request->group_id;
        return view('frontend.student.request.requestToCoordinator', compact('group_id'));
    }
}
