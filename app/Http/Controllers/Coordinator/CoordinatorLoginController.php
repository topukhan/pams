<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordinatorLoginController extends Controller
{
    // coordinator login View Form
    public function showLoginForm()
    {
        return view('frontend.coordinator.login');
    }

    // Handle an authentication attempt for the coordinator.
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user has the role of "coordinator"
        $user = User::where('email', $request->email)->first();
        if (!$user || $user->role != 'coordinator') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }
        
        $credentials = $request->only('email', 'password');
        if (Auth::guard('coordinator')->attempt($credentials, $request->remember)) {
            
            // dd('here');
            return redirect()->intended(route('coordinator.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    //coordinator Dashboard View
    public function dashboard()
    {
        $user = Auth::guard('coordinator')->user();
        // View::share('user', $user);
        // dd($user);
        session()->put('coordinatorUser', $user);
        // dd(session());
        return view('frontend.coordinator.dashboard');
    }

    // coordinator Logout / Session destroy
    public function logout(Request $request)
    {
        Auth::guard('coordinator')->logout();

        session()->forget('coordinatorUser');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('coordinator.login');
    }
}
