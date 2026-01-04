<?php

use Illuminate\Support\Facades\Route;

// AUTH
use App\Http\Controllers\Auth\AdminLoginController;

// DASHBOARD
use App\Http\Controllers\Admin\DashboardAdminController;

// MAHASISWA
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ProgressController;

// KEGIATAN
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\SertifikasiController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Admin\PKMController;

// DOKUMEN
use App\Http\Controllers\Admin\DokumenController;

// VERIFIKASI
use App\Http\Controllers\Admin\VerifikasiController;

// SKPI
use App\Http\Controllers\Admin\SkpiDraftController;
use App\Http\Controllers\Admin\SkpiFinalController;
use App\Http\Controllers\Admin\ProdiSkpiController;

// PENGATURAN
use App\Http\Controllers\Admin\TemplateSkpiController;
use App\Http\Controllers\Admin\BlankoController;
use App\Http\Controllers\Admin\QrController;

// USER & LAPORAN
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanAdminController;

// MASTER DATA
use App\Http\Controllers\Admin\TotalMahasiswaController;
use App\Http\Controllers\Admin\TotalProdiController;
use App\Http\Controllers\Admin\TotalFakultasController;

/*
|--------------------------------------------------------------------------
| AUTH ADMIN (Public Routes)
|--------------------------------------------------------------------------
*/

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('admin/login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

Route::post('admin/logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | MAHASISWA - FULL CRUD RESOURCE
        |--------------------------------------------------------------------------
        */
        Route::resource('mahasiswa', MahasiswaController::class);

        /*
        |--------------------------------------------------------------------------
        | PROGRESS MAHASISWA
        |--------------------------------------------------------------------------
        */
        Route::get('/progress', [ProgressController::class, 'index'])
            ->name('progress.index');

        Route::get('/progress/{id}', [ProgressController::class, 'show'])
            ->name('progress.show');

        /*
        |--------------------------------------------------------------------------
        | KEGIATAN - FULL CRUD RESOURCES
        |--------------------------------------------------------------------------
        */
        Route::resource('prestasi', PrestasiController::class);
        Route::resource('sertifikasi', SertifikasiController::class);
        Route::resource('organisasi', OrganisasiController::class);
        Route::resource('pkm', PKMController::class);

        /*
        |--------------------------------------------------------------------------
        | DOKUMEN PENDUKUNG
        |--------------------------------------------------------------------------
        */
        Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
        Route::get('/dokumen/download/{kategori}/{id}', [DokumenController::class, 'download'])->name('dokumen.download');

        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI
        |--------------------------------------------------------------------------
        */
        Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
            Route::get('/prodi', [VerifikasiController::class, 'prodi'])->name('prodi');
            Route::get('/fakultas', [VerifikasiController::class, 'fakultas'])->name('fakultas');
            Route::get('/semua', [VerifikasiController::class, 'semua'])->name('semua');

            Route::post('/approve/{id}', [VerifikasiController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [VerifikasiController::class, 'reject'])->name('reject');
            Route::post('/revision/{id}', [VerifikasiController::class, 'revision'])->name('revision');
        });

        /*
        |--------------------------------------------------------------------------
        | SKPI - DRAFT & FINAL
        |--------------------------------------------------------------------------
        */
        Route::prefix('skpi')->name('skpi.')->group(function () {
            // DRAFT SKPI
            Route::get('/draft', [SkpiDraftController::class, 'index'])->name('draft');
            Route::post('/generate/{mahasiswa_id}', [SkpiDraftController::class, 'generate'])->name('generate');
            Route::post('/approve/{id}', [SkpiDraftController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [SkpiDraftController::class, 'reject'])->name('reject');
            Route::post('/finalize/{id}', [SkpiDraftController::class, 'finalize'])->name('finalize');
            Route::delete('/destroy/{id}', [SkpiDraftController::class, 'destroy'])->name('destroy');

            // FINAL SKPI
            Route::get('/final', [SkpiFinalController::class, 'index'])->name('final');

            // PREVIEW & DOWNLOAD (shared)
            Route::get('/preview/{id}', [SkpiDraftController::class, 'preview'])->name('preview');
            Route::get('/download-pdf/{id}', [SkpiDraftController::class, 'downloadPdf'])->name('download-pdf');

            // EXPORT (opsional)
            Route::post('/export-excel', [SkpiFinalController::class, 'exportExcel'])->name('export-excel');
            Route::post('/bulk-download', [SkpiFinalController::class, 'bulkDownload'])->name('bulk-download');
        });

        /*
        |--------------------------------------------------------------------------
        | PENGATURAN
        |--------------------------------------------------------------------------
        */

        // Template SKPI (single record: edit & update)
        Route::get('/template-skpi', [TemplateSkpiController::class, 'edit'])
            ->name('template-skpi.edit');
        Route::post('/template-skpi', [TemplateSkpiController::class, 'update'])
            ->name('template-skpi.update');

        // Stok blanko & QR Code
        Route::resource('blanko', BlankoController::class);
        Route::resource('qr', QrController::class);

        /*
        |--------------------------------------------------------------------------
        | PENGATURAN SKPI PER PRODI
        |--------------------------------------------------------------------------
        */
        Route::prefix('prodi-skpi')->name('prodi.skpi.')->group(function () {
            Route::get('/', [ProdiSkpiController::class, 'index'])->name('index');
            Route::post('/{prodi_id}', [ProdiSkpiController::class, 'update'])->name('update');
        });

        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');

            // Mahasiswa
            Route::get('/mahasiswa', [UserController::class, 'mahasiswa'])->name('mahasiswa');

            // PRODI
            Route::get('/prodi', [UserController::class, 'prodi'])->name('prodi');
            Route::get('/prodi/create', [UserController::class, 'createProdi'])->name('prodi.create');
            Route::post('/prodi', [UserController::class, 'storeProdi'])->name('prodi.store');
            Route::get('/prodi/{id}', [UserController::class, 'showProdi'])->name('prodi.show');
            Route::get('/prodi/{id}/edit', [UserController::class, 'editProdi'])->name('prodi.edit');
            Route::put('/prodi/{id}', [UserController::class, 'updateProdi'])->name('prodi.update');
            Route::delete('/prodi/{id}', [UserController::class, 'destroyProdi'])->name('prodi.destroy');

            // FAKULTAS
            Route::get('/fakultas', [UserController::class, 'fakultas'])->name('fakultas');
            Route::get('/fakultas/create', [UserController::class, 'createFakultas'])->name('fakultas.create');
            Route::post('/fakultas', [UserController::class, 'storeFakultas'])->name('fakultas.store');
            Route::get('/fakultas/{id}', [UserController::class, 'showFakultas'])->name('fakultas.show');
            Route::get('/fakultas/{id}/edit', [UserController::class, 'editFakultas'])->name('fakultas.edit');
            Route::put('/fakultas/{id}', [UserController::class, 'updateFakultas'])->name('fakultas.update');
            Route::delete('/fakultas/{id}', [UserController::class, 'destroyFakultas'])->name('fakultas.destroy');

            // PUSAT BAHASA
            Route::get('/pusat-bahasa', [UserController::class, 'pusatBahasa'])->name('pusat-bahasa');
            Route::get('/pusat-bahasa/create', [UserController::class, 'createPusatBahasa'])->name('pusat-bahasa.create');
            Route::post('/pusat-bahasa', [UserController::class, 'storePusatBahasa'])->name('pusat-bahasa.store');
            Route::get('/pusat-bahasa/{id}', [UserController::class, 'showPusatBahasa'])->name('pusat-bahasa.show');
            Route::get('/pusat-bahasa/{id}/edit', [UserController::class, 'editPusatBahasa'])->name('pusat-bahasa.edit');
            Route::put('/pusat-bahasa/{id}', [UserController::class, 'updatePusatBahasa'])->name('pusat-bahasa.update');
            Route::delete('/pusat-bahasa/{id}', [UserController::class, 'destroyPusatBahasa'])->name('pusat-bahasa.destroy');
        });

        // Resource users (tanpa index & show karena sudah custom)
        Route::resource('users', UserController::class)->except(['index', 'show']);

        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */
        // Import Mahasiswa routes (harus sebelum resource route)
        Route::get('total-mahasiswa/import', [TotalMahasiswaController::class, 'showImportForm'])->name('total-mahasiswa.import.form');
        Route::post('total-mahasiswa/import', [TotalMahasiswaController::class, 'import'])->name('total-mahasiswa.import');
        Route::get('total-mahasiswa/template', [TotalMahasiswaController::class, 'downloadTemplate'])->name('total-mahasiswa.template');
        
        Route::resource('total-mahasiswa', TotalMahasiswaController::class);
        Route::resource('total-prodi', TotalProdiController::class);
        Route::resource('total-fakultas', TotalFakultasController::class);

        /*
        |--------------------------------------------------------------------------
        | LAPORAN & STATISTIK
        |--------------------------------------------------------------------------
        */
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanAdminController::class, 'index'])->name('index');
            Route::get('/export-excel', [LaporanAdminController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export-pdf', [LaporanAdminController::class, 'exportPdf'])->name('export.pdf');
        });
    });
