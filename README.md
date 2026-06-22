# SKPI Kampus - Multi-Level Approval System

<p align="center">
  <img src="public/images/logo_unida-removebg-preview.png" alt="SKPI UNIDA Logo" width="120">
</p>

<p align="center">
  <strong>Sistem Pengelolaan Surat Keterangan Pendamping Ijazah (SKPI) dengan Multi-Level Approval</strong>
</p>

<p align="center">
  <a href="#fitur-utama">Fitur</a> •
  <a href="#teknologi">Teknologi</a> •
  <a href="#instalasi">Instalasi</a> •
  <a href="#alur-kerja">Alur Kerja</a> •
  <a href="#struktur-proyek">Struktur</a>
</p>

---

## 📋 Tentang Aplikasi

**SKPI Kampus** adalah sistem informasi berbasis web untuk mengelola penerbitan **Surat Keterangan Pendamping Ijazah (SKPI)** atau **Diploma Supplement** sesuai standar Dikti. Aplikasi ini mengimplementasikan **multi-level approval workflow** yang melibatkan berbagai pemangku kepentingan di lingkungan perguruan tinggi.

### Apa itu SKPI?
SKPI adalah dokumen resmi yang berisi informasi tentang pencapaian akademik pemegang ijazah selama masa studi, termasuk:
- Capaian Pembelajaran Lulusan (CPL)
- Sertifikasi Kompetensi
- Prestasi Akademik & Non-Akademik
- Organisasi Kemahasiswaan
- Pengabdian Masyarakat
- Karya Ilmiah
- Penghargaan

---

## ✨ Fitur Utama

### 🎓 Multi-Role Access
| Role | Akses & Fungsi |
|------|----------------|
| **Mahasiswa** | Input data kegiatan, upload dokumen pendukung, lihat status verifikasi |
| **Prodi** | Verifikasi kegiatan mahasiswa, buat draft SKPI, kelola CPL |
| **Fakultas** | Review draft SKPI dari prodi, verifikasi lanjutan, arsip |
| **Pusat Bahasa** | Verifikasi ringkasan bilingual (ID/EN), terjemahan |
| **Admin** | Master data, laporan statistik, manajemen user, template SKPI |

### 📊 Workflow Management
- **Multi-Level Verification**: Prodi → Fakultas → Pusat Bahasa → Final
- **Approval Logging**: Riwayat lengkap setiap persetujuan/penolakan
- **Revision Request**: Permintaan revisi dengan catatan detail
- **Real-time Notifications**: Notifikasi status verifikasi

### 📄 Dokumen & Export
- **PDF Generation**: Generate SKPI dalam format PDF profesional
- **Excel Import/Export**: Import data mahasiswa dari PDDIKTI Excel
- **Bilingual Support**: SKPI dalam Bahasa Indonesia dan English
- **QR Code Integration**: Verifikasi keaslian dokumen

### 📈 Laporan & Statistik
- Dashboard analytics per role
- Laporan verifikasi per periode
- Export laporan PDF & Excel
- SLA Monitoring

---

## 🛠 Teknologi

| Layer | Teknologi |
|-------|-----------|
| **Framework** | Laravel 12 (PHP 8.4) |
| **Frontend** | Blade Templates, Bootstrap, Chart.js |
| **Database** | MySQL / SQLite |
| **PDF** | DomPDF (barryvdh/laravel-dompdf) |
| **Excel** | Maatwebsite/Laravel-Excel |
| **Authentication** | Laravel Guard (Multi-Auth) |
| **Queue** | Laravel Jobs |

---

## ⚙️ Instalasi

### Prerequisites
- PHP >= 8.4
- Composer
- Node.js & NPM
- MySQL / SQLite

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Gilbransyah12/skpi-kampus-approval-multiple-level.git
cd skpi-kampus-approval-multiple-level

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=skpi_unida
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Migrasi & Seeding
php artisan migrate
php artisan db:seed

# 6. Build assets
npm run dev

# 7. Jalankan server
php artisan serve
```

### Default Login Credentials

| Role | Email/Username | Password |
|------|----------------|----------|
| Admin | admin@skpi.com | password |
| Prodi | prodi@skpi.com | password |
| Fakultas | fakultas@skpi.com | password |
| Mahasiswa | (via email registration) | - |

---

## 🔄 Alur Kerja (Workflow)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                           ALUR PENERBITAN SKPI                               │
└─────────────────────────────────────────────────────────────────────────────┘

    ┌──────────────┐
    │  MAHASISWA   │
    │              │
    │ • Input Data │
    │ • Upload     │
    │   Dokumen    │
    │ • Submit     │
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐     ┌─────────────────┐
    │    PRODI     │     │   STATUS:       │
    │              │────▶│   - Pending     │
    │ • Verifikasi │     │   - Approved    │
    │ • Buat Draft │     │   - Rejected    │
    │ • Submit ke  │     │   - Revision    │
    │   Fakultas   │     └─────────────────┘
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐
    │  FAKULTAS    │
    │              │
    │ • Review     │
    │   Draft SKPI │
    │ • Approve/   │
    │   Reject     │
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐
    │PUSAT BAHASA  │
    │              │
    │ • Verifikasi │
    │   Terjemahan │
    │ • Ringkasan  │
    │   ID/EN      │
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐
    │    FINAL     │
    │              │
    │ • QR Code    │
    │ • PDF        │
    │ • Arsip      │
    └──────────────┘
```

