@extends('admin.layouts.app')

@section('title', 'Manajemen Users')
@section('page_title', 'Manajemen Users')
@section('page_icon', 'users')

@section('content')

    <style>
        /* ========================================
           USER MANAGEMENT - TEMA HIJAU
           ======================================== */

        .header-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
            border-left: 4px solid #10b981;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title i {
            color: #10b981;
            font-size: 32px;
        }

        .header-subtitle {
            color: #64748b;
            font-size: 15px;
            font-weight: 500;
        }

        /* ========================================
           USER GRID
           ======================================== */

        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        /* ========================================
           USER CARD - HOVER HIJAU
           ======================================== */

        .user-card {
            background: white;
            border-radius: 16px;
            padding: 32px 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        /* Top Border Animation */
        .user-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #059669);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .user-card:hover::before {
            transform: scaleX(1);
        }

        /* Hover Effect - Hijau Muda */
        .user-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.2);
            border-color: #10b981;
            background: linear-gradient(135deg, #ffffff, #f0fdf4);
        }

        /* ========================================
           ICON
           ======================================== */

        .user-icon {
            font-size: 56px;
            color: #10b981;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .user-card:hover .user-icon {
            transform: scale(1.1) rotate(5deg);
            color: #059669;
        }

        /* ========================================
           CARD CONTENT
           ======================================== */

        .user-card-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
            transition: color 0.3s ease;
        }

        .user-card:hover .user-card-title {
            color: #10b981;
        }

        .user-card-desc {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
            min-height: 40px;
        }

        /* ========================================
           BUTTON
           ======================================== */

        .user-btn-link {
            display: inline-block;
            padding: 12px 28px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white !important;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .user-btn-link:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }

        /* ========================================
           COUNT BADGE
           ======================================== */

        .count-badge {
            display: inline-block;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 14px;
            border: 1px solid #10b981;
        }

        /* ========================================
           CARD VARIANTS (Optional)
           ======================================== */

        /* Mahasiswa - Hijau */
        .user-card.mahasiswa .user-icon {
            color: #10b981;
        }

        .user-card.mahasiswa:hover {
            background: linear-gradient(135deg, #ffffff, #f0fdf4);
        }

        /* Prodi - Biru */
        .user-card.prodi .user-icon {
            color: #3b82f6;
        }

        .user-card.prodi::before {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }

        .user-card.prodi:hover {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #ffffff, #eff6ff);
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.2);
        }

        .user-card.prodi:hover .user-card-title {
            color: #3b82f6;
        }

        .user-card.prodi .user-btn-link {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .user-card.prodi .user-btn-link:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
        }

        .user-card.prodi .count-badge {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border-color: #3b82f6;
        }

        /* Fakultas - Ungu */
        .user-card.fakultas .user-icon {
            color: #8b5cf6;
        }

        .user-card.fakultas::before {
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
        }

        .user-card.fakultas:hover {
            border-color: #8b5cf6;
            background: linear-gradient(135deg, #ffffff, #faf5ff);
            box-shadow: 0 12px 28px rgba(139, 92, 246, 0.2);
        }

        .user-card.fakultas:hover .user-card-title {
            color: #8b5cf6;
        }

        .user-card.fakultas .user-btn-link {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .user-card.fakultas .user-btn-link:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
        }

        .user-card.fakultas .count-badge {
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #6d28d9;
            border-color: #8b5cf6;
        }

        /* Pusat Bahasa - Orange */
        .user-card.bahasa .user-icon {
            color: #f59e0b;
        }

        .user-card.bahasa::before {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .user-card.bahasa:hover {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #ffffff, #fffbeb);
            box-shadow: 0 12px 28px rgba(245, 158, 11, 0.2);
        }

        .user-card.bahasa:hover .user-card-title {
            color: #f59e0b;
        }

        .user-card.bahasa .user-btn-link {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .user-card.bahasa .user-btn-link:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
        }

        .user-card.bahasa .count-badge {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border-color: #f59e0b;
        }

        /* ========================================
           RESPONSIVE
           ======================================== */

        @media (max-width: 768px) {
            .user-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .header-section {
                padding: 20px;
            }

            .header-title {
                font-size: 24px;
            }

            .user-card {
                padding: 24px 20px;
            }

            .user-icon {
                font-size: 48px;
            }

            .user-card-title {
                font-size: 20px;
            }
        }
    </style>

    <div class="header-section">
        <h2 class="header-title">
            <i class="fas fa-users-cog"></i>
            Manajemen Users
        </h2>
        <p class="header-subtitle">Kelola semua akun pengguna sistem SKPI berdasarkan kategori</p>
    </div>

    <div class="user-grid">

        {{-- Card Mahasiswa - Hijau --}}
        <div class="user-card mahasiswa" onclick="window.location.href='{{ route('admin.users.mahasiswa') }}'">
            <div class="user-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="user-card-title">Mahasiswa</div>
            <div class="user-card-desc">Kelola akun mahasiswa dan akses SKPI mereka</div>
            <a href="{{ route('admin.users.mahasiswa') }}" class="user-btn-link">
                <i class="fas fa-arrow-right"></i> Lihat Mahasiswa
            </a>
            @if (isset($mahasiswaCount))
                <div class="count-badge">{{ $mahasiswaCount }} User</div>
            @endif
        </div>

        {{-- Card Prodi - Biru --}}
        <div class="user-card prodi" onclick="window.location.href='{{ route('admin.users.prodi') }}'">
            <div class="user-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="user-card-title">Prodi</div>
            <div class="user-card-desc">Kelola akun operator program studi</div>
            <a href="{{ route('admin.users.prodi') }}" class="user-btn-link">
                <i class="fas fa-arrow-right"></i> Lihat Prodi
            </a>
            @if (isset($prodiCount))
                <div class="count-badge">{{ $prodiCount }} User</div>
            @endif
        </div>

        {{-- Card Fakultas - Ungu --}}
        <div class="user-card fakultas" onclick="window.location.href='{{ route('admin.users.fakultas') }}'">
            <div class="user-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="user-card-title">Fakultas</div>
            <div class="user-card-desc">Kelola akun operator fakultas</div>
            <a href="{{ route('admin.users.fakultas') }}" class="user-btn-link">
                <i class="fas fa-arrow-right"></i> Lihat Fakultas
            </a>
            @if (isset($fakultasCount))
                <div class="count-badge">{{ $fakultasCount }} User</div>
            @endif
        </div>

        {{-- Card Pusat Bahasa - Orange --}}
        <div class="user-card bahasa" onclick="window.location.href='{{ route('admin.users.pusat-bahasa') }}'">
            <div class="user-icon">
                <i class="fas fa-language"></i>
            </div>
            <div class="user-card-title">Pusat Bahasa</div>
            <div class="user-card-desc">Kelola akun operator pusat bahasa</div>
            <a href="{{ route('admin.users.pusat-bahasa') }}" class="user-btn-link">
                <i class="fas fa-arrow-right"></i> Lihat Pusat Bahasa
            </a>
            @if (isset($pusatBahasaCount))
                <div class="count-badge">{{ $pusatBahasaCount }} User</div>
            @endif
        </div>

    </div>

@endsection
