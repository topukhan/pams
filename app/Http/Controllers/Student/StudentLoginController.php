<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use App\Models\Notice;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class StudentLoginController extends Controller
{
    // student login View Form
    public function showLoginForm()
    {
        return view('frontend.student.login');
    }

    // Handle an authentication attempt for the student.
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user has the role of "student"
        $user = User::where('email', $request->email)->first();
        if (!$user || $user->role != 'student') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('student.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    //Student Dashboard View
    public function dashboard()
    {
        $user = Auth::guard('student')->user();
        // Retrieve the additional student data from the 'students' table using the authenticated user's ID
        $studentData = Student::where('user_id', $user->id)->first();
        // Check if the student data exists
        if ($studentData) {
            // Store the $studentData in the session as 'studentData'
            session()->put('studentData', $studentData);
        }
        session()->put('studentUser', $user);

        $group_id = GroupMember::where('user_id', $user->id)->value('group_id');
        $project = Project::where('group_id', $group_id)->first();
        $notices = Notice::where('group_id', $group_id)->get();
        ////////////////////////////////////////
        $coordinator_id = User::where('role', 'coordinator')->value('id');
        $filtered_notices_ids = [];
        if ($project) {
            $phase = $project->phase;
            $coordinator_notices = Notice::where('user_id', $coordinator_id)->get();
            foreach ($coordinator_notices as $notice) {
                if ($phase != 'completed') {
                    if ($notice->$phase == 1) {
                        $filtered_notices_ids[] = $notice->id;
                    }
                }
            }
        }

        $filtered_notices = Notice::whereIn('id', $filtered_notices_ids)->get();

        ///////////////////////////////////


        return view('frontend.student.dashboard.dashboard', compact('project', 'notices', 'group_id', 'filtered_notices'));
    }

    // Student Logout / Session destroy
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        session()->forget('studentUser');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login');
    }
}
