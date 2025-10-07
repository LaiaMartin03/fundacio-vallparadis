<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = \App\Models\Center::all();
        return view("professional.formularioAlta", compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|min:3|max:255',
            'username'=>'required|min:3|max:20',
            'password'=>'required|min:8|max:255',
            'locker'=>'required',
            'code'=>'required'
        ]);
        Professional::create([
            'email'=>request('email'),
            'username'=>request('username'),
            'password'=>request('password'),
            'locker'=>request('locker'),
            'code'=>request('code'),
            'info_id'=>null,
            'active'=>request('active')
        ]);
        return redirect()->route('professional.create')->with('success', 'Centre creat correctament.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
