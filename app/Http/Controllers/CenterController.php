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
        return view('center.lista', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("center.formularioAlta");
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
