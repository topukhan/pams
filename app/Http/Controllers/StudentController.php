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
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }


    // public function supervisorAvailability()
    // {
    //     $supervisors = Supervisor::all();
    //     $domains = Domain::all();
    //     return view('frontend.student.supervisorAvailability', compact('supervisors','domains'));
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
    //     return view('frontend.student.supervisorAvailability', compact('supervisors', 'domains'));
    // }

    public function supervisorAvailability(Request $request)
    {
        try {
            $domains = Domain::all();
            $query = Supervisor::query();
            if ($request->ajax()) {
                $selectedDomain = $request->input('domain');
                if ($selectedDomain) {
                    $supervisors = $query->where('domain', $selectedDomain)->get();
                }
                return response()->json(['supervisors' => $supervisors]);
            }
            $supervisors = $query->get();
            return view('frontend.student.supervisorAvailability', compact('supervisors', 'domains'));
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
    //         return view('frontend.student.supervisorAvailability', compact('supervisors', 'domains'));
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
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
        }
        $supervisors = Supervisor::all();
        $domains = Domain::all();

        
    // Check if a proposal from the group already exists
    $existingProposal = ProjectProposal::where('group_id', $group->id)->first();
    $proposalSubmitted = $existingProposal !== null;

        return view('frontend.student.proposalForm', compact('supervisors', 'domains', 'id', 'group', 'members', 'proposalSubmitted'));
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
        return view('frontend.student.proposalChangeForm');
    }

    //Pending Groups
    public function pendingGroups()
    {
        return view('frontend.student.pendingGroups');
    }

    //Pending Group Details 
    public function pendingGroupDetails()
    {
        return view('frontend.student.pendingGroupDetails');
    }

    // Profile

    public function profile()
    {
        return view('frontend.student.profile');
    }


    // Tasklist
    public function taskList()
    {
        return view('frontend.student.taskList');
    }

    // Task Details
    public function taskDetails()
    {
        return view('frontend.student.taskDetails');
    }

    // Upcoming Events
    public function upcomingEvents()
    {
        return view('frontend.student.upcomingEvents');
    }

    // Upcoming Event Details
    public function upcomingEventDetails()
    {
        return view('frontend.student.upcomingEventDetails');
    }

    // Assistance
    public function assistance()
    {
        return view('frontend.student.assistance');
    }

    // Change Password
    public function changePassword()
    {
        return view('frontend.student.changePassword');
    }

    // previous Projects
    public function previousProjects()
    {
        return view('frontend.student.previousProjects');
    }

    // group member Request
    public function groupMemberRequest()
    {
        $id = Auth::guard('student')->user()->id;
        return view('frontend.student.groupMemberRequest', compact('id'));
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
        return view('frontend.student.requestToCoordinator', compact('group_id'));
    }
}
