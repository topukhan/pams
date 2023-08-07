<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('student')->user()->id;
        $user = User::with('student')->find($user_id);
        return view('frontend.student.profile', compact('user'));
    }

    public function edit(){
        $domains = Domain::all();
        return view('frontend.student.profileEdit', compact('domains'));
    }

    public function update(Request $request, Student $student){
        $request->validate([
            'project_type' => 'required',
        ]);
        
        try {
            $user = User::findOrFail($request->id);
            $studentData = [
                'project_type' => json_encode($request->project_type),
                'project_type_status' => true,
            ];
        
            // Check if $request->domain has a value, then include it in the update data.
            if (!is_null($request->domain)) {
                $studentData['domain'] = json_encode($request->domain);
            }
        
            $user->student->update($studentData);
            return redirect()->route('student.profile')->withMessage('Edited Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
