<?php

namespace App\Http\Controllers;

use App\Models\ProjectProposal;
use App\Models\Student;
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

    

   


    //Proposal Form
    public function proposalForm(){
        return view('frontend.student.proposalForm');
    }

    //Proposal Form
    public function storeproposalForm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'course' => 'required',
            'supervisor' => 'required',
            'cosupervisor' => 'required',
            'domain' => 'required',
            'type' => 'required'
        ]);
        dd("k");
        
        try {
            ProjectProposal::create([
                'title'=> $request->title,
                'course'=> $request->course,
                'supervisor'=> $request->supervisor,
                'cosupervisor'=> $request->cosupervisor,
                'domain'=> $request->domain,
                'type'=> $request->type
            ]);
            return redirect()->route('student.dashboard')->withMessage("Group Has Been Created!");
        } catch (QueryException $e) {
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
