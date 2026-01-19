<?php

namespace App\Http\Controllers;

use App\Models\HR;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\HRFollowup;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending = HR::with(['affectedProfessional', 'assignedTo'])->orderBy('active', 'desc')->orderBy('id', 'asc')->get();
        

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
        $hr = HR::with(['affectedProfessional', 'assignedTo', 'derivatedTo', 'followups.registrant'])
            ->findOrFail($id);

        return view('hr.show', compact('hr'));
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

