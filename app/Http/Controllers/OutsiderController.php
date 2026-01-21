<?php

namespace App\Http\Controllers;

use App\Models\Outsider;
use Illuminate\Http\Request;

class OutsiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outsiders = Outsider::all();

        // Get distinct services and businesses for the filters
        $services = Outsider::select('service')->distinct()->pluck('service')->filter()->values();
        $businesses = Outsider::select('business')->distinct()->pluck('business')->filter()->values();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
        ];

        return view('outsiders.index', compact('outsiders', 'breadcrumbs', 'services', 'businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
            'Crear' => route('outsiders.create')
        ];

        return view('outsiders.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:outsiders,email',
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'task' => 'required|string|in:General,Assistencial',
            'business' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Outsider::create($data);

        return redirect()->route('outsiders.index')->with('success', 'Contacto externo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Outsider $outsider)
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
            $outsider->nombre_completo => route('outsiders.show', $outsider->id)
        ];

        return view('outsiders.show', compact('outsider', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->input('id') ?? $request->route('outsider');
        
        if (is_object($id)) {
            $outsider = $id;
        } else {
            $outsider = Outsider::findOrFail($id);
        }
        
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
            'Editar' => route('outsiders.edit.custom', ['id' => $outsider->id])
        ];

        return view('outsiders.edit', compact('outsider', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outsider $outsider)
    {
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:outsiders,email,' . $outsider->id,
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'task' => 'required|string|in:General,Assistencial',
            'business' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $outsider->update($data);

        return redirect()->route('outsiders.index')->with('success', 'Contacto externo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outsider $outsider)
    {
        $outsider->delete();

        return redirect()->route('outsiders.index')->with('success', 'Contacto externo eliminado correctamente.');
    }
}
