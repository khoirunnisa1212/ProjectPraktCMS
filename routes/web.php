<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;

// 1. Halaman utama diarahkan ke login
Route::get('/', fn() => redirect()->route('login'));

// 2. Setelah login, redirect ke halaman utama (obat.index)
Route::middleware('auth')->get('/home', function () {
    return redirect()->route('obat.index');
})->name('home');

// 3. Halaman utama setelah login
Route::get('/dashboard', [ObatController::class, 'index'])->name('obat.index');

// 4. Form Pendaftaran
Route::get('/pendaftaran', [ObatController::class, 'formPendaftaran'])->name('form.pendaftaran');
Route::post('/pendaftaran', [ObatController::class, 'submitPendaftaran'])->name('submit.pendaftaran');

// 5. Cek pendaftar
Route::get('/cek-pendaftar', [ObatController::class, 'formCekPendaftar'])->name('form.cek.pendaftar');
Route::get('/cek-pendaftar/search', [ObatController::class, 'cekPendaftar'])->name('obat.cek');

// 6. Antrian Obat
Route::get('/obat-antrian', [ObatController::class, 'formObat'])->name('form.obat');
Route::post('/obat-submit', [ObatController::class, 'submitObat'])->name('obat.submit');

// 7. Upload Gambar
Route::get('/upload', [ImageController::class, 'create'])->name('obat.upload');
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.destroy');

// 8. Pendaftar - hapus dan lihat
Route::get('/pendaftar/{id}', [ObatController::class, 'showPendaftar'])->name('pendaftar.show');
Route::delete('/pendaftar/{id}', [ObatController::class, 'destroy'])->name('pendaftar.destroy');

// 9. Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
