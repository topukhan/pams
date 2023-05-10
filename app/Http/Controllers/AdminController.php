<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

    // Add student form view
    public function addStudentForm()
    {
        return view('backend.admin.addStudent');
    }

    // Add Student to Database table
    public function addStudent(Request $request)
    {
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'department' => 'required',
        //     'batch' => 'required',
        //     'section' => 'required',
        //     'shift' => 'required',
        //     'student_id' => 'required',
        //     'phone_number' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        
        try {
                User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department' => $request->department,
                'role' => $request->role,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password)
            ]);
            dd('worked');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        // Additional info stored in students table
        // try {
        //     Student::create([
        //         'user_id' => $user->id,
        //         'student_ID' => $request->student_id,
        //         'batch' => $request->batch,
        //         'section' => $request->section,
        //         'shift' => $request->shift,
        //     ]);
        // } catch (QueryException $e) {
        //     return redirect()->back()->withInput()->withErrors('Something went wrong!');
        // }

        return redirect()->route('admin.addStudentForm')->withMessage("Student Added!");
    }
}
