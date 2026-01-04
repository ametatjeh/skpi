<?php

use Illuminate\Support\Facades\Route;

// Controllers (update path/namespace jika perlu)
use App\Http\Controllers\Fakultas\DashboardFakultasController;
use App\Http\Controllers\Fakultas\VerifikasiSkpiController;
use App\Http\Controllers\Fakultas\ApprovalController;
use App\Http\Controllers\Fakultas\DraftSkpiController;
use App\Http\Controllers\Fakultas\LaporanController;
use App\Http\Controllers\Fakultas\NotifikasiController;
use App\Http\Controllers\Fakultas\ProfileFakultasController;
use App\Http\Controllers\Fakultas\OperatorFakultasController;
use App\Http\Controllers\Fakultas\ReportSkpiController;

Route::middleware(['auth:fakultas'])
    ->prefix('fakultas')
    ->name('fakultas.')
    ->group(function () {

        /** Dashboard */
        Route::get('/dashboard', [DashboardFakultasController::class, 'index'])->name('dashboard');

        /** Verifikasi SKPI Per Kategori (masih ada di sebagian kampus) */
        Route::resource('verifikasi', VerifikasiSkpiController::class);

        Route::post('verifikasi/{id}/approve', [VerifikasiSkpiController::class, 'approve'])
            ->name('verifikasi.approve');
        Route::post('verifikasi/{id}/reject', [VerifikasiSkpiController::class, 'reject'])
            ->name('verifikasi.reject');

        /** Verifikasi & Preview Draft SKPI (Modern, best practice) */
        Route::get('draft-skpi', [DraftSkpiController::class, 'index'])->name('draft-skpi.index');
        Route::get('draft-skpi/{id}/preview', [DraftSkpiController::class, 'preview'])->name('draft-skpi.preview');
        // (Opsional) Arsip draft SKPI
        Route::get('draft-skpi/{id}/arsip', [DraftSkpiController::class, 'arsipShow'])->name('draft-skpi.arsipShow');

        /** Approval Final/Forward/Arsip */
        Route::resource('approval', ApprovalController::class);

        // Arsip SKPI (sudah disetujui akhir)
        Route::get('arsip', [ApprovalController::class, 'arsipIndex'])->name('arsip.index');
        Route::get('arsip/{id}', [ApprovalController::class, 'arsipShow'])->name('arsip.show');
        Route::get('arsip/{id}/pdf', [ApprovalController::class, 'arsipDownloadPdf'])->name('arsip.download.pdf');

        /** Laporan SKPI */
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
        Route::get('laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');

        /** Report SKPI (Rekap, statistik) */
        Route::get('report', [ReportSkpiController::class, 'index'])->name('report.index');
        Route::get('report/export/pdf', [ReportSkpiController::class, 'exportPdf'])->name('report.export.pdf');
        Route::get('report/export/excel', [ReportSkpiController::class, 'exportExcel'])->name('report.export.excel');

        /** Notifikasi Fakultas */
        Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::post('notifikasi/read/{id}', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
        Route::post('notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.readAll');

        /** Profile Fakultas */
        Route::get('profile/edit', [ProfileFakultasController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [ProfileFakultasController::class, 'update'])->name('profile.update');

        /** Operator Fakultas (Data Akun) */
        Route::resource('operators', OperatorFakultasController::class);
    });
