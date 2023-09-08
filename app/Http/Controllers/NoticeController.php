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

    //Supervisor Notice
    public function create()
    {
        $id = Auth::guard('supervisor')->user()->id;
        $projects = Project::where('supervisor_id', $id)->get();
        return view('frontend.supervisor.notice.notice', compact('projects'));
    }

    public function store(Request $request)
    {
        $id = Auth::guard('supervisor')->user()->id;
        $request->validate([
            'notice' => 'required',
            'title' => 'required',
            'file.*' => 'nullable|file|mimes:pdf,doc,docx',
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
                    $filename = uniqid(). '_' . $file->getClientOriginalName();
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
            dd('in catch');
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
                
                $notices = Notice::where('group_id', $groupMember->group_id)->get();
                return view('frontend.student.notice.noticeList', compact('notices'));
            }
        }
    }
    //  notice
    public function notice($notice_id)
    {
        $notice = Notice::where('id', $notice_id)->first();
        return view('frontend.student.notice.notice', compact('notice'));
    }
}
