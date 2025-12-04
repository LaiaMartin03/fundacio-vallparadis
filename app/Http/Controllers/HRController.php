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
        $pending = HR::with(['affectedProfessional', 'assignedTo'])->get();
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

        return view('hr.new',compact('affected_professional', 'assigned_to', 'derivated_to'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affected_professional'=>'required',
            'description'=>'max:255|nullable',
            'attached_docs'=>'nullable',
            'assigned_to'=> 'required',
            'derivated_to' => 'nullable',
        ]);

        HR::create([
            'affected_professional'=>request('affected_professional'),
            'description'=>request('description'),
            'attached_docs'=>request('attached_docs'),
            'assigned_to'=>request('assigned_to'),
            'center_id'=>1,
            'active'=> true,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HR $hr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HR $hr)
    {
        //
    }
}
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
        $pending = HR::with(['affectedProfessional', 'assignedTo'])->get();
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

        return view('hr.new',compact('affected_professional', 'assigned_to', 'derivated_to'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affected_professional'=>'required',
            'description'=>'max:255|nullable',
            'attached_docs'=>'nullable',
            'assigned_to'=> 'required',
            'derivated_to' => 'nullable',
        ]);

        HR::create([
            'affected_professional'=>request('affected_professional'),
            'description'=>request('description'),
            'attached_docs'=>request('attached_docs'),
            'assigned_to'=>request('assigned_to'),
            'center_id'=>1,
            'active'=> true,
            'derivated_to' => $request->derivated_to,
        ]);
        return redirect()->route('hr.create')->with('success', 'Recurso creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(HR $hr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HR $hr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HR $hr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HR $hr)
    {
        //
    }
}
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
        $pending = HR::with(['affectedProfessional', 'assignedTo'])->get();
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

        return view('hr.new',compact('affected_professional', 'assigned_to', 'derivated_to'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affected_professional'=>'required',
            'description'=>'max:255|nullable',
            'attached_docs'=>'nullable',
            'assigned_to'=> 'required',
            'derivated_to' => 'nullable',
        ]);

        HR::create([
            'affected_professional'=>request('affected_professional'),
            'description'=>request('description'),
            'attached_docs'=>request('attached_docs'),
            'assigned_to'=>request('assigned_to'),
            'center_id'=>1,
            'active'=> true,
            'derivated_to' => $request->derivated_to,
        ]);
        return redirect()->route('hr.create')->with('success', 'Recurso creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(HR $hr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HR $hr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HR $hr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HR $hr)
    {
        //
    }
}
