<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    
    //formed group list
    public function formedGroupsLists(){
        return view('frontend.coordinator.formedGroupsList');
    }
}
