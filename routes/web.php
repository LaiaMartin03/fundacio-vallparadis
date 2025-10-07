<?php

use Illuminate\Support\Facades\Route;
;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('center', App\Http\Controllers\CenterController::class);
Route::put('center/{center}/activate', [App\Http\Controllers\CenterController::class, 'activate'])->name('center.activate');

Route::resource('project', App\Http\Controllers\ProjectController::class);
Route::put('project/{project}/activate', [App\Http\Controllers\ProjectController::class, 'activate'])->name('project.activate');

Route::resource('professional', App\Http\Controllers\ProfessionalController::class);
Route::put('professional/{professional}/activate', [App\Http\Controllers\ProfessionalController::class, 'activate'])->name('professional.activate');