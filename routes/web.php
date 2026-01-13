<?php

use App\Http\Controllers\LearningProgramController;
use App\Http\Controllers\EvaluationFormController;
use App\Http\Controllers\CenterFollowupController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\OutsiderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\MantenimentController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Resource;

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
    Route::put('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
    Route::post('professionals/import', [ProfessionalController::class, 'importProfessionals'])->name('professionals.import');
    Route::get('/professionals/export', [ProfessionalController::class, 'exportProfessionals'])->name('professionals.export');
    Route::get('/professional/{professional}/uniformes', [ProfessionalController::class, 'uniformes'])->name('professional.uniformes');

    // formulario via fetch
    Route::get('professional/{professional}/evaluation-form/partial', [EvaluationFormController::class, 'partial'])
        ->name('professional.evaluation_form.partial');

    // guardar
    Route::post('professional/{professional}/evaluation-form', [EvaluationFormController::class, 'store'])
        ->name('professional.evaluation_form.store');

    // sumatori
    Route::get('professional/{professional}/evaluation-form/sum_partial', [EvaluationFormController::class, 'sumPartial'])
        ->name('professional.evaluation_form.sum_partial');

    // listado parcial (fetch)
    Route::get('professional/{professional}/followups/partial', [CenterFollowupController::class, 'partial'])
        ->name('professional.followups.partial');

    // guardar followup (form)
    Route::post('professional/{professional}/followups', [CenterFollowupController::class, 'store'])
        ->name('professional.followups.store');

    // listado uniformes
    Route::get('professional/{professional}/uniformes-partial', [ResourceController::class, 'partial'])->name('professional.uniformes.partial');

    // Resources
    Route::resource('resources', ResourceController::class)->except(['show']);
    Route::get('resources/export', [ResourceController::class, 'exportResources'])->name('resources.export');
    Route::post('resources/import', [ResourceController::class, 'importResources'])->name('resources.import');

    // Learning Programs
    Route::resource('learningprogram', LearningProgramController::class);

    // Cursos
    Route::resource('curso', CursoController::class);
    // Route::view('curso/vista', 'cursos.curso')->name('cursos.curso');
    Route::get('/cursos/export', [CursoController::class, 'exportCursos'])->name('curso.export');
    Route::post('/save-drag-drops', [LearningProgramController::class, 'saveDragDrops']);

    //Contactes externs
    Route::resource('outsiders', OutsiderController::class);
    Route::get('/outsiders/edit', [OutsiderController::class, 'edit'])
    ->name('outsiders.edit.custom');

    //Documentació interna
    Route::resource('internal-docs', InternalDocController::class);

    //Manteniment
    Route::resource('manteniment', MantenimentController::class);
});

require __DIR__.'/auth.php';
