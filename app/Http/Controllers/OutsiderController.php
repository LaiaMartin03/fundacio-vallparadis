<?php

namespace App\Http\Controllers;

use App\Models\outsiders;
use Illuminate\Http\Request;

class OutsiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outsiders = Outsiders::all();

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(outsiders $outsiders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(outsiders $outsiders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, outsiders $outsiders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(outsiders $outsiders)
    {
        //
    }
}
