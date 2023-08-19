<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domains = Domain::paginate(4);
        return view('backend.admin.domain.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.domain.create');
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
            Domain::create([
                'name' => $request->name
            ]);
            return redirect()->route('domains.index')->withMessage("Domain Created!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        return view('backend.admin.domain.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {
        return view('backend.admin.domain.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $domain->update([
                'name' => $request->name,
            ]);
            return redirect()->route('domains.index')->withMessage("Domain Updated!");
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domains.index')->withMessage("Domain Deleted!");
    }
}
