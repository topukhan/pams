<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function index()
    {
        return view('frontend.student.profile');
    }
}
