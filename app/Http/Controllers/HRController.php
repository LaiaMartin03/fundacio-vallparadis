<?php

namespace App\Http\Controllers;

use App\Models\HR;
use App\Models\Professional;
use Illuminate\Http\Request;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar solo los casos activos por defecto
        $pending = HR::with(['affectedProfessional', 'assignedTo'])
                    ->where('active', true)
                    ->get();
        
        // Opcional: también puedes mostrar los inactivos con un parámetro
        if (request()->has('show_inactive')) {
            $pending = HR::with(['affectedProfessional', 'assignedTo'])->get();
        }
        
        return view('hr.index', compact('pending'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $affected_professional = Professional::all();
        $assigned_to = Professional::all();
        $derivated_to = Professional::all();

        return view('hr.new', compact('affected_professional', 'assigned_to', 'derivated_to'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affected_professional' => 'required',
            'description' => 'max:255|nullable',
            'attached_docs' => 'nullable',
            'assigned_to' => 'required',
            'derivated_to' => 'nullable',
        ]);

        HR::create([
            'affected_professional' => request('affected_professional'),
            'description' => request('description'),
            'attached_docs' => request('attached_docs'),
            'assigned_to' => request('assigned_to'),
            'center_id' => 1,
            'active' => true,
            'derivated_to' => $request->derivated_to,
        ]);
        
        return redirect()->route('hr.create')->with('success', 'Recurso creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hr = HR::with(['affectedProfessional', 'assignedTo', 'derivatedTo'])
            ->findOrFail($id);

        $professionalsInvolved = collect([
            $hr->affectedProfessional,
            $hr->assignedTo,
            $hr->derivatedTo
        ])->filter()->pluck('id');

        return view('hr.show', compact('hr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HR $hr)
    {
        $affected_professional = Professional::all();
        $assigned_to = Professional::all();
        $derivated_to = Professional::all();

        return view('hr.edit', compact('hr', 'affected_professional', 'assigned_to', 'derivated_to'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HR $hr)
    {
        $request->validate([
            'affected_professional' => 'required',
            'description' => 'max:255|nullable',
            'attached_docs' => 'nullable',
            'assigned_to' => 'required',
            'derivated_to' => 'nullable',
            'active' => 'boolean',
        ]);

        $hr->update([
            'affected_professional'=>request('affected_professional'),
            'description'=>request('description'),
            'attached_docs'=>request('attached_docs'),
            'assigned_to'=>request('assigned_to'),
            'center_id'=>1,
            'active'=> request('active'),
            'derivated_to' => $request->derivated_to,
        ]);
        return redirect()->route('hr.create')->with('success', 'Recurso creado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HR $hr)
    {
        // En lugar de eliminar, ponemos el caso como inactivo
        $hr->update([
            'active' => false
        ]);
        
        return redirect()->route('hr.index')->with('success', 'Cas HR marcat com a inactiu correctament');
    }

    /**
     * Search HR records (AJAX)
     */
    public function search(Request $request)
    {
        $q = trim($request->query('q', ''));

        $query = HR::with(['affectedProfessional', 'assignedTo', 'derivatedTo']);

        if ($q !== '') {
            $query->where(function ($qr) use ($q) {
                $qr->where('description', 'like', "%{$q}%")
                    ->orWhereHas('affectedProfessional', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('assignedTo', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('derivatedTo', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%");
                    });
            });
        }

        $results = $query->orderBy('created_at', 'desc')->limit(200)->get();

        return response()->json($results->map(function ($hr) {
            return [
                'id' => $hr->id,
                'created_at' => $hr->created_at ? $hr->created_at->format('Y-m-d') : null,
                'affected_professional' => $hr->affectedProfessional?->name,
                'description' => $hr->description,
                'assigned_to' => $hr->assignedTo?->name,
                'derivated_to' => $hr->derivatedTo?->name,
                'active' => (bool) ($hr->active ?? false),
            ];
        }));
    }
}

