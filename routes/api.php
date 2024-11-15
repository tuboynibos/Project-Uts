<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/alumni', [AlumniController::class, "index"]);
    Route::post('/alumni', [AlumniController::class, "store"]);
    Route::get('/alumni/{id}', [AlumniController::class, "show"]);
    Route::put('/alumni/{id}', [AlumniController::class, "update"]);
    Route::delete('/alumni/{id}', [AlumniController::class, "destroy"]);
    Route::delete('/alumni/search/{name}', [AlumniController::class, "search"]);
    Route::delete('/alumni/status/fresh-graduate', [AlumniController::class, "freshGraduate"]);
    Route::delete('/alumni/status/employed', [AlumniController::class, "employed"]);
    Route::delete('/alumni/status/unemployed', [AlumniController::class, "unemployed"]);