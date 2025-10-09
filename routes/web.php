<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UniformController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('center', CenterController::class);
Route::put('center/{center}/activate', [CenterController::class, 'activate'])->name('center.activate');

Route::resource('project', ProjectController::class);
Route::put('project/{project}/activate', [ProjectController::class, 'activate'])->name('project.activate');

Route::put('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
Route::resource('professional', ProfessionalController::class);
Route::post('professionals/import', [ProfessionalController::class, 'importProfessionals'])->name('professionals.import');
Route::get('/professionals/export', [ProfessionalController::class, 'exportProfessionals'])->name('professionals.export');

Route::resource('uniforms', UniformController::class)->except(['show']);
Route::get('uniforms/export', [UniformController::class, 'exportUniforms'])->name('uniforms.export');
Route::post('uniforms/import', [UniformController::class, 'importUniforms'])->name('uniforms.import');
