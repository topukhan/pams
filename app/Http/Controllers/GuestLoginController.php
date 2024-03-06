<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestLoginController extends Controller
{
    public function guestStudent(Request $request){
        $studentMail = 'guest.student@gmail.com';
        $password = '12345678';

        // Check if user has the role of "student"
        $user = User::where('email', $studentMail)->first();
        if (!$user || $user->role != 'student') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }

        $credentials = [
            'email' =>  $studentMail,
            'password' => $password
        ];
        

        if (Auth::guard('student')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('student.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
 
    public function guestSupervisor(Request $request){
        $supervisorMail = 'guest.supervisor@gmail.com';
        $password = '12345678';

        // Check if user has the role of "supervisor"
        $user = User::where('email', $supervisorMail)->first();
        if (!$user || $user->role != 'supervisor') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }

        $credentials = [
            'email' =>  $supervisorMail,
            'password' => $password
        ];
        

        if (Auth::guard('supervisor')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
    public function guestCoordinator(Request $request){
        $coordinatorMail = 'guest.coordinator@gmail.com';
        $password = '12345678';

        // Check if user has the role of "coordinator"
        $user = User::where('email', $coordinatorMail)->first();
        if (!$user || $user->role != 'coordinator') {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Invalid input. Please provide a valid email address.',
            ]);
        }

        $credentials = [
            'email' =>  $coordinatorMail,
            'password' => $password
        ];
        

        if (Auth::guard('coordinator')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('coordinator.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
}
