<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;

Route::get('/', function () {
    return view('obat.index');
})->name('obat.index');

Route::get('/pendaftaran', [ObatController::class, 'formPendaftaran'])->name('form.pendaftaran');
Route::post('/pendaftaran/submit', [ObatController::class, 'submitPendaftaran'])->name('pendaftaran.submit');

Route::get('/obat', [ObatController::class, 'formObat'])->name('form.obat');
Route::post('/obat/submit', [ObatController::class, 'submitObat'])->name('obat.submit');

Route::get('/pendaftar/{id}', [ObatController::class, 'showPendaftar'])->name('pendaftar.show');
Route::delete('/pendaftar/{id}', [ObatController::class, 'destroy'])->name('pendaftar.destroy');
