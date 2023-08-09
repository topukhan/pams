<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorRequestController extends Controller
{
    //Request
    public function requests(){
        return view('frontend.coordinator.requests');
    }
}
