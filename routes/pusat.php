<?php

use App\Http\Controllers\PusatBahasa\DashboardController;
use App\Http\Controllers\PusatBahasa\VerifikasiSkpiController;
use App\Http\Controllers\PusatBahasa\ArsipController;
use App\Http\Controllers\PusatBahasa\LaporanController;
use App\Http\Controllers\PusatBahasa\PengaturanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:pusat_bahasa'])
    ->name('pusat.')
    ->prefix('pusat')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Verifikasi Draft SKPI
        Route::get('/verifikasi', [VerifikasiSkpiController::class, 'index'])->name('verifikasi.index');
        Route::get('/verifikasi/{draft}', [VerifikasiSkpiController::class, 'show'])->name('verifikasi.show');
        Route::put('/verifikasi/{draft}/update-ringkasan', [VerifikasiSkpiController::class, 'updateRingkasan'])->name('verifikasi.update-ringkasan');
        Route::post('/verifikasi/{draft}/approve', [VerifikasiSkpiController::class, 'approve'])->name('verifikasi.approve');
        Route::post('/verifikasi/{draft}/reject', [VerifikasiSkpiController::class, 'reject'])->name('verifikasi.reject');

        // Arsip SKPI (riwayat/final)
        Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip');
        Route::get('/arsip/{draft}', [ArsipController::class, 'show'])->name('arsip.show');
        Route::get('/arsip/{draft}/pdf', [ArsipController::class, 'downloadPdf'])->name('arsip.downloadPdf');

        // Laporan & Statistik
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

        // Pengaturan
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
        Route::post('/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
    });

