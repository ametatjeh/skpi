<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Import semua Models
use App\Models\SertifikasiKompetensi;
use App\Models\Prestasi;
use App\Models\Organisasi;
use App\Models\PengabdianMasyarakat;
use App\Models\KaryaIlmiah;
use App\Models\Penghargaan;
use App\Models\VerifikasiSkpi;

// Import semua Observers
use App\Observers\SertifikasiObserver;
use App\Observers\PrestasiObserver;
use App\Observers\OrganisasiObserver;
use App\Observers\PengabdianMasyarakatObserver;
use App\Observers\KaryaIlmiahObserver;
use App\Observers\PenghargaanObserver;
use App\Observers\VerifikasiSkpiObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Achievement Observers (untuk auto-create verifikasi)
        SertifikasiKompetensi::observe(SertifikasiObserver::class);
        Prestasi::observe(PrestasiObserver::class);
        Organisasi::observe(OrganisasiObserver::class);
        PengabdianMasyarakat::observe(PengabdianMasyarakatObserver::class);
        KaryaIlmiah::observe(KaryaIlmiahObserver::class);
        Penghargaan::observe(PenghargaanObserver::class);

        // Register Verifikasi Observer (untuk 4-level approval workflow) ⭐ MOST IMPORTANT!
        VerifikasiSkpi::observe(VerifikasiSkpiObserver::class);
    }
}
