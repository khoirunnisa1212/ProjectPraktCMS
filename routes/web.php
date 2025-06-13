<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('obat.index');
})->name('obat.index');

Route::get('/pendaftaran', [ObatController::class, 'formPendaftaran'])->name('form.pendaftaran');
Route::post('/pendaftaran/submit', [ObatController::class, 'submitPendaftaran'])->name('pendaftaran.submit');

Route::get('/obat', [ObatController::class, 'formObat'])->name('form.obat');
Route::post('/obat/submit', [ObatController::class, 'submitObat'])->name('obat.submit');

Route::get('/pendaftar/{id}', [ObatController::class, 'showPendaftar'])->name('pendaftar.show');
Route::delete('/pendaftar/{id}', [ObatController::class, 'destroy'])->name('pendaftar.destroy');

Route::get('/obat/{id}', [ObatController::class, 'showObat'])->name('obat.show');

Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');
Route::post('/obat-submit', [ObatController::class, 'submitObat'])->name('obat.submit');

Route::get('/pendaftaran-pasien', function () {
    return 'Selamat datang di halaman Pendaftaran Pasien Online';
})->middleware('check.age');

Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');