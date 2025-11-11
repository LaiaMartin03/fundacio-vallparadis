<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('project/{project}/addProfessional', [ProjectController::class, 'addProfessional'])->name('project.addProfessional');
    Route::post('project/{project}/storeProfessional', [ProjectController::class, 'storeProfessional'])->name('project.storeProfessional');
    Route::delete('project/{project}/removeProfessional/{professional}', [ProjectController::class, 'removeProfessional'])->name('project.removeProfessional');

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

});

require __DIR__.'/auth.php';
