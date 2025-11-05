<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningProgram;

class LearningProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = LearningProgram::all();
        return view('learningprogram.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $learningprogram = LearningProgram::all();
        $centers = \App\Models\Center::all();
        $cursos = \App\Models\Curso::all();
        $professionals = \App\Models\User::all();
        return view('learningprogram.create', compact('learningprogram','centers','cursos','professionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'curso_id' => 'required|exists:curso,id',
            'user_id' => 'required|exists:users,id'
        ]);

        LearningProgram::create([
            'center_id'=>1,
            'curso_id'=>request('curso_id'),
            'user_id'=>request('user_id'),
        ]);
        return redirect()->route('learningprogram.create')->with('success', 'Learning Program creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningProgram $learningprogram)
    {
        $learningprogram = LearningProgram::find($learningprogram->id);
        return view('learningprogram.edit', compact('learningprogram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'forcem'=>'required',
            'hours'=>'required',
            'type'=>'required',
            'modality'=>'required',
            'info'=>'nullable',
            'assistent'=>'required',
            'finish_date'=>'required|date',
            'certificate'=>'nullable',
        ]);
        $learningprogram = LearningProgram::find($id);
        $learningprogram->update([
            'center_id'=>request('center_id'),
            'curso_id'=>request('curso_id'),
            'user_id'=>request('user_id'),
            'user_id'=>request('assistent'),
            'forcem'=>request('forcem'),
            'hours'=>request('hours'),
            'type'=>request('type'),
            'modality'=>request('modality'),
            'info'=>request('info'),
            'assistent'=>request('assistent'),
            'finish_date'=>request('finish_date'),
            'certificate'=>request('certificate'),
        ]);
        return redirect()->route('learningprogram.edit', $learningprogram->id)->with('success', 'Learning Program actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate(LearningProgram $learningprogram)
    {
        $learningprogram->active = 1;
        $learningprogram->save(); 
        return redirect()->route('learningprogram.index', $learningprogram->id)->with('success', 'Professional activat correctament.');
    }

    public function destroy(LearningProgram $learningprogram)
    {
        $learningprogram->active = 0;
        $learningprogram->save(); 
        return redirect()->route('learningprogram.index', $learningprogram->id)->with('success', 'Professional desactivat correctament.');
    }
}