### Jenis Achievement yang Diverifikasi

| Kategori | Deskripsi |
|----------|-----------|
| **Sertifikasi Kompetensi** | Sertifikat keahlian/kompetensi terakreditasi |
| **Prestasi** | Lomba, kompetisi, achievement akademik |
| **Organisasi** | Keanggotaan organisasi kemahasiswaan |
| **PKM** | Pengabdian kepada masyarakat |
| **Karya Ilmiah** | Jurnal, paper, publikasi ilmiah |
| **Penghargaan** | Award & recognition |

---

## 📁 Struktur Proyek

```
skpi_unida/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/              # Controller Admin
│   │       ├── Auth/               # Controller Autentikasi
│   │       ├── Fakultas/           # Controller Fakultas
│   │       ├── Mahasiswa/          # Controller Mahasiswa
│   │       ├── Prodi/              # Controller Prodi
│   │       └── PusatBahasa/        # Controller Pusat Bahasa
│   ├── Models/
│   │   ├── Mahasiswa.php           # Model Mahasiswa
│   │   ├── VerifikasiSkpi.php      # Model Verifikasi (Polymorphic)
│   │   ├── DraftSkpi.php           # Model Draft SKPI
│   │   ├── ApprovalLog.php         # Model Log Approval
│   │   ├── SertifikasiKompetensi.php
│   │   ├── Prestasi.php
│   │   ├── Organisasi.php
│   │   ├── PengabdianMasyarakat.php
│   │   ├── KaryaIlmiah.php
│   │   └── Penghargaan.php
│   ├── Imports/                    # Import Excel (PDDIKTI)
│   ├── Exports/                    # Export Excel/PDF
│   └── Observers/                  # Model Observers
│
├── database/
│   ├── migrations/                 # Migrasi Database
│   └── seeders/                    # Data Seeder
│
├── resources/
│   └── views/
│       ├── admin/                  # Views Admin
│       ├── fakultas/               # Views Fakultas
│       ├── mahasiswa/              # Views Mahasiswa
│       ├── prodi/                  # Views Prodi
│       ├── pusat/                  # Views Pusat Bahasa
│       ├── auth/                   # Views Login/Register
│       └── layouts/                # Layout Master
│
├── routes/
│   ├── web.php                     # Routes Utama
│   ├── admin.php                   # Routes Admin
│   ├── mahasiswa.php               # Routes Mahasiswa
│   ├── prodi.php                   # Routes Prodi
│   ├── fakultas.php                # Routes Fakultas
│   └── pusat.php                   # Routes Pusat Bahasa
│
└── public/
    └── images/                     # Assets Gambar
```

---

## 🔐 Sistem Autentikasi

Aplikasi menggunakan **Multi-Guard Authentication** Laravel:

| Guard | Model | Tabel |
|-------|-------|-------|
| `web` | User (Mahasiswa) | `users` |
| `admin` | AdminUser | `admin_users` |
| `prodi` | ProdiUser | `prodi_users` |
| `fakultas` | FakultasUser | `fakultas_users` |
| `pusat_bahasa` | PusatBahasaUser | `pusat_bahasa_users` |

---

## 📊 Database Schema (Key Tables)

```
┌─────────────────┐     ┌──────────────────┐     ┌─────────────────┐
│   mahasiswa     │────▶│  verifikasi_skpi │◀────│   draft_skpi    │
├─────────────────┤     ├──────────────────┤     ├─────────────────┤
│ id              │     │ id               │     │ id              │
│ nim             │     │ mahasiswa_id     │     │ mahasiswa_id    │
│ nama            │     │ verifiable_type  │     │ nomor_skpi      │
│ prodi_id        │     │ verifiable_id    │     │ status          │
│ email           │     │ level_verifikasi │     │ ringkasan_id    │
└─────────────────┘     │ status           │     │ ringkasan_en    │
                        └──────────────────┘     └─────────────────┘
                                 │
                                 │ Polymorphic Relations
                                 ▼
        ┌─────────────────────────────────────────────────────────┐
        │  sertifikasi_kompetensi | prestasi | organisasi | ...   │
        └─────────────────────────────────────────────────────────┘
```

---

## 🚀 Pengembangan

```bash
# Jalankan development server
php artisan serve

# Watch assets
npm run dev

# Run queue worker (untuk jobs)
php artisan queue:listen

# Run all together
composer dev
```

---

## 📝 License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👥 Kontributor

- **Developer:** Gilbransyah
- **Institution:** Universitas Iskandar Muda (UNIDA)

---

<p align="center">
  Made with ❤️ for Indonesian Higher Education
</p>
