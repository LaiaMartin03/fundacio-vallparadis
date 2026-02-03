<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Professional;
use App\Exports\ProfessionalsExport;
use App\Imports\ProfessionalsImport;
use App\Models\Accident;

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
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'name' => 'required|min:3|max:50',
            'surname' => 'required|min:3|max:50',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
            'profession' => 'required|min:3|max:255',
            'address' => 'required',
            'phone' => 'required',
            'birthday' => 'required|date',
            'locker' => 'required',
            'code' => 'required',
            'active' => 'required|in:0,1',
            'observations' => 'nullable|string',
            'cv_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt',
            'profile_photo' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'password' => $request->input('password'),
            'profession' => $request->input('profession', 'Sense especificar'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'locker' => $request->input('locker'),
            'code' => $request->input('code'),
            'active' => $request->input('active', 1),
            'curriculum' => $request->input('observations'), // Mapear observations a curriculum
            'role' => 'Treballador' // Valor por defecto
        ];

        // Manejo de archivo CV
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $data['cv_original_filename'] = $file->getClientOriginalName();
            $data['cv_file_path'] = $file->store('professional-cvs', 'public');
        }

        // Manejo de foto de perfil
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $data['profile_photo_original_filename'] = $file->getClientOriginalName();
            $data['profile_photo_path'] = $file->store('professional-photos', 'public');
        }

        Professional::create($data);
        return redirect()->route('professional.index')->with('success', 'Professional creat correctament.');
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
            'password'=>'nullable|min:8|max:255',
            'locker'=>'required',
            'code'=>'required',
            'cv_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt',
            'profile_photo' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        $data = [
            'email'=>request('email'),
            'name'=>request('name'),
            'locker'=>request('locker'),
            'code'=>request('code'),
            'info_id'=>null,
            'active'=>request('active')
        ];

        // Only update password if provided, otherwise keep existing one
        if (request('password')) {
            $data['password'] = request('password');
        } else {
            $data['password'] = $professional->password;
        }

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

    public function accidentabilitatPartial(Professional $professional)
    {
        $accidents = Accident::where('professional_id', $professional->id)
            ->with('registrant')
            ->latest()
            ->get();
        $userRole = auth()->user()->role;
        return view('professional.partials._accidentabilitat', compact('accidents', 'professional', 'userRole'));
    }

    public function storeAccidentabilitat(Request $request, Professional $professional)
    {
        $request->validate([
            'data' => 'required|date',
            'context' => 'nullable|string',
            'descripcio' => 'nullable|string',
            'durada' => 'nullable|integer|min:1',
            'type' => 'required|in:sense_baixa,amb_baixa,seguiment_baixes',
        ]);

        if ($request->type === 'amb_baixa' && !$request->durada) {
            return back()->withErrors(['durada' => 'La durada és obligatòria per accidents amb baixa.']);
        }

        Accident::create([
            'date' => $request->data,
            'type' => $request->type,
            'context' => $request->context,
            'description' => $request->descripcio,
            'durada' => $request->durada,
            'professional_id' => $professional->id,
            'registrant_user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Accidentabilitat afegida correctament.');
    }

}
