@extends('admin.layouts.app')

@section('title', 'Menunggu Verifikasi Fakultas')
@section('page_title', 'Verifikasi Fakultas')
@section('page_icon', 'university')

@section('content')

    <style>
        /* ========================================
           VERIFIKASI FAKULTAS - TEMA HIJAU
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

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
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

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 20px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-tab:hover {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }

        .filter-tab.active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border-color: #10b981;
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            max-width: 100%; /* Ensure it doesn't push parent width */
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

        .badge-prestasi {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-sertifikasi {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-organisasi {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-pkm {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
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

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .close-modal {
            cursor: pointer;
            font-size: 24px;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .close-modal:hover {
            color: #475569;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        @media (max-width: 768px) {
            /* Add box-sizing to prevent padding from increasing width */
            * {
                box-sizing: border-box;
            }

            .content-wrapper {
                padding: 15px; /* Reduce padding for mobile */
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }

            /* Force search form to stack */
            .header-actions form {
                flex-direction: column !important;
                width: 100%;
            }

            .search-input {
                width: 100% !important;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            /* Force filter tabs to stack */
            .filter-tabs {
                flex-direction: column;
                gap: 10px;
            }

            .filter-tab {
                width: 100%;
                justify-content: center;
                text-align: center;
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
    </style>

    <div class="content-wrapper">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p style="margin: 0;">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="separator">›</span>
            <span>
                <i class="fas fa-check-circle"></i> Verifikasi
            </span>
            <span class="separator">›</span>
            <span class="current">Menunggu Fakultas</span>
        </div>

        {{-- HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-university"></i>
                    Menunggu Verifikasi Fakultas
                </h2>
                <p>
                    Daftar kegiatan yang sudah diverifikasi Prodi dan menunggu verifikasi Fakultas
                </p>
            </div>

            <div class="action-group">
                <form action="{{ route('admin.verifikasi.fakultas') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama atau NIM mahasiswa..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- FILTER TABS --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.verifikasi.fakultas') }}"
                class="filter-tab {{ !request('kategori') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.verifikasi.fakultas', ['kategori' => 'Prestasi']) }}"
                class="filter-tab {{ request('kategori') == 'Prestasi' ? 'active' : '' }}">
                <i class="fas fa-trophy"></i> Prestasi
            </a>
            <a href="{{ route('admin.verifikasi.fakultas', ['kategori' => 'SertifikasiKompetensi']) }}"
                class="filter-tab {{ request('kategori') == 'SertifikasiKompetensi' ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Sertifikasi
            </a>
            <a href="{{ route('admin.verifikasi.fakultas', ['kategori' => 'Organisasi']) }}"
                class="filter-tab {{ request('kategori') == 'Organisasi' ? 'active' : '' }}">
                <i class="fas fa-users"></i> Organisasi
            </a>
            <a href="{{ route('admin.verifikasi.fakultas', ['kategori' => 'PengabdianMasyarakat']) }}"
                class="filter-tab {{ request('kategori') == 'PengabdianMasyarakat' ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i> PKM
            </a>
        </div>

        {{-- TABLE --}}
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Kategori</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Judul Kegiatan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th style="width: 200px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($verifikasiList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    @php
                                        $kategori = class_basename($item->verifiable_type);
                                    @endphp
                                    @if ($kategori == 'Prestasi')
                                        <span class="badge badge-prestasi">
                                            <i class="fas fa-trophy"></i> Prestasi
                                        </span>
                                    @elseif($kategori == 'SertifikasiKompetensi')
                                        <span class="badge badge-sertifikasi">
                                            <i class="fas fa-certificate"></i> Sertifikasi
                                        </span>
                                    @elseif($kategori == 'Organisasi')
                                        <span class="badge badge-organisasi">
                                            <i class="fas fa-users"></i> Organisasi
                                        </span>
                                    @else
                                        <span class="badge badge-pkm">
                                            <i class="fas fa-lightbulb"></i> PKM
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $item->mahasiswa->nim ?? '-' }}
                                    </span>
                                </td>
                                <td><strong>{{ $item->mahasiswa->nama ?? '-' }}</strong></td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->verifiable)
                                        @if ($kategori == 'Prestasi')
                                            {{ $item->verifiable->judul_prestasi ?? '-' }}
                                        @elseif($kategori == 'SertifikasiKompetensi')
                                            {{ $item->verifiable->nama_sertifikasi ?? '-' }}
                                        @elseif($kategori == 'Organisasi')
                                            {{ $item->verifiable->nama_organisasi ?? '-' }}
                                        @elseif($kategori == 'PengabdianMasyarakat')
                                            {{ $item->verifiable->judul_pkm ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    @else
                                        <span style="color: #ef4444;">Data dihapus</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d M Y, H:i') : '-' }}
                                </td>
                                <td>
                                    <span class="badge badge-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center; flex-wrap: wrap;">
                                        <button onclick="openApproveModal({{ $item->id }})"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button onclick="openRejectModal({{ $item->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        <button onclick="openRevisionModal({{ $item->id }})"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Revisi
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Tidak ada data yang menunggu verifikasi</p>
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

            @if ($verifikasiList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $verifikasiList->count() }}</strong> data menunggu verifikasi
                </div>
            @endif
        </div>

    </div>

    {{-- MODALS (Same as Prodi) --}}
    <div id="approveModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-check-circle" style="color: #10b981;"></i> Approve Verifikasi</h3>
                <span class="close-modal" onclick="closeModal('approveModal')">&times;</span>
            </div>
            <form id="approveForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Catatan (Opsional)</label>
                    <textarea name="catatan" class="form-control" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    <i class="fas fa-check"></i> Approve & Teruskan ke Dekan
                </button>
            </form>
        </div>
    </div>

    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-times-circle" style="color: #ef4444;"></i> Reject Verifikasi</h3>
                <span class="close-modal" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Alasan Penolakan <span style="color: #ef4444;">*</span></label>
                    <textarea name="catatan" class="form-control" placeholder="Jelaskan alasan penolakan..." required></textarea>
                </div>
                <button type="submit" class="btn btn-danger" style="width: 100%;">
                    <i class="fas fa-times"></i> Reject Verifikasi
                </button>
            </form>
        </div>
    </div>

    <div id="revisionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit" style="color: #f59e0b;"></i> Minta Revisi</h3>
                <span class="close-modal" onclick="closeModal('revisionModal')">&times;</span>
            </div>
            <form id="revisionForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Catatan Revisi <span style="color: #ef4444;">*</span></label>
                    <textarea name="catatan" class="form-control" placeholder="Jelaskan apa yang perlu direvisi..." required></textarea>
                </div>
                <button type="submit" class="btn btn-warning" style="width: 100%;">
                    <i class="fas fa-edit"></i> Kirim Permintaan Revisi
                </button>
            </form>
        </div>
    </div>

    <script>
        function openApproveModal(id) {
            document.getElementById('approveForm').action = `/admin/verifikasi/approve/${id}`;
            document.getElementById('approveModal').classList.add('active');
        }

        function openRejectModal(id) {
            document.getElementById('rejectForm').action = `/admin/verifikasi/reject/${id}`;
            document.getElementById('rejectModal').classList.add('active');
        }

        function openRevisionModal(id) {
            document.getElementById('revisionForm').action = `/admin/verifikasi/revision/${id}`;
            document.getElementById('revisionModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>

@endsection
