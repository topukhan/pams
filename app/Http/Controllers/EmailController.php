<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');
        // $receiver = $request->receiver;
        $receiver = 'rezwanakarim13@gmail.com';
        // $sender = Auth::guard('supervisor')->user()->email; // Get authenticated user's email

        $mailData = [
            'subject' => $subject,
            'message' => $message,
        ];
        
        try {
            Mail::to($receiver)->send(new SendEmail($mailData));
            return back()->with('message', 'Email sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }
}
