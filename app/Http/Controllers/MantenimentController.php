<?php

namespace App\Http\Controllers;

use App\Models\Manteniment;
use App\Models\User;
use Illuminate\Http\Request;

class MantenimentController extends Controller
{
    // Listar todas las entradas
    public function index()
    {
        // Trae todos los manteniments con su responsable, ordenados por fecha de creación
        $manteniments = Manteniment::with('responsable')->latest()->get();

        return view('manteniment.index', compact('manteniments'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        // Traemos todos los usuarios como posibles responsables/profesionales
        $users = User::orderBy('name')->get();
        return view('manteniment.create', compact('users'));
    }

    // Guardar nueva entrada
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required|in:manteniment,seguiment',
            'data' => 'required|date',
            'responsable_id' => 'required|exists:users,id',
            'descripcio' => 'required|string',
            'docs_adjunts.*' => 'nullable|file|max:10240', // cada archivo max 10MB
        ]);

        // Guardar archivos si los hay
        if ($request->hasFile('docs_adjunts')) {
            $files = [];
            foreach ($request->file('docs_adjunts') as $file) {
                $files[] = $file->store('docs_adjunts', 'public');
            }
            $data['docs_adjunts'] = $files;
        }

        Manteniment::create($data);

        return redirect()->route('manteniment.index')
            ->with('success', 'Entrada creada correctamente.');
    }

    // Mostrar una entrada específica
    public function show(Manteniment $manteniment)
    {
        // $manteniment es un modelo, no una colección, así que podemos acceder a $manteniment->id
        return view('manteniment.show', compact('manteniment'));
    }

    // Mostrar formulario de edición
    public function edit(Manteniment $manteniment)
    {
        $users = User::orderBy('name')->get();
        return view('manteniment.edit', compact('manteniment', 'users'));
    }

    // Actualizar entrada existente
    public function update(Request $request, Manteniment $manteniment)
    {
        $data = $request->validate([
            'tipo' => 'required|in:manteniment,seguiment',
            'data' => 'required|date',
            'responsable_id' => 'required|exists:users,id',
            'descripcio' => 'required|string',
            'docs_adjunts.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('docs_adjunts')) {
            $files = [];
            foreach ($request->file('docs_adjunts') as $file) {
                $files[] = $file->store('docs_adjunts', 'public');
            }
            $data['docs_adjunts'] = $files;
        }

        $manteniment->update($data);

        return redirect()->route('manteniment.index')
            ->with('success', 'Entrada actualizada correctamente.');
    }

    // Eliminar entrada
    public function destroy(Manteniment $manteniment)
    {
        $manteniment->delete();
        return redirect()->route('manteniment.index')
            ->with('success', 'Entrada eliminada correctamente.');
    }
}
