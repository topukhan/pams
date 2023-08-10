<?php

namespace App\Http\Controllers;

use App\Models\ApprovedGroup;
use App\Models\Domain;
use App\Models\Group;
use App\Models\GroupJoinRequest;
use App\Models\ProjectProposal;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function supervisorAvailability()
    {
        $supervisors = Supervisor::all();
        return view('frontend.student.supervisorAvailability', ['supervisors' => $supervisors]);
    }


    //Proposal Form
    public function proposalForm(Request $request)
    {
        $supervisors = Supervisor::all();
        $groups = Group::all();
        $domains = Domain::all();
        $id = $request->id;
        $existInProposal = ProjectProposal::pluck('group_id')->unique()->values()->toArray();
        // Get the group IDs that exist in the approved groups table
        $existInApproved = ApprovedGroup::pluck('group_id')->toArray();
        // Merge the two arrays to get all the disabled group IDs
        $disabledGroupIds = array_merge($existInProposal, $existInApproved);
        return view('frontend.student.proposalForm', compact('supervisors', 'id', 'domains', 'groups', 'disabledGroupIds'));
    }

    //Proposal Store in db
    public function storeProposalForm(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'title' => 'required',
            'course' => 'required',
            'supervisor_id' => 'required',
            'cosupervisor' => 'required',
            'domain' => 'required',
            'type' => 'required'
        ]);
        try {
            ProjectProposal::create([
                'group_id' => $request->group_id,
                'title' => $request->title,
                'course' => $request->course,
                'supervisor_id' => $request->supervisor_id,
                'cosupervisor' => $request->cosupervisor,
                'domain' => $request->domain,
                'type' => $request->type
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
    public function groupJoinRequest(Request $request)
    {
        try {
            $request->validate([
                'reason' => 'required'
            ]);

            GroupJoinRequest::create([
                'user_id' => $request->id,
                'reason' => $request->reason,
                'note' => $request->note
            ]);

            return redirect()->route('student.groupMemberRequest')->withMessage( 'Request Sent! Check back later');
        } catch (\Exception $e) {
            
            return redirect()->route('student.groupMemberRequest')->with('error', 'Request failed. Please try again later.');
        }
    }
}
