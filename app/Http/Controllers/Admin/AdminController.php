<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coordinator;
use App\Models\Domain;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $user = Auth::guard('admin')->user();
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
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'role' => $request->role,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password)
            ]);

            Student::create([
                'user_id' => $user->id,
                'student_id' => $request->student_id,
                'batch' => $request->batch,
                'section' => $request->section,
                'shift' => $request->shift,
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }


        return redirect()->route('admin.addStudentForm')->withMessage("Student Added!");
    }
    //
    // Add Supervisor to Database table
    public function addSupervisor(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'faculty_id' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'phone_number' => $request->phone_number,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Supervisor::create([
                'user_id' => $user->id,
                'faculty_id' => $request->faculty_id,
                'designation' => $request->designation,
                'availability' => false,
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }


        return redirect()->route('admin.addSupervisorForm')->withMessage("Supervisor Added!");
    }
    public function addCoordinator(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'phone_number' => 'required',
            'faculty_id' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'phone_number' => $request->phone_number,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Coordinator::create([
                'user_id' => $user->id,
                'faculty_id' => $request->faculty_id,
                'designation' => $request->designation,
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }


        return redirect()->route('admin.addCoordinatorForm')->withMessage("Coordinator Added!");
    }
}
