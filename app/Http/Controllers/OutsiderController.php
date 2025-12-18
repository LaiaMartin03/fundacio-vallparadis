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

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
        ];

        return view('outsiders.index', compact('outsiders', 'breadcrumbs'));
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
            'task' => 'required|string|max:255',
            'business' => 'nullable|string|max:255',
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
    public function edit(Outsider $outsider)
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Contactes externs' => route('outsiders.index'),
            'Editar' => route('outsiders.edit', $outsider->id)
        ];

        $outsider = Outsider::findOrFail($request->id);

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
            'task' => 'required|string|max:255',
            'business' => 'nullable|string|max:255',
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
