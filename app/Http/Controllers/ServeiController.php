<?php

namespace App\Http\Controllers;

use App\Models\Servei;
use App\Models\InternalDoc;
use App\Models\User;
use App\Models\Center;
use Illuminate\Http\Request;

class ServeiController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $serveis = Servei::with(['user', 'internalDoc'])->get();
        $serveisGenerals = $serveis->where('tipus', 'general');
        $serveisComplementaris = $serveis->where('tipus', 'complementari');

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Serveis' => route('serveis.index'),
        ];

        return view('serveis.index', compact('serveisGenerals', 'serveisComplementaris', 'breadcrumbs'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        $users = User::all();
        $internalDocs = InternalDoc::all();
        $centers = Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Serveis' => route('serveis.index'),
            'Crear servei' => route('serveis.create'),
        ];

        return view('serveis.create', compact('users', 'internalDocs', 'centers', 'breadcrumbs'));
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipus' => 'required|in:general,complementari',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'observacions' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'internal_doc_id' => 'nullable|exists:internal_docs,id',
        ]);

        // Validar que los servicios generales solo sean 'Cuina' o 'Bugaderia/Neteja'
        if ($validated['tipus'] === 'general') {
            $allowedNames = ['Cuina', 'Bugaderia/Neteja', 'Neteja i Bugaderia'];
            if (!in_array($validated['name'], $allowedNames)) {
                return back()->withErrors(['name' => 'Los servicios generales solo pueden ser "Cuina" o "Bugaderia/Neteja"'])->withInput();
            }
        }

        Servei::create($validated);

        return redirect()->route('serveis.index')
            ->with('success', 'Servei creat correctament.');
    }

    /**
     * Mostrar uno
     */
    public function show(Servei $servei)
    {
        $servei->load(['user', 'internalDoc']);

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Serveis' => route('serveis.index'),
            $servei->name => route('serveis.show', $servei->id),
        ];

        return view('serveis.show', compact('servei', 'breadcrumbs'));
    }

    /**
     * Formulario editar
     */
    public function edit(Servei $servei)
    {
        $users = User::all();
        $internalDocs = InternalDoc::all();
        $centers = Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Serveis' => route('serveis.index'),
            $servei->name => route('serveis.show', $servei->id),
            'Editar' => route('serveis.edit', $servei->id),
        ];

        return view('serveis.edit', compact('servei', 'users', 'internalDocs', 'centers', 'breadcrumbs'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Servei $servei)
    {
        $validated = $request->validate([
            'tipus' => 'required|in:general,complementari',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'observacions' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'internal_doc_id' => 'nullable|exists:internal_docs,id',
        ]);

        // Validar que los servicios generales solo sean 'Cuina' o 'Bugaderia/Neteja'
        if ($validated['tipus'] === 'general') {
            $allowedNames = ['Cuina', 'Bugaderia/Neteja', 'Neteja i Bugaderia'];
            if (!in_array($validated['name'], $allowedNames)) {
                return back()->withErrors(['name' => 'Los servicios generales solo pueden ser "Cuina" o "Bugaderia/Neteja"'])->withInput();
            }
        }

        $servei->update($validated);

        return redirect()->route('serveis.show', $servei->id)
            ->with('success', 'Servei actualitzat correctament.');
    }

    /**
     * Eliminar
     */
    public function destroy(Servei $servei)
    {
        $servei->delete();

        return redirect()->route('serveis.index')
            ->with('success', 'Servei eliminat correctament.');
    }
}
