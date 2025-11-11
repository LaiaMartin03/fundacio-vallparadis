<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Exports\CursosExport;
use Maatwebsite\Excel\Facades\Excel;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('curso.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('curso.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'forcem' => 'required|integer|min:0',
            'hours' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
            'info' => 'nullable|string',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'certification' => 'nullable|string|max:255',
        ]);
        Curso::create([
            'name'=>request('name'),
            'forcem'=>request('forcem'),
            'hours'=>request('hours'),
            'type'=>request('type'),
            'info'=>request('info'),
            'finish_date'=>request('finish_date'),
            'certificate'=>request('certificate'),
            'active'=>1
        ]);
        return redirect()->route('curso.create')->with('success', 'Curso Creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $curso = Curso::findOrFail($id);

        $learningProgram = \App\Models\LearningProgram::with(['user'])
            ->where('curso_id', $curso->id)
            ->get();

        
        $usuariosInscritos = $learningProgram->pluck('user')->filter();
        
        $usuariosNoInscritos = \App\Models\User::whereNotIn('id', $usuariosInscritos->pluck('id'))->get();
        
        return view('curso.show', compact('curso', 'usuariosInscritos', 'usuariosNoInscritos', 'learningProgram'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        $curso = Curso::find($curso->id);
        return view('curso.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'forcem' => 'required|integer|min:0',
            'hours' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
            'info' => 'nullable|string',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'certification' => 'nullable|string|max:255',
        ]);

        $curso->update([
            'name'=>request('name'),
            'forcem'=>request('forcem'),
            'hours'=>request('hours'),
            'type'=>request('type'),
            'info'=>request('info'),
            'finish_date'=>request('finish_date'),
            'active'=>request('active'),
            'certificate'=>request('certificate'),
        ]); 
        return redirect()->route('curso.index', $curso->id)->with('success', '  Curso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate(Curso $curso)
    {
        $curso->active = 1;
        $curso->save(); 
        return redirect()->route('curso.index', $curso->id)->with('success', 'Professional activat correctament.');
    }

    public function destroy(Curso $curso)
    {
        $curso->active = 0;
        $curso->save(); 
        return redirect()->route('curso.index', $curso->id)->with('success', 'Professional desactivat correctament.');
    }

    public function exportCursos()
    {
        return Excel::download(new CursosExport, 'cursos.xlsx');
    }
}
