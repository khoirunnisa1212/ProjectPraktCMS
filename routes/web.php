<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// login
Route::get('/', fn() => redirect()->route('login'));

// Login & Register (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Logout
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Pendaftar/Pasien
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ObatController::class, 'index'])->name('obat.index');

    Route::get('/pendaftaran', [ObatController::class, 'formPendaftaran'])->name('form.pendaftaran');
    Route::post('/pendaftaran', [ObatController::class, 'submitPendaftaran'])->name('submit.pendaftaran');

    Route::get('/cek-pendaftar', [ObatController::class, 'formCekPendaftar'])->name('form.cek.pendaftar');
    Route::get('/cek-pendaftar/search', [ObatController::class, 'cekPendaftar'])->name('obat.cek');

    Route::get('/obat-antrian', [ObatController::class, 'formObat'])->name('form.obat');
    Route::post('/obat-submit', [ObatController::class, 'submitObat'])->name('obat.submit');

    Route::get('/upload', [ImageController::class, 'create'])->name('obat.upload');
    Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
    Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::get('/pendaftar/{id}', [ObatController::class, 'showPendaftar'])->name('pendaftar.show');
    Route::delete('/pendaftar/{id}', [ObatController::class, 'destroy'])->name('pendaftar.destroy');
    Route::get('/pendaftar/{id}/edit', [ObatController::class, 'edit'])->name('pendaftar.edit');
    Route::post('/pendaftar/{id}/update', [ObatController::class, 'update'])->name('pendaftar.update');

    Route::get('/riwayat-pemeriksaan', [ObatController::class, 'semuaRiwayat'])->name('riwayat.pemeriksaan');
    Route::get('/jadwal-dokter', [ObatController::class, 'jadwalDokterPasien'])->name('obat.jadwal');
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/pendaftar/{id}/edit', [AdminController::class, 'edit'])->name('admin.pendaftar.edit');
    Route::delete('/admin/pendaftar/{id}', [AdminController::class, 'destroy'])->name('admin.pendaftar.destroy');
    Route::get('/admin/pendaftar/{id}/detail', [AdminController::class, 'detail'])->name('admin.pendaftar.detail');
    Route::get('/admin/pendaftar', [AdminController::class, 'index'])->name('admin.pendaftar.index');
    Route::post('/admin/pendaftar/{id}/edit', [AdminController::class, 'storeRiwayat'])->name('admin.pendaftar.riwayat.store');
    Route::get('/admin/images', [AdminController::class, 'images'])->name('admin.images');
    Route::get('/admin/jadwal-dokter', [AdminController::class, 'jadwalDokterIndex'])->name('admin.jadwal');
    Route::post('/admin/jadwal-dokter', [AdminController::class, 'jadwalDokterStore'])->name('admin.jadwal.store');
    Route::delete('/admin/jadwal/{id}', [AdminController::class, 'hapusJadwal'])->name('admin.jadwal.destroy');
});
