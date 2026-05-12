<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TripController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/detail', [DashboardController::class, 'detail'])->name('detail');          
    Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('transaksi');
    Route::get('/daftar', [DashboardController::class, 'daftar'])->name('daftar');
    Route::post('/transaksi', [DashboardController::class, 'prosesTransaksi'])->name('transaksi.store');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('trips', TripController::class);
});

Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');

require __DIR__.'/auth.php';