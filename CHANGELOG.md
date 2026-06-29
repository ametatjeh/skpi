# Changelog - Implementasi File Kosong SKPI

Pembaruan besar ini menyelesaikan implementasi untuk ~65 file kosong yang ditemukan sebelumnya pada portal sistem SKPI. 

## [Unreleased] - 2026-06-29

### Added & Implemented
- **Portal Fakultas (Fase 1)**:
  - Komponen dasar: Header, Footer, Notification Bell, dan Stats Card.
  - Halaman Verifikasi & Approval: Riwayat verifikasi, preview SKPI, tabel pending/approved/rejected draft SKPI.
  - Fitur Laporan: Laporan monitoring waktu, breakdown per program studi, skpi terbit, dan modal export.
  - Dashboard Monitoring: Overview SLA, analisis bottleneck, monitoring per prodi, timeline verifikasi.
  - Master Data & Profil: Pengelolaan profil operator, data fakultas, data prodi, list notifikasi.
  - Pejabat: Manajemen data dekan dan wakil dekan (CRUD).
  - Backend/Controllers: `MasterDataFakultasController`, `MonitoringController`, `PejabatController`, `DekanController`, `WakilDekanController`, dll.
  
- **Portal Mahasiswa (Fase 2)**:
  - Komponen: Footer mahasiswa.
  - Halaman Dokumen Pendukung: Upload dokumen pendukung beserta list dokumen yang diupload.
  - Profil: Form update profil mahasiswa.

- **Portal Pusat Bahasa & Prodi (Fase 3)**:
  - Pusat Bahasa: List mahasiswa dengan draft SKPI, tabel riwayat verifikasi.
  - Admin: Halaman khusus untuk preview draft SKPI.
  - Prodi: Partial views (recent activities, statistics) untuk dashboard prodi.
  - Middleware: Implementasi role-based middleware (`CheckFakultasRole`, `CheckPusatBahasaRole`) dan didaftarkan pada `Kernel.php`.
  - Service Layer: `VerifikasiService` dan `NotifikasiService` untuk logic prodi.
  - Model: Model alias `Dokumen` dan model kustom `NotifikasiFakultas`.
  
- **Assets & Placeholders**:
  - Global CSS, CSS reset, dan komponen cards.
  - Styling dashboard dan verifikasi fakultas (Purple Theme).
  - Main JS scripts untuk fungsionalitas auto-hide flash message, Chart.js helpers, approval toggle, dan search table.
  - CSS layout admin dan sertifikasi.

### Changed
- Penyesuaian `routes/fakultas.php`, `routes/pusat.php`, dan `Kernel.php` untuk mendukung integrasi kontrol otentikasi (Middleware).
- Integrasi logic dengan UI yang menggunakan perpaduan warna modern (Cyan theme, Purple theme, Green theme).

### Security
- Menambahkan pemeriksaan akses hak izin spesifik melalui custom auth guard middleware pada fitur yang dikembangkan.
