<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Notice;
use App\Models\Project;
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
            // dd($notice);
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $filename = $file->getClientOriginalName();
                    // dd($filename);
                    $file->storeAs('files', $filename, 'public');

                    $new_file = File::create([
                        'notice_id' => $notice->id,
                        'filename' => $filename,
                    ]);
                    // dd($new_file);
                }
            }
            // dd('hereeee');
            DB::commit();
            return redirect()->route('supervisor.noticeCreate')->with('success', 'Notice created successfully.');
        } catch (\Exception $e) {
            dd('in roll');
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating notice: ' . $e->getMessage());
        }
    }


    // notice
    public function notice()
    {
        return view('frontend.student.notice.notice');
    }
}
