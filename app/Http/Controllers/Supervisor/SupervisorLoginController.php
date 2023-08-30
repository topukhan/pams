<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorLoginController extends Controller
{
    //
    // Supervisor login View Form
    public function showLoginForm()
    {
        return view('frontend.supervisor.login');
    }

    // Handle an authentication attempt for the Supervisor.
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
        if (Auth::guard('supervisor')->attempt($credentials, $request->remember)) {
            
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    //Supervisor Dashboard View
    public function dashboard()
    {
        $user = Auth::guard('supervisor')->user();
        session()->put('supervisorUser', $user);
        return view('frontend.supervisor.dashboard.dashboard');
    }

    // Supervisor Logout / Session destroy
    public function logout(Request $request)
    {
        Auth::guard('supervisor')->logout();
        session()->forget('supervisorUser');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('supervisor.login');
    }
}
