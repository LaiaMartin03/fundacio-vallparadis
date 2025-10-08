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
        $projects = \App\Models\Project::with(['center', 'professional'])->get();
        return view('project.lista', compact('projects'));
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
    public function edit(Project $project)
    {
        $centers = \App\Models\Center::all();
        $professionals = \App\Models\Professional::all();
        return view('project.formulariEditar', compact('project', 'centers', 'professionals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'type' => 'required',
        ]);

        $project->update([
            'center_id' => $request->input('center_id'),
            'responsible_professional' => $request->input('responsible_professional'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'observations' => $request->input('observations'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('project.index')->with('success', 'Projecte actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate(Project $project)
    {
        $project->active = 1;
        $project->save(); 
        return redirect()->route('project.index')->with('success', 'Professional activat correctament.');
    }
    
    public function destroy(Project $project)
    {
        $project->active = 0;
        $project->save(); 
        return redirect()->route('project.index')->with('success', 'Professional desactivat correctament.');
    }
}
