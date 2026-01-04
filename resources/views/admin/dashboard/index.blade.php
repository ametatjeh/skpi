@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <style>
        /* ========================================
                   DASHBOARD - TEMA HIJAU MODERN
                   ======================================== */

        .dashboard-container {
            padding: 30px;
            background: #f8fafc;
            min-height: calc(100vh - 60px);
        }

        /* ========================================
                   PAGE TITLE
                   ======================================== */

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title h2 i {
            color: #10b981;
            font-size: 30px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* ========================================
                   SECTION HEADER
                   ======================================== */

        .section-header {
            margin: 35px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .section-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header h3 i {
            color: #10b981;
        }

        /* ========================================
                   GRID LAYOUT
                   ======================================== */

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        /* ========================================
                   CARD - CLICKABLE & GRADIENT HIJAU
                   ======================================== */

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #10b981, #059669);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .card .label {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card .label i {
            color: #10b981;
            font-size: 16px;
        }

        .card .value {
            margin-top: 12px;
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ✅ HOVER EFFECT - CARD CLICKABLE */
        .card:hover::after {
            content: '\f35d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            bottom: 15px;
            right: 15px;
            font-size: 20px;
            color: #10b981;
            opacity: 0.3;
        }

        /* ========================================
                   CARD VARIANTS - STATUS SKPI
                   ======================================== */

        .card.card-draft::before {
            background: linear-gradient(180deg, #3b82f6, #2563eb);
        }

        .card.card-draft:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
        }

        .card.card-draft .value {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card.card-draft .label i {
            color: #3b82f6;
        }

        .card.card-draft:hover::after {
            color: #3b82f6;
        }

        .card.card-approved::before {
            background: linear-gradient(180deg, #10b981, #059669);
        }

        .card.card-rejected::before {
            background: linear-gradient(180deg, #ef4444, #dc2626);
        }

        .card.card-rejected:hover {
            border-color: #ef4444;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
        }

        .card.card-rejected .value {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card.card-rejected .label i {
            color: #ef4444;
        }

        .card.card-rejected:hover::after {
            color: #ef4444;
        }

        .card.card-final::before {
            background: linear-gradient(180deg, #8b5cf6, #7c3aed);
        }

        .card.card-final:hover {
            border-color: #8b5cf6;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.2);
        }

        .card.card-final .value {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card.card-final .label i {
            color: #8b5cf6;
        }

        .card.card-final:hover::after {
            color: #8b5cf6;
        }

        /* ========================================
                   TABLE BOX
                   ======================================== */

        .table-box {
            margin-top: 30px;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .table-box h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-box h3 i {
            color: #10b981;
        }

        /* ========================================
                   TABLE
                   ======================================== */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        table th {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 14px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table th:first-child {
            border-top-left-radius: 8px;
        }

        table th:last-child {
            border-top-right-radius: 8px;
        }

        table td {
            padding: 12px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            font-size: 14px;
        }

        table tbody tr {
            transition: background 0.2s ease;
        }

        table tbody tr:hover {
            background: #d1fae5;
        }

        /* ========================================
                   BADGES
                   ======================================== */

        .prodi-tag {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 40px 15px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        /* ========================================
                   RESPONSIVE
                   ======================================== */

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 20px 15px;
            }

            .page-title h2 {
                font-size: 24px;
            }

            .grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .card {
                padding: 16px;
            }

            .card .value {
                font-size: 28px;
            }

            .table-box {
                padding: 18px;
                overflow-x: auto;
            }

            table {
                font-size: 13px;
            }

            table th,
            table td {
                padding: 10px 8px;
            }
        }
    </style>

    <div class="dashboard-container">

        <!-- ========================================
                     PAGE TITLE
                     ======================================== -->
        <div class="page-title">
            <h2>
                <i class="fas fa-chart-line"></i>
                Dashboard Admin
            </h2>
            <p class="page-subtitle">Selamat datang, {{ auth('admin')->user()->name ?? 'Admin' }}! Berikut ringkasan sistem
                SKPI.</p>
        </div>

        <!-- ========================================
                     STATISTIK UTAMA - CLICKABLE CARDS
                     ======================================== -->
        <div class="section-header">
            <h3>
                <i class="fas fa-chart-bar"></i>
                Statistik Utama
            </h3>
        </div>

        <div class="grid">
            {{-- ✅ CARD CLICKABLE: Total Pengguna --}}
            <a href="{{ route('admin.users.index') }}" class="card">
                <div class="label">
                    <i class="fas fa-users"></i>
                    Total Pengguna
                </div>
                <div class="value">{{ $totalUser }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: Total Mahasiswa --}}
            <a href="{{ route('admin.total-mahasiswa.index') }}" class="card">
                <div class="label">
                    <i class="fas fa-user-graduate"></i>
                    Total Mahasiswa
                </div>
                <div class="value">{{ $totalMahasiswa }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: Total Prodi --}}
            <a href="{{ route('admin.total-prodi.index') }}" class="card">
                <div class="label">
                    <i class="fas fa-layer-group"></i>
                    Total Prodi
                </div>
                <div class="value">{{ $totalProdi }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: Total Fakultas --}}
            <a href="{{ route('admin.total-fakultas.index') }}" class="card">
                <div class="label">
                    <i class="fas fa-building"></i>
                    Total Fakultas
                </div>
                <div class="value">{{ $totalFakultas }}</div>
            </a>
        </div>

        <!-- ========================================
                     STATUS SKPI - CLICKABLE CARDS
                     ======================================== -->
        <div class="section-header">
            <h3>
                <i class="fas fa-file-alt"></i>
                Status SKPI
            </h3>
        </div>

        <div class="grid">
            {{-- ✅ CARD CLICKABLE: SKPI Draft --}}
            <a href="{{ route('admin.skpi.draft') }}" class="card card-draft">
                <div class="label">
                    <i class="fas fa-file-edit"></i>
                    SKPI Draft
                </div>
                <div class="value">{{ $totalSkpiDraft }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: SKPI Disetujui --}}
            <a href="{{ route('admin.verifikasi.semua') }}" class="card card-approved">
                <div class="label">
                    <i class="fas fa-check-circle"></i>
                    SKPI Disetujui
                </div>
                <div class="value">{{ $totalSkpiDisetujui }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: SKPI Ditolak --}}
            <a href="{{ route('admin.verifikasi.semua') }}" class="card card-rejected">
                <div class="label">
                    <i class="fas fa-times-circle"></i>
                    SKPI Ditolak
                </div>
                <div class="value">{{ $totalSkpiDitolak }}</div>
            </a>

            {{-- ✅ CARD CLICKABLE: SKPI Final --}}
            <a href="{{ route('admin.skpi.final') }}" class="card card-final">
                <div class="label">
                    <i class="fas fa-file-pdf"></i>
                    SKPI Final
                </div>
                <div class="value">{{ $totalSkpiFinal }}</div>
            </a>
        </div>

        <!-- ========================================
                     TABEL SKPI FINAL
                     ======================================== -->
        <div class="table-box">
            <h3>
                <i class="fas fa-history"></i>
                5 SKPI Final Terbaru
            </h3>

            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th style="width: 150px;">Tanggal Final</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSkpiFinal as $i => $skpi)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><strong>{{ $skpi->mahasiswa->nama ?? '-' }}</strong></td>
                            <td>
                                <span class="prodi-tag">
                                    {{ $skpi->mahasiswa->prodi->nama_prodi ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $skpi->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data SKPI final.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
