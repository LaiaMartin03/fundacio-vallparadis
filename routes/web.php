<?php

use Illuminate\Support\Facades\Route;
;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('center', App\Http\Controllers\CenterController::class);
Route::resource('project', App\Http\Controllers\ProjectController::class);
Route::resource('professional', App\Http\Controllers\ProfessionalController::class);