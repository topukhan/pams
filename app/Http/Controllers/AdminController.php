<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $user = Auth::guard('admin')->user();
        // dd($user);
        // View::share('user', $user);
        session()->put('adminUser', $user);
        return view('backend.admin.dashboard');
    }

    // Add student form view
    public function addStudentForm()
    {
        return view('backend.admin.addStudent');
    }

    // Add Supervisor form view
    public function addSupervisorForm()
    {
        $domains = Domain::all();
        return view('backend.admin.addSupervisor', compact('domains'));
    }

    // Add Coordinator form view
    public function addCoordinatorForm()
    {
        
        return view('backend.admin.addCoordinator');
    }

    // Add Student to Database table
    public function addStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'batch' => 'required',
            'section' => 'required|max:1',
            'shift' => 'required',
            'student_id' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        
        try {
                $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'role' => $request->role,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password)
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        // Additional info stored in students table
        try {
            Student::create([
                'user_id' => $user->id,
                'student_id' => $request->student_id,
                'batch' => $request->batch,
                'section' => $request->section,
                'shift' => $request->shift,
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }

        return redirect()->route('admin.addStudentForm')->withMessage("Student Added!");
    }
    //
    // Add Student to Database table
    public function addSupervisor(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'faculty_id' => 'required',
            'designation' => 'required',
            'expertise_area' => 'required',
            'availability' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        
        try {
                $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'phone_number' => $request->phone_number,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        // Additional info stored in Supervisor table
        try {
            Supervisor::create([
                'user_id' => $user->id,
                'faculty_id' => $request->faculty_id,
                'designation' => $request->designation,
                'availability' => $request->availability,
                'expertise_area' => $request->expertise_area,
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }

        return redirect()->route('admin.addSupervisorForm')->withMessage("Supervisor Added!");
    }
}
