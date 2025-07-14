<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'formLogin']);
Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');

Route::group(['admin'], function () {
Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // route magic/resource laravel for crud
Route::resource('anggota', KelolaAnggotaController::class);
Route::get('/kategori-buku', [KategoriBukuController::class, 'index'])->name('kategori-buku');
Route::resource('kategori', KategoriBukuController::class);
Route::resource('bukus', BukuController::class);
Route::resource('peminjaman',PeminjamanController::class);
Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route khusus admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
});

Route::middleware(['auth', 'role:anggota'])->group(function () {
    // Route khusus anggota
    Route::get('/anggota/dashboard', [AnggotaDashboardController::class, 'index']);
});
Route::middleware(['auth', 'checkRole:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [App\Http\Controllers\Anggota\DashboardController::class, 'index'])->name('anggota.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/anggota/dashboard', [\App\Http\Controllers\Anggota\DashboardController::class, 'index'])->name('anggota.dashboard');
});
Route::get('/anggota/buku', [App\Http\Controllers\Anggota\BukuController::class, 'index'])->name('anggota.buku.index');











    // cara manuak satu-satu
    // Route::get('/kelola-anggota', [KelolaAnggotaController::class, 'index'])->name('anggota.index');
    // Route::get('/kelola-anggota/create', [KelolaAnggotaController::class, 'create'])->name('anggota.create');
    // Route::post('/kelola-anggota', [KelolaAnggotaController::class, 'store'])->name('anggota.store');
    // Route::get('/kelola-anggota/edit/{id}', [KelolaAnggotaController::class, 'edit'])->name('anggota.edit');
    // Route::patch('/kelola-anggota/update/{id}', [KelolaAnggotaController::class, 'update'])->name('anggota.update');
    // Route::delete('/kelola-anggota/{id}', [KelolaAnggotaController::class, 'destroy'])->name('anggota.destroy');
})->middleware('auth');
