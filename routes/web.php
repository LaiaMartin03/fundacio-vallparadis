<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CenterController; // Replace with the actual controller name handling import/export

Route::get('/', function () {
    return view('welcome');
});

Route::resource('center', CenterController::class);
Route::put('center/{center}/activate', [CenterController::class, 'activate'])->name('center.activate');

Route::resource('project', ProjectController::class);
Route::put('project/{project}/activate', [ProjectController::class, 'activate'])->name('project.activate');

Route::resource('professional', ProfessionalController::class);
Route::put('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
Route::post('professionals/import', [ProfessionalController::class, 'importProfessionals'])->name('professionals.import');
Route::get('/professionals/export', [ProfessionalController::class, 'exportProfessionals'])->name('professionals.export');
