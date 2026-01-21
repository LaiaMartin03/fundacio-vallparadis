<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\EvaluationFormController;
use App\Http\Controllers\CenterFollowupController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\LearningProgramController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\OutsiderController;
use App\Http\Controllers\InternalDocController;
use App\Http\Controllers\MantenimentController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\ServeiController;

/*
|--------------------------------------------------------------------------
| Ruta raíz
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Debug usuario
|--------------------------------------------------------------------------
*/
Route::get('/debug-user', function () {
    $user = Auth::user();
    return [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
        'professio' => $user->professio,
        'active' => $user->active,
    ];
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $breadcrumbs = [
        'Inicio' => route('dashboard'),
    ];
    return view('dashboard', compact('breadcrumbs'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |========== PERFIL (TODOS) ==========
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |========== CENTRO (Equip Directiu, Administració) ==========
    */
    Route::resource('center', CenterController::class)
        ->middleware(['role:Equip Directiu,Administració']);

    Route::put('center/{center}/activate', [CenterController::class, 'activate'])
        ->name('center.activate')
        ->middleware(['role:Equip Directiu,Administració']);

    /*
    |========== PROYECTOS ==========
    */
    Route::resource('project', ProjectController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::put('project/{project}/activate', [ProjectController::class, 'activate'])
        ->name('project.activate')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('project/{project}/addProfessional', [ProjectController::class, 'addProfessional'])
        ->name('project.addProfessional')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('project/{project}/storeProfessional', [ProjectController::class, 'storeProfessional'])
        ->name('project.storeProfessional')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::delete('project/{project}/removeProfessional/{professional}', [ProjectController::class, 'removeProfessional'])
        ->name('project.removeProfessional')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== PROFESIONALES ==========
    */
    Route::resource('professional', ProfessionalController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::put('professional/{professional}/activate', [ProfessionalController::class, 'activate'])
        ->name('professional.activate')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('professionals/import', [ProfessionalController::class, 'importProfessionals'])
        ->name('professionals.import')
        ->middleware(['role:Equip Directiu,Administració']);

    Route::get('professionals/export', [ProfessionalController::class, 'exportProfessionals'])
        ->name('professionals.export')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('professional/{professional}/uniformes', [ProfessionalController::class, 'uniformes'])
        ->name('professional.uniformes')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('professionals/search', [ProfessionalController::class, 'search'])
        ->name('professionals.search')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== EVALUACIONES ==========
    */
    Route::get('professional/{professional}/evaluation-form/partial', [EvaluationFormController::class, 'partial'])
        ->name('professional.evaluation_form.partial')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('professional/{professional}/evaluation-form', [EvaluationFormController::class, 'store'])
        ->name('professional.evaluation_form.store')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('professional/{professional}/evaluation-form/sum_partial', [EvaluationFormController::class, 'sumPartial'])
        ->name('professional.evaluation_form.sum_partial')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== SEGUIMIENTOS (SOLO Equip Directiu) ==========
    */
    Route::get('professional/{professional}/followups/partial', [CenterFollowupController::class, 'partial'])
        ->name('professional.followups.partial')
        ->middleware(['role:Equip Directiu']);

    Route::post('professional/{professional}/followups', [CenterFollowupController::class, 'store'])
        ->name('professional.followups.store')
        ->middleware(['role:Equip Directiu']);

    /*
    |========== RECURSOS ==========
    */
    Route::resource('resources', ResourceController::class)
        ->except(['show'])
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('resources/export', [ResourceController::class, 'exportResources'])
        ->name('resources.export')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('resources/import', [ResourceController::class, 'importResources'])
        ->name('resources.import')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== PROGRAMAS FORMATIVOS ==========
    */
    Route::resource('learningprogram', LearningProgramController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== CURSOS ==========
    */
    Route::resource('curso', CursoController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('cursos/export', [CursoController::class, 'exportCursos'])
        ->name('curso.export')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::post('save-drag-drops', [LearningProgramController::class, 'saveDragDrops'])
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== CONTACTES EXTERNS ==========
    */
    Route::resource('outsiders', OutsiderController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    Route::get('outsiders/edit', [OutsiderController::class, 'edit'])
        ->name('outsiders.edit.custom')
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== DOCUMENTACIÓ INTERNA (SOLO Equip Directiu) ==========
    */
    Route::resource('internal-docs', InternalDocController::class)
        ->middleware(['role:Equip Directiu']);

    Route::post('internal-docs/search', [InternalDocController::class, 'search'])
        ->name('internal-docs.search')
        ->middleware(['role:Equip Directiu']);

    Route::get('internal-docs/{internalDoc}/download', [InternalDocController::class, 'download'])
        ->name('internal-docs.download')
        ->middleware(['role:Equip Directiu']);

    Route::post('internal-docs/bulk-download', [InternalDocController::class, 'bulkDownload'])
        ->name('internal-docs.bulk-download')
        ->middleware(['role:Equip Directiu']);

    /*
    |========== MANTENIMENT ==========
    */
    Route::resource('manteniment', MantenimentController::class)
        ->middleware(['role:Equip Directiu,Administració']);

    /*
    |========== HUMAN RESOURCES (SOLO Equip Directiu) ==========
    */
    Route::resource('hr', HRController::class)
        ->middleware(['role:Equip Directiu']);

    Route::post('hr/{hr}/followups', [HRController::class, 'storeFollowup'])
        ->name('hr.followups.store')
        ->middleware(['role:Equip Directiu']);

    Route::delete('hr/followups/{followup}', [HRController::class, 'destroyFollowup'])
        ->name('hr.followups.destroy')
        ->middleware(['role:Equip Directiu']);

    Route::put('hr/{hr}/activate', [HRController::class, 'activate'])
        ->name('hr.activate')
        ->middleware(['role:Equip Directiu']);

    Route::post('hr/search', [HRController::class, 'search'])
        ->name('hr.search')
        ->middleware(['role:Equip Directiu']);

    /*
    |========== SERVEIS ==========
    */
    Route::resource('serveis', ServeiController::class)
        ->middleware(['role:Equip Directiu,Administració,Responsable/Equip Tecnic']);

    /*
    |========== BLACKBOARD ==========
    */
    Route::get('blackboard', function () {
        $breadcrumbs = [
            'Inicio' => route('dashboard'),
            'Pizarra' => route('blackboard'),
        ];
        return view('blackboard', compact('breadcrumbs'));
    })->name('blackboard');
});

require __DIR__ . '/auth.php';
