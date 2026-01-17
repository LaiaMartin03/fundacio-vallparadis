<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Exports\ProfessionalsExport;
use App\Imports\ProfessionalsImport;
use App\Models\CenterFollowup;
use Maatwebsite\Excel\Facades\Excel;

class ProfessionalController extends Controller
{
    // En ProfessionalController.php
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $professionals = Professional::where('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->get();
        
        // Siempre devolver JSON para las peticiones fetch
        return response()->json([
            'professionals' => $professionals,
            'count' => $professionals->count()
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Profesionales' => route('professional.index'),
        ];

        return view('professional.lista', compact('professionals', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = \App\Models\Center::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Profesionales' => route('professional.index'),
            'Crear profesional' => route('professional.create'),
        ];

        return view('professional.formularioAlta', compact('centers', 'breadcrumbs'));
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
    public function show(Professional $professional)
    {
        $followups = \App\Models\CenterFollowup::where('professional_user_id', $professional->id)
        ->with('registrant')
        ->latest()
        ->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Profesionales' => route('professional.index'),
            $professional->name => route('professional.show', $professional->id),
        ];

        return view('professional.show', compact('professional', 'followups', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professional $professional)
    {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Profesionales' => route('professional.index'),
            $professional->name => route('professional.show', $professional->id),
            'Editar' => route('professional.edit', $professional->id),
        ];

        return view('professional.formulariEditar', compact('professional', 'breadcrumbs'));
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
        return redirect()->route('professional.show', $professional->id)->with('success', 'Professional activat correctament.');
    }

    public function destroy(Professional $professional)
    {
        $professional->active = 0;
        $professional->save(); 
        return redirect()->route('professional.show', $professional->id)->with('success', 'Professional desactivat correctament.');
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

    public function uniformes(Professional $professional)
    {
        // Cargar los uniformes
        $uniformes = $professional->resources()->with('givenBy')->latest()->get();

        // Verificar si es una petición Turbo Frame
        $isTurboFrame = request()->header('Turbo-Frame') === 'contenido';

        if ($isTurboFrame) {
            return view('professional.partials._uniformes', compact('uniformes', 'professional'));
        }

        // Si no es Turbo Frame, devolver vista completa
        return view('professional.show', compact('professional', 'uniformes'));
    }

}
