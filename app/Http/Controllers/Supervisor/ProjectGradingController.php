<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Phase1;
use App\Models\Phase2;
use App\Models\Phase3;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectGradingController extends Controller
{
    //Supervisor Evaluation
    public function evaluateGroups()
    {
        $id = auth()->guard('supervisor')->user()->id;
        $projects = Project::where('supervisor_id', $id)->get();
        return view('frontend.supervisor.evaluate.groups',  compact('projects'));
    }
    //Supervisor Evaluation
    public function evaluation(Request $request, Project $project, Group $group)
    {
        $phase1 = Phase1::where('project_id', $project->id)->get();
        // dd($phase1);
        $supervisor = User::find($project->supervisor_id);
        $members = null;
        $phase1_marks = null;
        $phase2_marks = null;
        $phase3_marks = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
            $phase1_marks = Phase1::where('project_id', $project->id)->get();
            $phase2_marks = Phase2::where('project_id', $project->id)->get();
            $phase3_marks = Phase3::where('project_id', $project->id)->get();
            // dd($phase1_marks);
        }

        return view('frontend.supervisor.evaluate.evaluation', compact('group', 'project', 'members', 'supervisor', 'phase1_marks', 'phase2_marks', 'phase3_marks'));
    }

    public function phase1Store(Request $request)
    {
        $phase1_marks = Phase1::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);

        $rules = [
            'examiner_1_mark.*' => 'required|numeric|min:0|max:100',  // Allow any numeric value (float or integer)
            'examiner_2_mark.*' => 'required|numeric|max:100',
            'examiner_3_mark.*' => 'required|numeric|max:100',
            'examiner_average.*' => 'required|numeric',
            'attendance.*' => 'required|numeric|max:10',
            'project_development.*' => 'required|numeric|max:30',
            'report_preparation.*' => 'required|numeric|max:20',
            'total.*' => 'required|numeric|max:100',
        ];

        $custom_messages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'min' => 'The :attribute field must be at least :min.',
            'max' => 'The :attribute field may not be greater than :max.',
        ];

        $validated_marks = $request->validate($rules, $custom_messages);

        if ($phase1_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {
                    $count = 0;
                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase1 = Phase1::create([
                            'project_id' => $project->id,
                            'user_id' => $request->user_id[$key],
                            'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                            'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                            'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                            'examiner_average' => $validated_marks['examiner_average'][$key],
                            'attendance' => $validated_marks['attendance'][$key],
                            'project_development' => $validated_marks['project_development'][$key],
                            'report_preparation' => $validated_marks['report_preparation'][$key],
                            'total' => $validated_marks['total'][$key],
                        ]);
                        if ($phase1) {
                            $count++;
                        }
                    }
                    return redirect()->back()->with('message', "Marks Added Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
        if (!$phase1_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {

                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase1 = Phase1::where('project_id', $project->id)
                            ->where('user_id', $request->user_id[$key])
                            ->update([
                                'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                                'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                                'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                                'examiner_average' => $validated_marks['examiner_average'][$key],
                                'attendance' => $validated_marks['attendance'][$key],
                                'project_development' => $validated_marks['project_development'][$key],
                                'report_preparation' => $validated_marks['report_preparation'][$key],
                                'total' => $validated_marks['total'][$key],
                            ]);
                    }
                    return redirect()->back()->with('message', "Marks Updated Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
    }
    public function phase2Store(Request $request)
    {
        $phase2_marks = Phase2::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);

        $rules = [
            'examiner_1_mark.*' => 'required|numeric|min:0|max:100',  // Allow any numeric value (float or integer)
            'examiner_2_mark.*' => 'required|numeric|max:100',
            'examiner_3_mark.*' => 'required|numeric|max:100',
            'examiner_average.*' => 'required|numeric',
            'attendance.*' => 'required|numeric|max:10',
            'project_development.*' => 'required|numeric|max:30',
            'report_preparation.*' => 'required|numeric|max:20',
            'total.*' => 'required|numeric|max:100',
        ];

        $custom_messages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'min' => 'The :attribute field must be at least :min.',
            'max' => 'The :attribute field may not be greater than :max.',
        ];

        $validated_marks = $request->validate($rules, $custom_messages);

        if ($phase2_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {
                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase2 = Phase2::create([
                            'project_id' => $project->id,
                            'user_id' => $request->user_id[$key],
                            'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                            'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                            'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                            'examiner_average' => $validated_marks['examiner_average'][$key],
                            'attendance' => $validated_marks['attendance'][$key],
                            'project_development' => $validated_marks['project_development'][$key],
                            'report_preparation' => $validated_marks['report_preparation'][$key],
                            'total' => $validated_marks['total'][$key],
                        ]);
                    }
                    return redirect()->back()->with('message', "Marks Added Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
        if (!$phase2_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {

                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase1 = Phase2::where('project_id', $project->id)
                            ->where('user_id', $request->user_id[$key])
                            ->update([
                                'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                                'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                                'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                                'examiner_average' => $validated_marks['examiner_average'][$key],
                                'attendance' => $validated_marks['attendance'][$key],
                                'project_development' => $validated_marks['project_development'][$key],
                                'report_preparation' => $validated_marks['report_preparation'][$key],
                                'total' => $validated_marks['total'][$key],
                            ]);
                    }
                    return redirect()->back()->with('message', "Marks Updated Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
    }
    public function phase3Store(Request $request)
    {
        $phase3_marks = Phase3::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);

        $rules = [
            'examiner_1_mark.*' => 'required|numeric|min:0|max:100',  // Allow any numeric value (float or integer)
            'examiner_2_mark.*' => 'required|numeric|max:100',
            'examiner_3_mark.*' => 'required|numeric|max:100',
            'examiner_average.*' => 'required|numeric',
            'attendance.*' => 'required|numeric|max:10',
            'project_development.*' => 'required|numeric|max:30',
            'report_preparation.*' => 'required|numeric|max:20',
            'total.*' => 'required|numeric|max:100',
        ];

        $custom_messages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'min' => 'The :attribute field must be at least :min.',
            'max' => 'The :attribute field may not be greater than :max.',
        ];

        $validated_marks = $request->validate($rules, $custom_messages);

        if ($phase3_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {
                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase3 = Phase3::create([
                            'project_id' => $project->id,
                            'user_id' => $request->user_id[$key],
                            'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                            'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                            'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                            'examiner_average' => $validated_marks['examiner_average'][$key],
                            'attendance' => $validated_marks['attendance'][$key],
                            'project_development' => $validated_marks['project_development'][$key],
                            'report_preparation' => $validated_marks['report_preparation'][$key],
                            'total' => $validated_marks['total'][$key],
                        ]);
                    }
                    return redirect()->back()->with('message', "Marks Added Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
        if (!$phase3_marks->isEmpty()) {
            
            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {

                    foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                        $phase3 = Phase3::where('project_id', $project->id)
                            ->where('user_id', $request->user_id[$key])
                            ->update([
                                'examiner_1_mark' => $validated_marks['examiner_1_mark'][$key],
                                'examiner_2_mark' => $validated_marks['examiner_2_mark'][$key],
                                'examiner_3_mark' => $validated_marks['examiner_3_mark'][$key],
                                'examiner_average' => $validated_marks['examiner_average'][$key],
                                'attendance' => $validated_marks['attendance'][$key],
                                'project_development' => $validated_marks['project_development'][$key],
                                'report_preparation' => $validated_marks['report_preparation'][$key],
                                'total' => $validated_marks['total'][$key],
                            ]);
                    }
                    return redirect()->back()->with('message', "Marks Updated Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
    }
}
