@extends('admin.layouts.app')

@section('title', 'SKPI Final')
@section('page_title', 'SKPI Final')
@section('page_icon', 'file-pdf')

@section('content')

    <style>
        /* ========================================
                       SKPI FINAL - TEMA HIJAU
                       ======================================== */

        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .breadcrumb-nav a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .breadcrumb-nav a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .breadcrumb-nav .separator {
            color: #cbd5e1;
        }

        .breadcrumb-nav .current {
            color: #1e293b;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: #10b981;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
        }

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .search-input {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            width: 280px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-wrapper {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .table-wrapper::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background: linear-gradient(135deg, #10b981, #059669);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            white-space: nowrap;
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #d1fae5;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-final {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .stats-card {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .stats-card h3 {
            font-size: 32px;
            margin: 0;
            font-weight: 700;
        }

        .stats-card p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 20px 15px;
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 11px;
            }
        }

        /* ========== LOADING OVERLAY ========== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            backdrop-filter: blur(8px);
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-box {
            text-align: center;
            color: #fff;
        }

        .loading-spinner {
            width: 80px;
            height: 80px;
            border: 6px solid rgba(255, 255, 255, 0.2);
            border-top: 6px solid #10b981;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 25px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            animation: pulse-text 1.5s ease-in-out infinite;
        }

        .loading-subtext {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        @keyframes pulse-text {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
    </style>

    <div class="content-wrapper">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span>
                <i class="fas fa-file-alt"></i> SKPI
            </span>
            <span class="separator">›</span>
            <span class="current">SKPI Final</span>
        </div>

        {{-- STATS CARD --}}
        <div class="stats-card">
            <h3>{{ $finalSkpiList->count() }}</h3>
            <p><i class="fas fa-file-pdf"></i> Total SKPI Final yang sudah diterbitkan</p>
        </div>

        {{-- HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-file-pdf"></i>
                    SKPI Final
                </h2>
                <p>
                    SKPI yang sudah final dan siap dicetak
                </p>
            </div>

            <div class="action-group">
                <form action="{{ route('admin.skpi.final') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" class="search-input"
                        placeholder="Cari NIM, nama, atau nomor SKPI..." value="{{ request('search') }}">

                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nomor SKPI</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Tahun Lulus</th>
                            <th>Tanggal Finalisasi</th>
                            <th style="width: 150px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($finalSkpiList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    <strong style="color: #10b981;">{{ $item->nomor_skpi }}</strong>
                                    <br>
                                    <span class="badge badge-final">
                                        <i class="fas fa-lock"></i> Final
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $item->mahasiswa->nim ?? '-' }}
                                    </span>
                                </td>
                                <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $item->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->mahasiswa && $item->mahasiswa->tanggal_lulus)
                                        {{ $item->mahasiswa->tanggal_lulus->format('Y') }}
                                    @elseif($item->tahun_lulus)
                                        {{ $item->tahun_lulus }}
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>

                                <td>{{ $item->updated_at ? $item->updated_at->format('d M Y, H:i') : '-' }}</td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center; flex-wrap: wrap;">
                                        <a href="{{ route('admin.skpi.preview', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.skpi.download-pdf', $item->id) }}"
                                            class="btn btn-primary btn-sm btn-download-pdf" title="Download PDF">
                                            <i class="fas fa-download"></i> PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <i class="fas fa-file-pdf"></i>
                                    <p>Tidak ada SKPI final</p>
                                    @if (request('search'))
                                        <p style="font-size: 12px; margin-top: 5px;">
                                            Tidak ditemukan hasil untuk "{{ request('search') }}"
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($finalSkpiList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $finalSkpiList->count() }}</strong> SKPI final
                </div>
            @endif
        </div>

    </div>

    {{-- LOADING OVERLAY --}}
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-box">
            <div class="loading-spinner"></div>
            <div class="loading-text">Menyiapkan Dokumen PDF...</div>
            <div class="loading-subtext">Mohon tunggu sebentar</div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-download-pdf').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                document.getElementById('loadingOverlay').classList.add('active');
                
                // Hide loading after 5 seconds
                setTimeout(function() {
                    document.getElementById('loadingOverlay').classList.remove('active');
                }, 5000);
            });
        });
    </script>

@endsection
