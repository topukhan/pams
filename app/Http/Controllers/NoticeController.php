<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\GroupMember;
use App\Models\Notice;
use App\Models\Project;
use App\Models\User;
use App\Notifications\NoticeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{

    //Supervisor Make Notice
    public function create()
    {
        $id = Auth::guard('supervisor')->user()->id;
        $projects = Project::where('supervisor_id', $id)->get();
        return view('frontend.supervisor.notice.notice', compact('projects'));
    }

    // Supervisor Store notice
    public function store(Request $request)
    {
        $id = Auth::guard('supervisor')->user()->id;
        $request->validate([
            'notice' => 'required',
            'title' => 'required',
            'file.*' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png',
        ]);
        try {
            DB::beginTransaction();
            $notice = Notice::create([
                'group_id' => $request->title,
                'user_id' => $id,
                'notice' => $request->notice,
            ]);
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('notices', $filename, 'public');
                    $new_file = File::create([
                        'notice_id' => $notice->id,
                        'filename' => $filename,
                    ]);
                }
            }
            DB::commit();
            // for student notify
            $members = GroupMember::where('group_id', $notice->group_id)->get();
            $students = User::whereIn('id', $members->pluck('user_id'))->get();
            foreach ($students as $student) {
                $student->notify(new NoticeNotification($notice));
            }
            return redirect()->route('supervisor.noticeCreate')->withMessage('Notice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating notice: ' . $e->getMessage());
        }
    }

    ///////////////student
    // notice list
    public function noticeList()
    {
        $user = Auth::guard('student')->user();

        if ($user) {
            $groupMember = GroupMember::where('user_id', $user->id)->first();
            if ($groupMember) {
                $group_id = GroupMember::where('user_id', $user->id)->value('group_id');
                $project = Project::where('group_id', $group_id)->first();
                $coordinator_id = User::where('role', 'coordinator')->value('id');
                $filtered_notices = null;
                $filtered_notices_ids = [];
                if ($project) {
                    $phase = $project->phase;
                    $coordinator_notices = Notice::where('user_id', $coordinator_id)->get();
                    foreach ($coordinator_notices as $notice) {
                        if ($phase != 'completed') {
                            if ($notice->$phase == 1) {
                                $filtered_notices_ids[] = $notice->id;
                            }
                        }
                    }
                    $filtered_notices = Notice::whereIn('id', $filtered_notices_ids)->get();
                }


                $notices = Notice::where('group_id', $groupMember->group_id)->get();
                return view('frontend.student.notice.noticeList', compact('notices', 'filtered_notices'));
            }
        }
    }
    //  notice view for students
    public function notice($notice_id)
    {
        $notice = Notice::where('id', $notice_id)->first();
        return view('frontend.student.notice.notice', compact('notice'));
    }

    public function noticeCreate()
    {

        return view('frontend.coordinator.notice.notice');
    }
}
