<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CursoController;

// Ruta raíz: redirige según si el usuario está logueado
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Center
    Route::resource('center', CenterController::class);
    Route::put('center/{center}/activate', [CenterController::class, 'activate'])->name('center.activate');

    // Project
    Route::resource('project', ProjectController::class);
    Route::put('project/{project}/activate', [ProjectController::class, 'activate'])->name('project.activate');

    // Professional
    Route::resource('professional', ProfessionalController::class);
    Route::get('/professional/{id}', [ProfessionalController::class, 'show'])->name('professional.show');
    Route::put('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
    Route::post('professionals/import', [ProfessionalController::class, 'importProfessionals'])->name('professionals.import');
    Route::get('/professionals/export', [ProfessionalController::class, 'exportProfessionals'])->name('professionals.export');
    Route::get('/professional/{professional}/uniformes', [ProfessionalController::class, 'uniformes'])->name('professional.uniformes');

    // Resources
    Route::resource('resources', ResourceController::class)->except(['show']);
    Route::get('resources/export', [ResourceController::class, 'exportResources'])->name('resources.export');
    Route::post('resources/import', [ResourceController::class, 'importResources'])->name('resources.import');

    // Learning Programs
    Route::resource('learningprogram', \App\Http\Controllers\LearningProgramController::class);

    // Cursos
    Route::resource('curso', CursoController::class);
    Route::get('/curso/{id}', [CursoController::class, 'show'])->name('curso.show');
});

require __DIR__.'/auth.php';
