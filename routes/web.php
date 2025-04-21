<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;

Route::get('/obats', [ObatController::class, 'index']);
Route::get('/obats/{id}', [ObatController::class, 'show']);
Route::post('/obats/{id}/ulasan', [ObatController::class, 'submitUlasan']);
Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');