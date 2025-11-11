<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningProgram;
use App\Models\Curso;
use App\Models\Professional;

class LearningProgramController extends Controller
{
    public function index()
    {
        $cursos = LearningProgram::all();
        return view('learningprogram.index', compact('cursos'));
    }

    public function create()
    {
        $learningprogram = LearningProgram::all();
        $centers = \App\Models\Center::all();
        $cursos = \App\Models\Curso::all();
        $professionals = Professional::all(); // Usa el modelo correcto
        
        return view('learningprogram.create', compact('learningprogram','centers','cursos','professionals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:curso,id',
            'user_id' => 'required|exists:users,id'
        ]);

        LearningProgram::create([
            'center_id' => 1,
            'curso_id' => $request->curso_id,
            'user_id' => $request->user_id,
        ]);
        
        return redirect()->route('learningprogram.create')->with('success', 'Learning Program creat correctament.');
    }

    public function edit(LearningProgram $learningprogram)
    {
        return view('learningprogram.edit', compact('learningprogram'));
    }

    public function activate(LearningProgram $learningprogram)
    {
        $learningprogram->update(['active' => 1]);
        return redirect()->route('learningprogram.index')->with('success', 'Professional activat correctament.');
    }

    public function destroy(LearningProgram $learningprogram)
    {
        $learningprogram->update(['active' => 0]);
        return redirect()->route('learningprogram.index')->with('success', 'Professional desactivat correctament.');
    }

    public function saveDragDrops(Request $request)
    {
        try {
            $data = $request->json()->all();
            
            \Log::info('=== SAVE DRAG & DROP INICIADO ===');
            \Log::info('Datos recibidos:', $data);

            if (!is_array($data) || empty($data)) {
                return response()->json(['error' => 'Formato inválido o vacío'], 400);
            }

            $registrosCreados = 0;
            $registrosExistentes = 0;
            $errores = [];

            foreach ($data as $cursoId => $userIds) {
                // Convierte clave a número (por si es string)
                $cursoId = (int)$cursoId;
                
                if (!is_array($userIds)) {
                    $errores[] = "cursoId $cursoId: userIds no es array";
                    continue;
                }

                // Verifica que el curso existe
                $curso = Curso::find($cursoId);
                if (!$curso) {
                    $errores[] = "Curso no encontrado: $cursoId";
                    continue;
                }

                foreach ($userIds as $userId) {
                    $userId = (int)$userId;
                    
                    // Verifica que el usuario existe
                    $user = Professional::find($userId);
                    if (!$user) {
                        $errores[] = "Usuario no encontrado: $userId";
                        continue;
                    }

                    // Intenta crear o encontrar
                    $program = LearningProgram::firstOrCreate([
                        'curso_id' => $cursoId,
                        'user_id' => $userId,
                        'center_id' => 1,
                    ]);
                    
                    if ($program->wasRecentlyCreated) {
                        $registrosCreados++;
                    } else {
                        $registrosExistentes++;
                    }
                }
            }

            \Log::info("=== RESULTADO ===", [
                'creados' => $registrosCreados,
                'existentes' => $registrosExistentes,
                'errores' => $errores
            ]);

            return response()->json([
                'success' => true,
                'registros_creados' => $registrosCreados,
                'registros_existentes' => $registrosExistentes,
                'errores' => $errores // Para depuración
            ]);

        } catch (\Exception $e) {
            \Log::error('=== ERROR CRÍTICO ===');
            \Log::error('Mensaje: ' . $e->getMessage());
            \Log::error('Archivo: ' . $e->getFile() . ' Línea: ' . $e->getLine());
            
            return response()->json([
                'error' => 'Error interno: ' . $e->getMessage()
            ], 500);
        }
    }
}