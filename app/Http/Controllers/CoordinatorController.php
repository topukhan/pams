<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function dashboard(){
        return view('frontend.coordinator.dashboard');
    }
    //formed group list
    public function formedGroupsLists(){
        return view('frontend.coordinator.formedGroupsList');
    }
}
