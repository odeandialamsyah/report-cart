<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiSuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::patch('/dashboard/{user}/update-role', [UserController::class, 'updateRole'])->name('admin.updateRole');
Route::delete('/dashboard/{user}', [UserController::class, 'destroy'])->name('admin.deleteUser');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('surat_masuk', SuratMasukController::class)->middleware('auth','role:pengirim,petugas,kepala,admin');
Route::get('surat_masuk/{id}/preview', [SuratMasukController::class, 'preview'])->name('surat_masuk.preview');


Route::resource('surat_keluar', SuratKeluarController::class)->middleware('auth','role:petugas,kepala,admin');
Route::get('surat_keluar/{id}/preview', [SuratKeluarController::class, 'preview'])->name('surat_keluar.preview');

Route::resource('users', UserController::class)->middleware('auth','role:admin');

Route::get('/verifikasi', [VerifikasiSuratController::class, 'index'])->name('verifikasi.index');
Route::patch('/verifikasi/{surat_keluar}/surat_keluar', [SuratKeluarController::class, 'updateStatus'])->name('verifikasi.surat_keluar');
Route::patch('/verifikasi/{surat_masuk}/surat_masuk', [SuratMasukController::class, 'updateStatus'])->name('verifikasi.surat_masuk');



require __DIR__.'/auth.php';
