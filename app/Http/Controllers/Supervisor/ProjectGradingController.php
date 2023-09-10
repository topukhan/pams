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
        $supervisor = User::find($project->supervisor_id);
        $members = null;
        $phase1_marks = null;
        $phase2_marks = null;
        $phase3_marks = null;
        $project1_marks = null;
        $project2_marks = null;
        if ($group) {
            $memberIds = GroupMember::where('group_id', $group->id)->pluck('user_id')->toArray();
            $members = User::whereIn('id', $memberIds)->get();
            $phase1_marks = Phase1::where('project_id', $project->id)->get();
            $phase2_marks = Phase2::where('project_id', $project->id)->get();
            $phase3_marks = Phase3::where('project_id', $project->id)->get();
            foreach ($members as $member) {
                $phase1_mark = $phase1_marks->where('user_id', $member->id)->first();
                $phase2_mark = $phase2_marks->where('user_id', $member->id)->first();

                // Check if both phase1 and phase2 marks exist for the user
                if ($phase1_mark && $phase2_mark) {
                    // Calculate the average of phase1 and phase2 marks
                    $average_mark = ($phase1_mark->total + $phase2_mark->total) / 2;

                    // Store the average mark in the $project1_marks array with user_id
                    $project1_marks[$member->id] = $average_mark;
                }
            }
        }

        return view('frontend.supervisor.evaluate.evaluation', compact('group', 'project', 'members', 'project1_marks', 'project2_marks', 'supervisor', 'phase1_marks', 'phase2_marks', 'phase3_marks'));
    }

    public function phase1Store(Request $request)
    {
        $phase1_marks = Phase1::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);
        $members_count = GroupMember::where('group_id', $project->group_id)->count();
        $marks_count = Phase1::where('project_id', $request->project_id)->count();

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
        //Create
        if ($phase1_marks->isEmpty()) {

            if ($project) {
                if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {

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
                    }
                    return redirect()->back()->with('message', "Marks Added Successfully");
                } else {

                    return redirect()->back()->with('error', "You Can't Evaluate This Group");
                }
            } else {
                return redirect()->back()->with('error', "Project Not Found");
            }
        }
        //Update
        if (!$phase1_marks->isEmpty()) {
            $can_mark = Phase3::where('project_id', $project->id)->doesntExist();
            //phase 3 mark is not given and given marks count and group members count are not equal 
            // means someones mark is not given yet
            if ($can_mark || $members_count != $marks_count) {
                $can_mark = true;
            } else {
                $can_mark = false;
            }

            if ($can_mark) {
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
                            if (!$phase1) {
                                Phase1::create([
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
                        }
                        return redirect()->back()->with('message', "Marks Updated Successfully");
                    } else {

                        return redirect()->back()->with('error', "You Can't Evaluate This Group");
                    }
                } else {
                    return redirect()->back()->with('error', "Project Not Found");
                }
            } else {
                return redirect()->back()->with('error', "Marks Already Given For The Project You Selected.");
            }
        }
    }
    public function phase2Store(Request $request)
    {
        $phase2_marks = Phase2::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);
        $members_count = GroupMember::where('group_id', $project->group_id)->count();
        $marks_count = Phase2::where('project_id', $request->project_id)->count();

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
        //Create
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
        ////Update
        if (!$phase2_marks->isEmpty()) {
            $can_mark = Phase3::where('project_id', $project->id)->doesntExist();
            //phase 3 mark is not given and given marks count and group members count are not equal 
            // means someones mark is not given yet
            if ($can_mark || $members_count != $marks_count) {
                $can_mark = true;
            } else {
                $can_mark = false;
            }

            if ($can_mark) {
                if ($project) {
                    if ($project->supervisor_id == auth()->guard('supervisor')->user()->id) {

                        foreach ($validated_marks['examiner_1_mark'] as $key => $value) {
                            $phase2 = Phase2::where('project_id', $project->id)
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
                            if (!$phase2) {
                                Phase2::create([
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
                        }
                        return redirect()->back()->with('message', "Marks Updated Successfully");
                    } else {

                        return redirect()->back()->with('error', "You Can't Evaluate This Group");
                    }
                } else {
                    return redirect()->back()->with('error', "Project Not Found");
                }
            } else {
                return redirect()->back()->with('error', "Marks Already Given For The Project You Selected.");
            }
        }
    }
    public function phase3Store(Request $request)
    {
        $phase3_marks = Phase3::where('project_id', $request->project_id)->get();
        $project = Project::find($request->project_id);
        $members_count = GroupMember::where('group_id', $project->group_id)->count();
        $marks_count = Phase3::where('project_id', $request->project_id)->count();

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
        // Create
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
        //// Update
        if (!$phase3_marks->isEmpty()) {
            $can_mark = Phase3::where('project_id', $project->id)->doesntExist();
            //phase 3 mark is not given and given marks count and group members count are not equal 
            // means someones mark is not given yet
            if ($can_mark || $members_count != $marks_count) {
                $can_mark = true;
            } else {
                $can_mark = false;
            }

            if ($can_mark) {
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
                            if (!$phase3) {
                                Phase3::create([
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
                        }
                        return redirect()->back()->with('message', "Marks Updated Successfully");
                    } else {

                        return redirect()->back()->with('error', "You Can't Evaluate This Group");
                    }
                } else {
                    return redirect()->back()->with('error', "Project Not Found");
                }
            } else {
                return redirect()->back()->with('error', "Marks Already Given For The Project You Selected.");
            }
        }
    }
}
