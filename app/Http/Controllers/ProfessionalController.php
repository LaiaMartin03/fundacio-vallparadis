<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;
use App\Exports\ProfessionalsExport;
use App\Imports\ProfessionalsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();
        return view("professional.lista", compact('professionals'));
        
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
            'name'=>'required|min:3|max:20',
            'password'=>'required|min:8|max:255',
            'locker'=>'required',
            'code'=>'required',
            'surname'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'birthday'=>'required|date',
            'curriculum'=>'nullable'
        ]);
        Professional::create([
            'email'=>request('email'),
            'name'=>request('name'),
            'password'=>request('password'),
            'locker'=>request('locker'),
            'code'=>request('code'),
            'surname'=>request('surname'),
            'address'=>request('address'),
            'phone'=>request('phone'),
            'birthday'=>request('birthday'),
            'curriculum'=>request('curriculum'),
            'active'=>request('active')
        ]);
        return redirect()->route('professional.create')->with('success', 'Professional creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $professional = Professional::findOrFail($id);
        return view('professional.show', compact('professional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professional $professional)
    {
        $professionals = Professional::all();
        return view("professional.formulariEditar", compact('professional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professional $professional)
    {
        $request->validate([
            'email'=>'required|min:3|max:255',
            'name'=>'required|min:3|max:20',
            'password'=>'required|min:8|max:255',
            'locker'=>'required',
            'code'=>'required'
        ]);
        $professional->update([
            'email'=>request('email'),
            'name'=>request('name'),
            'password'=>request('password'),
            'locker'=>request('locker'),
            'code'=>request('code'),
            'info_id'=>null,
            'active'=>request('active')
        ]);

        return redirect()->route('professional.show', $professional->id) ->with('success', 'Professional actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activate(Professional $professional)
    {
        $professional->active = 1;
        $professional->save(); 
        return redirect()->route('professional.index')->with('success', 'Professional activat correctament.');
    }
    
    public function destroy(Professional $professional)
    {
        $professional->active = 0;
        $professional->save(); 
        return redirect()->route('professional.index')->with('success', 'Professional desactivat correctament.');
    }

    public function exportProfessionals()
    {
        return Excel::download(new ProfessionalsExport, 'professionals.xlsx');
    }
    
    public function importProfessionals(Request $request)
    {
        $file = $request->file('excel_file');
        Excel::import(new ProfessionalsImport, $file);

        return back()->with('success', 'Profesionales importados correctamente.');
    }
}
