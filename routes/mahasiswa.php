<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\{
    DashboardMahasiswaController,
    SertifikasiController,
    PrestasiController,
    OrganisasiController,
    PengabdianMasyarakatController,
    KaryaIlmiahController,
    PenghargaanController,
    DokumenController,
    VerifikasiStatusController,
    ApprovalHistoryController,
    DownloadSkpiController,
    ProfileMahasiswaController,
    DraftSkpiController
};

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardMahasiswaController::class, 'index'])->name('dashboard');

    // ============================================================================
    // SERTIFIKASI ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('sertifikasi')->name('sertifikasi.')->group(function () {
        Route::get('/', [SertifikasiController::class, 'list'])->name('list');
        Route::get('/create', [SertifikasiController::class, 'create'])->name('create');
        Route::post('/', [SertifikasiController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [SertifikasiController::class, 'submit'])->name('submit'); // ✅ NEW!
        Route::get('/{id}/edit', [SertifikasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SertifikasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [SertifikasiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [SertifikasiController::class, 'show'])->name('show');
    });

    // ============================================================================
    // PRESTASI ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiController::class, 'list'])->name('list');
        Route::get('/create', [PrestasiController::class, 'create'])->name('create');
        Route::post('/', [PrestasiController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [PrestasiController::class, 'submit'])->name('submit'); // ✅ NEW!
        Route::get('/{id}/edit', [PrestasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [PrestasiController::class, 'show'])->name('show');
    });

    // ============================================================================
    // ORGANISASI ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('organisasi')->name('organisasi.')->group(function () {
        Route::get('/', [OrganisasiController::class, 'list'])->name('list');
        Route::get('/create', [OrganisasiController::class, 'create'])->name('create');
        Route::post('/', [OrganisasiController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [OrganisasiController::class, 'submit'])->name('submit');
        Route::get('/{id}/edit', [OrganisasiController::class, 'edit'])->name('edit'); // <--- ini sudah benar!
        Route::put('/{id}', [OrganisasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [OrganisasiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [OrganisasiController::class, 'show'])->name('show');
    });


    // ============================================================================
    // PKM (Pengabdian Masyarakat) ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('pkm')->name('pkm.')->group(function () {
        Route::get('/', [PengabdianMasyarakatController::class, 'list'])->name('list');
        Route::get('/create', [PengabdianMasyarakatController::class, 'create'])->name('create');
        Route::post('/', [PengabdianMasyarakatController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [PengabdianMasyarakatController::class, 'submit'])->name('submit'); // ✅ NEW!
        Route::get('/{id}/edit', [PengabdianMasyarakatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PengabdianMasyarakatController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengabdianMasyarakatController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [PengabdianMasyarakatController::class, 'show'])->name('show');
    });

    // ============================================================================
    // KARYA ILMIAH ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('karya-ilmiah')->name('karya.')->group(function () {
        Route::get('/', [KaryaIlmiahController::class, 'list'])->name('list');
        Route::get('/create', [KaryaIlmiahController::class, 'create'])->name('create');
        Route::post('/', [KaryaIlmiahController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [KaryaIlmiahController::class, 'submit'])->name('submit'); // ✅ NEW!
        Route::get('/{id}/edit', [KaryaIlmiahController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KaryaIlmiahController::class, 'update'])->name('update');
        Route::delete('/{id}', [KaryaIlmiahController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [KaryaIlmiahController::class, 'show'])->name('show');
    });

    // ============================================================================
    // PENGHARGAAN ROUTES (with SUBMIT)
    // ============================================================================
    Route::prefix('penghargaan')->name('penghargaan.')->group(function () {
        Route::get('/', [PenghargaanController::class, 'list'])->name('list');
        Route::get('/create', [PenghargaanController::class, 'create'])->name('create');
        Route::post('/', [PenghargaanController::class, 'store'])->name('store');
        Route::post('/{id}/submit', [PenghargaanController::class, 'submit'])->name('submit'); // ✅ NEW!
        Route::get('/{id}/edit', [PenghargaanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PenghargaanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PenghargaanController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [PenghargaanController::class, 'show'])->name('show');
    });

    // ============================================================================
    // OTHER ROUTES (unchanged)
    // ============================================================================

    // Dokumen
    Route::prefix('dokumen')->name('dokumen.')->group(function () {
        Route::get('/', [DokumenController::class, 'index'])->name('index');
        Route::get('/upload', [DokumenController::class, 'uploadForm'])->name('upload');
        Route::post('/', [DokumenController::class, 'store'])->name('store');
        Route::get('/{id}/download', [DokumenController::class, 'download'])->name('download');
        Route::delete('/{id}', [DokumenController::class, 'destroy'])->name('destroy');
    });

    // Status Verifikasi
    Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
        Route::get('/', [VerifikasiStatusController::class, 'index'])->name('index');
        Route::get('/{id}', [VerifikasiStatusController::class, 'detail'])->name('detail');
    });

    // Riwayat Approval
    Route::prefix('approval')->name('approval.')->group(function () {
        Route::get('/', [ApprovalHistoryController::class, 'index'])->name('index');
        Route::get('/{id}', [ApprovalHistoryController::class, 'detail'])->name('detail');
    });


    // Status SKPI (Mahasiswa hanya bisa melihat status, tidak bisa download)
    Route::prefix('status-skpi')->name('download.')->group(function () {
        Route::get('/', [DraftSkpiController::class, 'index'])->name('index'); // Tampilkan daftar status SKPI
        // Download dan Preview dihapus - hanya bisa dilakukan oleh Admin dan Biro Akademik
    });


    // Profile
    Route::get('/profile', [ProfileMahasiswaController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileMahasiswaController::class, 'update'])->name('profile.update');
});
