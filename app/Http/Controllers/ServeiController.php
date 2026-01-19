<?php

namespace App\Http\Controllers;

use App\Models\Servei;
use App\Models\InternalDoc;
use App\Models\User;
use Illuminate\Http\Request;

class ServeiController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $serveis = Servei::with(['user', 'internalDoc'])->get();
        return view('serveis.index', compact('serveis'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        $users = User::all();
        $internalDocs = InternalDoc::all();

        return view('serveis.create', compact('users', 'internalDocs'));
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipus' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'observacions' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'internal_doc_id' => 'nullable|exists:internal_docs,id',
        ]);

        Servei::create($validated);

        return redirect()->route('serveis.index')
            ->with('success', 'Servei creado correctamente');
    }

    /**
     * Mostrar uno
     */
    public function show(Servei $servei)
    {
        return view('serveis.show', compact('servei'));
    }

    /**
     * Formulario editar
     */
    public function edit(Servei $servei)
    {
        $users = User::all();
        $internalDocs = InternalDoc::all();

        return view('serveis.edit', compact('servei', 'users', 'internalDocs'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Servei $servei)
    {
        $validated = $request->validate([
            'tipus' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'observacions' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'internal_doc_id' => 'nullable|exists:internal_docs,id',
        ]);

        $servei->update($validated);

        return redirect()->route('serveis.index')
            ->with('success', 'Servei actualizado correctamente');
    }

    /**
     * Eliminar
     */
    public function destroy(Servei $servei)
    {
        $servei->delete();

        return redirect()->route('serveis.index')
            ->with('success', 'Servei eliminado correctamente');
    }
}
