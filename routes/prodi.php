<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prodi\{
    DashboardProdiController,
    VerifikasiProdiController,
    DraftSkpiController,
    LaporanProdiController,
    ApprovalController,
    ExportProdiController,
    ProdiCplController,
    PengaturanController
};

// Semua route dalam group ini butuh login via guard:prodi
Route::middleware(['auth:prodi'])
    ->prefix('prodi')
    ->name('prodi.')
    ->group(function () {

        // ===== DASHBOARD =====
        Route::get('/dashboard', [DashboardProdiController::class, 'index'])->name('dashboard');

        // ===== PENGATURAN AKUN =====
        Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
            Route::get('/', [PengaturanController::class, 'index'])->name('index');
            Route::put('/profile', [PengaturanController::class, 'updateProfile'])->name('profile.update');
            Route::put('/password', [PengaturanController::class, 'updatePassword'])->name('password.update');
        });

        // ===== VERIFIKASI =====
        Route::get('verifikasi', [VerifikasiProdiController::class, 'index'])->name('verifikasi.index');
        Route::get('verifikasi/{id}', [VerifikasiProdiController::class, 'detail'])->name('verifikasi.detail');
        Route::post('verifikasi/{id}/approve', [VerifikasiProdiController::class, 'approve'])->name('verifikasi.approve');
        Route::post('verifikasi/{id}/reject', [VerifikasiProdiController::class, 'reject'])->name('verifikasi.reject');
        Route::post('verifikasi/{id}/revisi', [VerifikasiProdiController::class, 'revisi'])->name('verifikasi.revisi');

        // ===== DRAFT SKPI =====
        Route::get('draft-skpi', [DraftSkpiController::class, 'index'])->name('draft-skpi.index');
        Route::get('draft-skpi/create/{verifikasi_id}', [DraftSkpiController::class, 'create'])->name('draft-skpi.create');
        Route::post('draft-skpi/store', [DraftSkpiController::class, 'store'])->name('draft-skpi.store');
        Route::get('draft-skpi/{id}/edit', [DraftSkpiController::class, 'edit'])->name('draft-skpi.edit');
        Route::put('draft-skpi/{id}/update', [DraftSkpiController::class, 'update'])->name('draft-skpi.update');
        Route::get('draft-skpi/{id}/preview', [DraftSkpiController::class, 'preview'])->name('draft-skpi.preview');
        Route::get('draft-skpi/{id}/generate-pdf', [DraftSkpiController::class, 'generatePdf'])->name('draft-skpi.generate-pdf');
        Route::post('draft-skpi/{id}/submit', [DraftSkpiController::class, 'submit'])->name('draft-skpi.submit');
        Route::post('draft-skpi/{id}/submit-fakultas', [DraftSkpiController::class, 'submitFakultas'])->name('draft-skpi.submit_fakultas');


        // ===== CPL MANAGEMENT =====
        Route::prefix('cpl')
            ->name('cpl.')
            ->group(function () {
                Route::get('/', [ProdiCplController::class, 'index'])->name('index');
                Route::get('create', [ProdiCplController::class, 'create'])->name('create');
                Route::post('store', [ProdiCplController::class, 'store'])->name('store');
                Route::get('{id}/edit', [ProdiCplController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ProdiCplController::class, 'update'])->name('update');
                Route::post('{id}/delete', [ProdiCplController::class, 'destroy'])->name('destroy');
                Route::get('api/statistics', [ProdiCplController::class, 'statistics'])->name('statistics');
            });

        // ===== LAPORAN & ANALYTICS =====
        Route::prefix('laporan')
            ->name('laporan.')
            ->group(function () {
                Route::get('verifikasi', [LaporanProdiController::class, 'verifikasi'])->name('verifikasi');
                Route::get('analytics', [LaporanProdiController::class, 'analytics'])->name('analytics');
                Route::get('sla-monitoring', [LaporanProdiController::class, 'slaMonitoring'])->name('sla');
                Route::get('export-verifikasi', [ExportProdiController::class, 'exportVerifikasi'])->name('export-verifikasi');
                Route::get('export-summary', [ExportProdiController::class, 'exportSummary'])->name('export-summary');
            });

        // ===== APPROVAL LOG =====
        Route::prefix('approval')
            ->name('approval.')
            ->group(function () {
                Route::get('history/{verifikasi_id}', [ApprovalController::class, 'history'])->name('history');
                Route::get('timeline/{verifikasi_id}', [ApprovalController::class, 'timeline'])->name('timeline');
            });

        // ===== DASHBOARD API (AJAX) =====
        Route::prefix('api')
            ->name('api.')
            ->group(function () {
                Route::get('statistics', [DashboardProdiController::class, 'statistics'])->name('statistics');
                Route::get('recent-activities', [DashboardProdiController::class, 'recentActivities'])->name('activities');
                Route::get('chart-data', [DashboardProdiController::class, 'getChartData'])->name('chart-data');
                Route::post('notification/{id}/read', [DashboardProdiController::class, 'markNotificationAsRead'])->name('notification.read');
                Route::post('notifications/read-all', [DashboardProdiController::class, 'markAllNotificationsAsRead'])->name('notifications.read-all');
            });
    });
