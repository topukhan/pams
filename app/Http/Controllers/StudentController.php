<?php

namespace App\Http\Controllers;

use App\Models\Student;
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

    

    // Create Group
    public function createGroup(){
        return view('frontend.student.createGroup');
    }

    //Proposal Form
    public function proposalForm(){
        return view('frontend.student.proposalForm');
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

    //My Group
    public function myGroup(){
        return view('frontend.student.myGroup');
    }

    //My Group Details 
    public function myGroupDetails(){
        return view('frontend.student.myGroupDetails');
    }

    // Student Logout / Session destroy
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }
}
