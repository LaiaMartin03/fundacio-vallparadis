<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = \App\Models\Professional::all();
        $centers = \App\Models\Center::all();
        return view("project.formularioAlta", compact('centers', 'professionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'type'=>'required'
        ]);
        Project::create([
            'center_id' => $request->input('center_id'),
            'responsible_professional' => $request->input('responsible_professional'),  
            'name'=>request('name'),
            'description'=>request('description'),
            'observations'=>request('observations'),
            'type'=>request('type')
        ]);
        return redirect()->route('project.create')->with('success', 'Centre creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
