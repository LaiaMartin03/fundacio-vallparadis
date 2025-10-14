<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Exports\ResourcesExport;
use App\Imports\ResourcesImport;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('resources.create');
    }

    /**
     * Guardar nuevo resource
     */
    public function store(Request $request)
    {
       $request->validate([
            'uniform_id' => 'required|integer',
            'user_id' => 'required|integer',
            'given_by_user_id' => 'required|integer',
            'delivered_at' => 'nullable|date',
        ]);


        Resource::create($request->all());
        return redirect()->route('resources.index')->with('success', 'Recurs creat correctament.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Resource $resource)
    {
        return view('resources.edit', compact('resource'));
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
}
