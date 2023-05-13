<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\ProjectProposal;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Group;

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

    
    public function supervisorAvailability(){
        $supervisors = Supervisor::all();
        return view('frontend.student.supervisorAvailability', ['supervisors'=>$supervisors]);
    }


    //Proposal Form
    public function proposalForm(Request $request){
        $supervisors = Supervisor::all();
        $domains = Domain::all();
        $id = $request->id;
        return view('frontend.student.proposalForm', ['supervisors'=>$supervisors, 'id'=> $id, 'domains'=>$domains]);
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
            'type' => 'required'
        ]);
        try {
            ProjectProposal::create([
                'title'=> $request->title,
                'course'=> $request->course,
                'supervisor_id'=> $request->supervisor_id,
                'cosupervisor'=> $request->cosupervisor,
                'domain'=> $request->domain,
                'type'=> $request->type
            ]);
            return redirect()->route('student.dashboard')->withMessage("Proposal Submitted!");
        } catch (QueryException $e) {
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }
        
    


    //Proposal Change Form
    public function proposalChangeForm(){
        return view('frontend.student.proposalChangeForm');
    }

    //Pending Groups
    public function pendingGroups(){
        return view('frontend.student.pendingGroups');
    }

    //Pending Group Details 
    public function pendingGroupDetails(){
        return view('frontend.student.pendingGroupDetails');
    }

    
}
