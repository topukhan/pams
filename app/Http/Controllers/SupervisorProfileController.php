<?php

namespace App\Http\Controllers;
use App\Models\Domain;
use App\Models\Supervisor;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SupervisorProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('supervisor')->user()->id;
        $user = User::with('supervisor')->find($user_id);
        return view('frontend.supervisor.profile.profile', compact('user'));
        

    }

    public function edit(){
        $domains = Domain::all();
        return view('frontend.supervisor.profile.profileEdit', compact('domains'));
    }

    

}
