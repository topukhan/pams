<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoordinatorController extends Controller
{

    public function noticeStore(Request $request)
    {
        $id = Auth::guard('coordinator')->user()->id;
        $request->validate([
            'notice' => 'required',
            'title' => 'required',
            'phase' => 'required',
            'file.*' => 'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg',
        ]);
        $phases = [
            'phase1' => 0,
            'phase2' => 0,
            'phase3' => 0,
        ];
        foreach ($request->phase as $selectedPhase) {
            if (in_array($selectedPhase, ['1', '2', '3'])) {
                $phases['phase' . $selectedPhase] = 1;
            }
        }
        try {
            DB::beginTransaction();
            $notice = Notice::create([
                'title' => $request->title,
                'user_id' => $id,
                'notice' => $request->notice,
                'phase1' => $phases['phase1'],
                'phase2' => $phases['phase2'],
                'phase3' => $phases['phase3'],
                'date' => $request->formatted_date,
                'time' => $request->formatted_time,
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

            return redirect()->back()->withMessage('Notice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating notice: ' . $e->getMessage());
        }
    }

    // Assistance
    public function assistance()
    {
        return view('frontend.coordinator.aside.assistance');
    }

    // Change Password
    public function changePassword()
    {
        return view('frontend.coordinator.aside.changePassword');
    }
}
