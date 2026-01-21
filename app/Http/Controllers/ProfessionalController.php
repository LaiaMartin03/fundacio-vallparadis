<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Exports\ProfessionalsExport;
use App\Imports\ProfessionalsImport;
use App\Models\CenterFollowup;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProfessionalController extends Controller
{
    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('search', '');
            
            // Buscar profesionales - versión simplificada
            $query = Professional::query();
            
            if (!empty($searchTerm)) {
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('surname', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('profession', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            $professionals = $query->get();
            
            // Formatear respuesta
            $formatted = $professionals->map(function($pro) {
                return [
                    'id' => $pro->id,
                    'name' => $pro->name,
                    'surname' => $pro->surname,
                    'profession' => $pro->profession ?? 'Sense professió',
                    'full_name' => $pro->name . ' ' . $pro->surname,
                    'show_url' => route('professional.show', $pro->id),
                ];
            });
            
            // Agrupar por profesión
            $grouped = $formatted->groupBy('profession');
            
            return response()->json([
                'success' => true,
                'professionals' => $formatted,
                'grouped' => $grouped,
                'total' => $professionals->count(),
                'message' => 'OK'
            ]);
            
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'curriculum'=>'nullable',
            'cv_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt',
            'profile_photo' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        $data = [
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
        ];

        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $data['cv_original_filename'] = $file->getClientOriginalName();
            $data['cv_file_path'] = $file->store('professional-cvs', 'public');
        }

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $data['profile_photo_original_filename'] = $file->getClientOriginalName();
            $data['profile_photo_path'] = $file->store('professional-photos', 'public');
        }

        Professional::create($data);
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
            'code'=>'required',
            'cv_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt',
            'profile_photo' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        $data = [
            'email'=>request('email'),
            'name'=>request('name'),
            'password'=>request('password'),
            'locker'=>request('locker'),
            'code'=>request('code'),
            'info_id'=>null,
            'active'=>request('active')
        ];

        if ($request->hasFile('cv_file')) {
            // Delete old file if exists
            if ($professional->cv_file_path && Storage::disk('public')->exists($professional->cv_file_path)) {
                Storage::disk('public')->delete($professional->cv_file_path);
            }
            $file = $request->file('cv_file');
            $data['cv_file_path'] = $file->store('professional-cvs', 'public');
            $data['cv_original_filename'] = $file->getClientOriginalName();
        }

        if ($request->hasFile('profile_photo')) {
            // Delete old file if exists
            if ($professional->profile_photo_path && Storage::disk('public')->exists($professional->profile_photo_path)) {
                Storage::disk('public')->delete($professional->profile_photo_path);
            }
            $file = $request->file('profile_photo');
            $data['profile_photo_path'] = $file->store('professional-photos', 'public');
            $data['profile_photo_original_filename'] = $file->getClientOriginalName();
        }

        $professional->update($data);

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

    public function uniformesPartial(Professional $professional)
    {
        // Cargar los uniformes
        $uniformes = $professional->resources()->with('givenBy')->latest()->get();
        $newestUniform = $uniformes->first();

        return view('professional.partials._uniformes', compact('uniformes', 'professional', 'newestUniform'));
    }

    /**
     * Download the CV file
     */
    public function downloadCv(Professional $professional)
    {
        if (!$professional->cv_file_path || !Storage::disk('public')->exists($professional->cv_file_path)) {
            abort(404, 'CV not found');
        }

        $downloadName = $professional->cv_original_filename ?: 'cv_' . $professional->name . '.pdf';
        return Storage::disk('public')->download($professional->cv_file_path, $downloadName);
    }

}
