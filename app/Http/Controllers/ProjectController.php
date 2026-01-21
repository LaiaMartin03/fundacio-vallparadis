<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Professional;
use App\Models\Projectdistribution;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['center', 'professional'])->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Proyectos' => route('project.index'),
        ];

        return view('project.lista', compact('projects', 'breadcrumbs'));
    }
        
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = \App\Models\Professional::all();
        $centers = \App\Models\Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Proyectos' => route('project.index'),
            'Crear proyecto' => route('project.create'),
        ];

        return view('project.formularioAlta', compact('centers', 'professionals', 'breadcrumbs'));
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
    public function show(Project $project)
    {
        $project = Project::with(['center', 'professional'])->findOrFail($project->id);

        $professionalIds = \App\Models\Projectdistribution::where('project_id', $project->id)
            ->pluck('user_id')
            ->toArray();

        $professionals = \App\Models\User::whereIn('id', $professionalIds)->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Proyectos' => route('project.index'),
            $project->name => route('project.show', $project->id),
        ];

        return view('project.show', compact('project', 'professionals', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project = Project::findOrFail($project->id);
        $centers = \App\Models\Center::all();
        $professionals = \App\Models\Professional::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Proyectos' => route('project.index'),
            $project->name => route('project.show', $project->id),
            'Editar' => route('project.edit', $project->id),
        ];

        return view('project.formulariEditar', compact('project', 'centers', 'professionals', 'breadcrumbs'));
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
            'active' => $request->has('active') ? 1 : 0,
        ]);

        return redirect()->route('project.index')->with('success', 'Projecte actualitzat correctament.');
    }

    public function removeProfessional(Request $request, Project $project, Professional $professional)
    {
        // Eliminar la relación del profesional con el proyecto
        Projectdistribution::where('project_id', $project->id)
            ->where('user_id', $professional->id)
            ->delete();

        return redirect()->route('project.show', $project->id)
            ->with('success', 'Professional desassignat correctament.');
    }

    public function addProfessional(Request $request, Project $project)
    {
        // Obtener los ids de profesionales ya asignados a este proyecto
        $assigned = Projectdistribution::where('project_id', $project->id)->pluck('user_id')->toArray();

        // Obtener sólo los profesionales que NO están asignados
        $professionals = Professional::whereNotIn('id', $assigned)->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Proyectos' => route('project.index'),
            $project->name => route('project.show', $project->id),
            'Añadir profesional' => route('project.addProfessional', $project->id),
        ];

        return view('project.addProfessional', compact('project', 'professionals', 'breadcrumbs'));
    }
    

    public function storeProfessional(Request $request, Project $project)
    {
        $request->validate([
            'professional_id' => 'required|exists:users,id',
        ]);
        Projectdistribution::create([
            'project_id' => $project->id,
            'user_id' => $request->input('professional_id'),
        ]);

        return redirect()->route('project.show', $project->id)->with('success', 'Professional afegit correctament al projecte.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function activate(Project $project)
    {
        $project->active = 1;
        $project->save(); 
        return redirect()->route('project.show', $project->id)->with('success', 'Professional activat correctament.');
    }
    
    public function destroy(Project $project)
    {
        $project->active = 0;
        $project->save(); 
        return redirect()->route('project.show',$project->id)->with('success', 'Professional desactivat correctament.');
    }
}
