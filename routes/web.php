<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// ==================== HALAMAN UTAMA ====================
Route::get('/', function () {
    return redirect('/dashboard');
});

// ==================== SEMUA HALAMAN (TANPA LOGIN) ====================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/detail', [DashboardController::class, 'detail'])->name('detail');
Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('transaksi');
Route::get('/daftar', [DashboardController::class, 'daftar'])->name('daftar');

// Proses transaksi (POST)
Route::post('/transaksi', [DashboardController::class, 'prosesTransaksi'])->name('transaksi.store');
