<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
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
        $domains = $user->domains;
        return view('frontend.supervisor.profile.profile', compact('user','domains'));
        

    }

    public function edit(){
        $domains = Domain::all();
        $user = Auth::guard('supervisor')->user();
        $selectedDomains = collect($user->domains->pluck('name'));
        return view('frontend.supervisor.profile.profileEdit', compact('domains','selectedDomains', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'availability' => 'required',
            'domain' => 'required|array',
        ]);

        try {
            $user = User::findOrFail($request->id);


            // Update domains
            $domains = $request->input('domain');
            $user->domains()->sync($domains);
            
            $Data = [
                'availability' => $request->availability,
            ];
            $user->supervisor->update($Data);

            return redirect()->route('supervisor.profile')->withMessage('Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    

}
