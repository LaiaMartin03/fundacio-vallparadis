<?php

namespace App\Http\Controllers;

use App\Models\Manteniment;
use Illuminate\Http\Request;

class MantenimentController extends Controller
{
    public function index()
    {
        $manteniments = Manteniment::latest()->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Manteniment' => route('manteniment.index'),
        ];

        return view('manteniment.index', compact('manteniments', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Manteniment' => route('manteniment.index'),
            'Crear' => route('manteniment.create'),
        ];

        return view('manteniment.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required|in:manteniment,seguiment',
            'data' => 'required|date',
            'responsable' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'docs_adjunts' => 'nullable|array',
        ]);

        Manteniment::create($data);

        return redirect()->route('manteniment.index')->with('success', 'Entrada creada correctamente.');
    }

    public function show(Manteniment $manteniment)
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Manteniment' => route('manteniment.index'),
            $manteniment->tipo . ' - ' . $manteniment->responsable => route('manteniment.show', $manteniment->id),
        ];

        return view('manteniment.show', compact('manteniment', 'breadcrumbs'));
    }

    public function edit(Manteniment $manteniment)
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Manteniment' => route('manteniment.index'),
            'Editar' => route('manteniment.edit', $manteniment->id),
        ];

        return view('manteniment.edit', compact('manteniment', 'breadcrumbs'));
    }

    public function update(Request $request, Manteniment $manteniment)
    {
        $data = $request->validate([
            'tipo' => 'required|in:manteniment,seguiment',
            'data' => 'required|date',
            'responsable' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'docs_adjunts' => 'nullable|array',
        ]);

        $manteniment->update($data);

        return redirect()->route('manteniment.index')->with('success', 'Entrada actualizada correctamente.');
    }

    public function destroy(Manteniment $manteniment)
    {
        $manteniment->delete();

        return redirect()->route('manteniment.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
