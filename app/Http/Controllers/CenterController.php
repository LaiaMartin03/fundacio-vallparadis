<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Centros' => route('center.index'),
        ];

        return view('center.lista', compact('centers', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Centros' => route('center.index'),
            'Crear centro' => route('center.create'),
        ];

        return view("center.formularioAlta", compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:255|unique:center,name',
            'location'=>'required|min:3|max:255',
            'phone'=>'required|min:9|max:15',
            'email'=>'required|email|unique:center,email'
        ]);
        Center::create([
            'name'=>request('name'),
            'location'=>request('location'),
            'email'=>request('email'),
            'phone'=>request('phone')
        ]);
        return redirect()->route('center.create')->with('success', 'Centre creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Center $center)
    {
        $centers = Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Centros' => route('center.index'),
            'Editar centro' => route('center.edit', $center->id),
        ];

        return view('center.formulariEditar', compact('center', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        $request->validate([
            'name'=>'required|min:3|max:255|unique:center,name',
            'location'=>'required|min:3|max:255',
            'phone'=>'required|min:9|max:15',
            'email'=>'required'
        ]);
        $center->update([
            'name'=>request('name'),
            'location'=>request('location'),
            'email'=>request('email'),
            'phone'=>request('phone')
        ]);
        return redirect()->route('center.index')->with('success', 'Centre modificat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate(Center $center)
    {
        $center->active = 1;
        $center->save();
        return redirect()->route('center.index')->with('success', 'Center activat correctament.');
    }
    public function destroy(Center $center)
    {
        $center->active = 0;
        $center->save();
        return redirect()->route('center.index')->with('success', 'Center desactivat correctament.');
    }
}
