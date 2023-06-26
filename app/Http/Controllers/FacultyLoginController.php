<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        $user = Auth::guard('faculty')->user();
        // View::share('user', $user);
        // dd($user);
        session()->put('facultyUser', $user);
        // dd(session());
        return view('frontend.supervisor.dashboard');
    }

    // Faculty Logout / Session destroy
    public function logout(Request $request)
    {
        Auth::guard('faculty')->logout();

        session()->forget('facultyUser');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('faculty.login');
    }
}
