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
             'files.*' => 'nullable|file|mimes:pdf,doc,docx', 
         ]);
         try {
             DB::beginTransaction();
             $notice = Notice::create([
                 'group_id' => $request->title,
                 'user_id' => $id,
                 'notice' => $request->notice,
             ]);
             if ($request->hasFile('files')) {
                 foreach ($request->file('files') as $file) {
                     $filename = $file->getClientOriginalName();
                     $file->storeAs('files', $filename, 'public');
         
                     File::create([
                         'notice_id' => $notice->id, 
                         'filename' => $filename,
                     ]);
                 }
             }
             DB::commit();
             return redirect()->route('supervisor.noticeCreate')->with('success', 'Notice created successfully.');
         } catch (\Exception $e) {
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
