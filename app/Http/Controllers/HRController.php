<?php

namespace App\Http\Controllers;

use App\Models\HR;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\HRFollowup;

class HRController extends Controller
{
public function search(Request $request)
{
    $search = $request->input('search');
    
    $hrCases = HR::with([
        'affectedProfessional:id,name,surname',
        'assignedTo:id,name,surname', 
        'derivatedTo:id,name,surname'
    ])
    ->where(function($query) use ($search) {
        $query->whereHas('affectedProfessional', function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('surname', 'LIKE', "%{$search}%");
        })
        ->orWhere('description', 'LIKE', "%{$search}%");
    })
    ->get()
    ->map(function($hr) {
        return [
            'id' => $hr->id,
            'description' => $hr->description,
            'attached_docs' => $hr->attached_docs,
            'active' => $hr->active,
            'created_at' => $hr->created_at->toISOString(),
            'affectedProfessional' => $hr->affectedProfessional ? [
                'id' => $hr->affectedProfessional->id,
                'name' => $hr->affectedProfessional->name,
                'surname' => $hr->affectedProfessional->surname
            ] : null,
            'assignedTo' => $hr->assignedTo ? [
                'id' => $hr->assignedTo->id,
                'name' => $hr->assignedTo->name,
                'surname' => $hr->assignedTo->surname
            ] : null,
            'derivatedTo' => $hr->derivatedTo ? [
                'id' => $hr->derivatedTo->id,
                'name' => $hr->derivatedTo->name,
                'surname' => $hr->derivatedTo->surname
            ] : null,
        ];
    });
    
    return response()->json([
        'hrCases' => $hrCases,
        'count' => $hrCases->count()
    ]);
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending = HR::with(['affectedProfessional', 'assignedTo'])->orderBy('active', 'desc')->orderBy('id', 'asc')->get();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Recursos Humanos' => route('hr.index'),
        ];

        return view('hr.index', compact('pending', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $affected_professional = Professional::all();
        $assigned_to = Professional::all();
        $derivated_to = Professional::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Recursos Humanos' => route('hr.index'),
            'Crear caso HR' => route('hr.create'),
        ];

        return view('hr.new', compact('affected_professional', 'assigned_to', 'derivated_to', 'breadcrumbs'));
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
        $hr = HR::with(['affectedProfessional', 'assignedTo', 'derivatedTo', 'followups.registrant'])
            ->findOrFail($id);

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Recursos Humanos' => route('hr.index'),
            'Caso HR #' . $hr->id => route('hr.show', $hr->id),
        ];

        return view('hr.show', compact('hr', 'breadcrumbs'));
    }

    /**
     * Store a followup for HR case
     */
    public function storeFollowup(Request $request, HR $hr)
    {
        $request->validate([
            'date' => 'required|date',
            'topic' => 'nullable|string|max:255',
            'description' => 'required|string',
            'attached_docs' => 'nullable|string',
        ]);

        HRFollowup::create([
            'hr_id' => $hr->id,
            'date' => $request->date,
            'topic' => $request->topic,
            'description' => $request->description,
            'attached_docs' => $request->attached_docs,
            'registrant_id' => $request->user()->id,
        ]);

        return redirect()->route('hr.show', $hr->id)->with('success', 'Seguiment afegit correctament');
    }

    /**
     * Remove a followup
     */
    public function destroyFollowup(HRFollowup $followup)
    {
        $hrId = $followup->hr_id;
        $followup->delete();

        return redirect()->route('hr.show', $hrId)->with('success', 'Seguiment eliminat correctament');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HR $hr)
    {
        $affected_professional = Professional::all();
        $assigned_to = Professional::all();
        $derivated_to = Professional::all();

        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Recursos Humanos' => route('hr.index'),
            'Caso HR #' . $hr->id => route('hr.show', $hr->id),
            'Editar' => route('hr.edit', $hr->id),
        ];

        return view('hr.edit', compact('hr', 'affected_professional', 'assigned_to', 'derivated_to', 'breadcrumbs'));
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
        ]);

        $hr->update([
            'affected_professional'=>request('affected_professional'),
            'description'=>request('description'),
            'attached_docs'=>request('attached_docs'),
            'assigned_to'=>request('assigned_to'),
            'center_id'=>1,
            'derivated_to' => $request->derivated_to,
        ]);
        return redirect()->route('hr.show', $hr->id)->with('success', 'Recurso creado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HR $hr)
    {
        $hr->active = 0;
        $hr->save(); 

        return redirect()->route('hr.show', $hr->id)->with('success', 'Cas HR marcat com a inactiu correctament');
    }
    public function activate(HR $hr)
    {
        $hr->active = 1;
        $hr->save(); 

        return redirect()->route('hr.show', $hr->id)->with('success', 'Cas HR marcat com a actiu correctament');
    }
}

