<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AnggotaDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('warga', WargaController::class);
    Route::resource('iuran', IuranController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/per-bulan', [LaporanController::class, 'perBulan'])->name('laporan.per-bulan');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaDashboardController::class, 'index'])->name('anggota.dashboard');
    Route::post('/anggota/bayar-iuran', [AnggotaDashboardController::class, 'bayarIuran'])->name('anggota.bayar-iuran');
});

require __DIR__.'/auth.php';