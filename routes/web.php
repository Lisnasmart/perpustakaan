<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route login
Route::get('/', [LoginController::class, 'formLogin'])->name('login');
Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');

// Logout (wajib pakai POST)
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('status', 'Berhasil logout!');
})->name('logout');

// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD routes
    Route::resource('anggota', KelolaAnggotaController::class);
    Route::get('/kategori-buku', [KategoriBukuController::class, 'index'])->name('kategori-buku');
    Route::resource('kategori', KategoriBukuController::class);
    Route::resource('bukus', BukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/admin/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');
});
