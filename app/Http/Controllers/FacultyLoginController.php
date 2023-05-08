<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyLoginController extends Controller
{
    // Faculty login View Form
    public function showLoginForm()
    {
        return view('frontend.supervisor.login');
    }

    // Handle an authentication attempt for the Faculty.
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user has the role of "supervisor"
        $user = User::where('email', $request->email)->first();
        if (!$user || $user->role != 'supervisor') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::guard('faculty')->attempt($credentials, $request->remember)) {
            // dd('Faculty Login:');
            // Authentication passed...
            // Guard Changed to faculty
            
            // Auth::shouldUse('faculty'); 
            // dd('first here ');
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    //Supervisor Dashboard View
    public function dashboard()
    {
        return view('frontend.supervisor.dashboard');
    }
}