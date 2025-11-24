<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Exports\ResourcesExport;
use App\Imports\ResourcesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Professional;

class ResourceController extends Controller
{
    /**
     * Mostrar listado de resources
     */
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', compact('resources'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('resources.create', compact( 'users'));
    }

    /**
     * Guardar nuevo resource
     */
    public function store(Request $request)
    {
        $request->validate([
            'shirt_size' => 'nullable|integer',
            'pants_size' => 'nullable|integer',
            'lab_coat' => 'nullable|boolean',
            'shoe_size' => 'nullable|integer',
            'user_id' => 'required|integer',
            'given_by_user_id' => 'required|integer',
            'delivered_at' => 'nullable|date',
        ]);

        $data = $request->all();

        if(!empty($data['delivered_at'])){
            // Convertir YYYY-MM-DDTHH:MM a YYYY-MM-DD HH:MM:SS
            $data['delivered_at'] = date('Y-m-d H:i:s', strtotime($data['delivered_at']));
        }

        Resource::create($data);
        return redirect()->route('resources.index')->with('success', 'Recurs creat correctament.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Resource $resource)
    {
        $users = \App\Models\User::all();
        return view('resources.edit', compact('resource', 'uniforms', 'users'));
    }

    /**
     * Actualizar un resourcee
     */
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'shirt_size' => 'nullable|integer',
            'pants_size' => 'nullable|integer',
            'lab_coat' => 'nullable|boolean',
            'shoe_size' => 'nullable|integer'
        ]);


        $resource->update($request->all());
        return redirect()->route('resources.index')->with('success', 'Recurs actualitzat correctament.');
    }

    /**
     * Eliminar un resourcee
     */
    public function activate(Resource $resource)
    {
        $resource->active = 1;
        $resource->save(); 
        return redirect()->route('resources.index')->with('success', 'Recurs activat correctament.');
    }
    
    public function destroy(Resource $resource)
    {
        $resource->active = 0;
        $resource->save(); 
        return redirect()->route('resources.index')->with('success', 'Recurs desactivat correctament.');
    }

    /**
     * Exportar a Excel
     */
    public function exportResources()
    {
        return Excel::download(new ResourcesExport, 'resources.xlsx');
    }

    /**
     * Importar desde Excel
     */
    public function importResources(Request $request)
    {
        $file = $request->file('excel_file');
        Excel::import(new ResourcesImport, $file);
        return back()->with('success', 'Recursos importats correctament.');
    }

   // En app/Http/Controllers/ResourceController.php
    public function partial(Professional $professional)
    {
        $uniformes = Resource::where('user_id', $professional->id)
            ->with('givenBy')
            ->latest()
            ->get();

        $newestUniform = $uniformes->sortByDesc('created_at')->first();

        return view('professional.partials._uniformes', compact('professional', 'uniformes', 'newestUniform'));
    }
}
