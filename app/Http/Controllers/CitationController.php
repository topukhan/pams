<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitationController extends Controller
{
    public function create(){
        return view ('frontend.supervisor.profile.citation');
    }

    public function store(Request $request)
    {
        $user = Auth::guard('supervisor')->user(); 
        
        // Validate the incoming request data
        $request->validate([
            'citation' => 'required|array',
            'citation.*' => 'string|max:255',
        ]);

        // Store citations in the user's citations relationship
        $user->citations()->createMany(
            array_map(function ($citation) {
                return ['citation' => $citation];
            }, $request->citation)
        );
        return redirect()->back()->withMessage('Citations Added To Profile.');
    }

    
}
