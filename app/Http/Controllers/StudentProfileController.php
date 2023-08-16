<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\ProjectType;
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
        $projectTypes = $user->projectTypes;
        $domains = $user->domains;
        // dd($domains);


        return view('frontend.student.profile', compact('user', 'projectTypes', 'domains'));
    }

    public function edit()
    {
        $domains = Domain::all();
        $user = Auth::guard('student')->user();
        $projectTypes = ProjectType::all();
        $domains = Domain::all();
        $selectedDomains = collect($user->domains->pluck('name'));
        $selectedProjectTypes = collect($user->projectTypes->pluck('name'));


        return view('frontend.student.profileEdit', compact('domains', 'projectTypes', 'domains', 'selectedDomains', 'selectedProjectTypes'));
    }


    public function update(Request $request, Student $student)
    {
        $request->validate([
            'project_type' => 'required|array',
        ]);

        try {
            $user = User::findOrFail($request->id);

            // Update project types
            $projectTypes = $request->input('project_type');
            $user->projectTypes()->sync($projectTypes);

            // Update domains
            $domains = $request->input('domain');
            $user->domains()->sync($domains);


            $studentData = [
                'project_type_status' => true,
            ];


            $user->student->update($studentData);

            return redirect()->route('student.profile')->withMessage('Edited Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
