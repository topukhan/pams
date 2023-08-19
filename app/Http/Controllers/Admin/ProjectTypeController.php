<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectTypes = ProjectType::paginate(4);
        return view('backend.admin.projectType.index', compact('projectTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.projectType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            ProjectType::create([
                'name' => $request->name
            ]);
            return redirect()->route('projectTypes.index')->withMessage("ProjectType Created!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectType $projectType)
    {
        return view('backend.admin.projectType.show', compact('projectType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectType $projectType)
    {
        return view('backend.admin.projectType.edit', compact('projectType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $projectType->update([
                'name' => $request->name,
            ]);
            return redirect()->route('projectTypes.index')->withMessage("ProjectType Updated!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return redirect()->route('projectTypes.index')->withMessage("ProjectType Deleted!");
    }
}
