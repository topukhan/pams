<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // Auth::shouldUse('student');
            return redirect()->intended(route('student.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    //Student Dashboard View
    public function dashboard()
    {
        return view('frontend.student.dashboard');
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
