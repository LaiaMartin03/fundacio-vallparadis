<?php

namespace App\Http\Controllers;

use App\Models\Uniform;
use Illuminate\Http\Request;
use App\Exports\UniformsExport;
use App\Imports\UniformsImport;
use Maatwebsite\Excel\Facades\Excel;

class UniformController extends Controller
{
    /**
     * Mostrar listado de uniformes
     */
    public function index()
    {
        $uniforms = Uniform::all();
        return view('uniforms.index', compact('uniforms'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('uniforms.create');
    }

    /**
     * Guardar nuevo uniforme
     */
    public function store(Request $request)
    {
       $request->validate([
            'id' => 'integer',
            'shirt_size' => 'nullable|integer',
            'pants_size' => 'nullable|integer',
            'lab_coat' => 'nullable|boolean',
            'shoe_size' => 'nullable|integer'
        ]);


        Uniform::create($request->all());
        return redirect()->route('uniforms.index')->with('success', 'Uniforme creat correctament.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Uniform $uniform)
    {
        return view('uniforms.edit', compact('uniform'));
    }

    /**
     * Actualizar un uniforme
     */
    public function update(Request $request, Uniform $uniform)
    {
        $request->validate([
            'id' => 'integer',
            'shirt_size' => 'nullable|integer',
            'pants_size' => 'nullable|integer',
            'lab_coat' => 'nullable|boolean',
            'shoe_size' => 'nullable|integer'
        ]);


        $uniform->update($request->all());
        return redirect()->route('uniforms.index')->with('success', 'Uniforme actualitzar correctament.');
    }

    /**
     * Eliminar un uniforme
     */
    public function activate(Uniform $uniform)
    {
        $uniform->active = 1;
        $uniform->save(); 
        return redirect()->route('uniforms.index')->with('success', 'Uniforme activat correctament.');
    }
    
    public function destroy(Uniform $uniform)
    {
        $uniform->active = 0;
        $uniform->save(); 
        return redirect()->route('uniforms.index')->with('success', 'Uniforme desactivat correctament.');
    }

    /**
     * Exportar a Excel
     */
    public function exportUniforms()
    {
        return Excel::download(new UniformsExport, 'uniforms.xlsx');
    }

    /**
     * Importar desde Excel
     */
    public function importUniforms(Request $request)
    {
        $file = $request->file('excel_file');
        Excel::import(new UniformsImport, $file);
        return back()->with('success', 'Uniformes importats correctament.');
    }
}
