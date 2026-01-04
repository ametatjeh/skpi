@extends('admin.layouts.app')

@section('title', 'Draft SKPI')
@section('page_title', 'Draft SKPI')
@section('page_icon', 'file-alt')

@section('content')

    <style>
        /* ========================================
           DRAFT SKPI - TEMA HIJAU
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

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
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

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .search-input,
        .filter-select {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input {
            width: 280px;
        }

        .filter-select {
            width: 180px;
        }

        .search-input:focus,
        .filter-select:focus {
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

        .badge-draft {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
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

        /* ========== LOADING OVERLAY ========== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
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
            font-size: 18px;
            font-weight: 600;
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
            .content-wrapper {
                padding: 20px 15px;
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .action-group {
                flex-direction: column;
                width: 100%;
                gap: 12px;
            }
            
            .search-form {
                flex-direction: column !important;
                width: 100%;
                gap: 10px;
            }

            .search-input,
            .filter-select {
                width: 100% !important;
            }
            
            .btn, .btn-sm, .btn-info {
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
                <i class="fas fa-file-alt"></i> SKPI
            </span>
            <span class="separator">›</span>
            <span class="current">Draft SKPI</span>
        </div>

        {{-- HEADER --}}
        <div class="header-actions">
            <div class="page-header">
                <h2>
                    <i class="fas fa-file-alt"></i>
                    Draft SKPI
                </h2>
                <p>
                    Kelola draft SKPI mahasiswa yang belum final
                </p>
            </div>

            <div class="action-group">
                <form action="{{ route('admin.skpi.draft') }}" method="GET" class="search-form"
                    style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

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
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th style="width: 250px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($draftSkpiList as $i => $item)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>
                                    <strong style="color: #10b981;">{{ $item->nomor_skpi }}</strong>
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
                                <td>{{ $item->tahun_lulus ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 'draft')
                                        <span class="badge badge-draft">
                                            <i class="fas fa-edit"></i> Draft
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge badge-approved">
                                            <i class="fas fa-check"></i> Approved
                                        </span>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge badge-rejected">
                                            <i class="fas fa-times"></i> Rejected
                                        </span>
                                    @else
                                        <span class="badge badge-final">
                                            <i class="fas fa-lock"></i> Final
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 5px; justify-content: center; flex-wrap: wrap;">
                                        <a href="{{ route('admin.skpi.preview', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.skpi.download-pdf', $item->id) }}"
                                            class="btn btn-primary btn-sm btn-download-pdf" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>

                                        @if ($item->status == 'draft')
                                            <button onclick="openApproveModal({{ $item->id }})"
                                                class="btn btn-success btn-sm" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button onclick="openRejectModal({{ $item->id }})"
                                                class="btn btn-danger btn-sm" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif($item->status == 'approved')
                                            <button onclick="openFinalizeModal({{ $item->id }})"
                                                class="btn btn-warning btn-sm" title="Finalisasi">
                                                <i class="fas fa-lock"></i> Final
                                            </button>
                                        @endif

                                        @if ($item->status != 'final')
                                            <form action="{{ route('admin.skpi.destroy', $item->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Yakin hapus draft SKPI ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <i class="fas fa-file-alt"></i>
                                    <p>Tidak ada draft SKPI</p>
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

            @if ($draftSkpiList->count() > 0)
                <div
                    style="text-align: center; color: #64748b; font-size: 14px; font-weight: 600; padding: 15px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    Menampilkan: <strong>{{ $draftSkpiList->count() }}</strong> draft SKPI
                </div>
            @endif
        </div>

    </div>

    {{-- MODAL APPROVE --}}
    <div id="approveModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-check-circle" style="color: #10b981;"></i> Approve Draft SKPI</h3>
                <span class="close-modal" onclick="closeModal('approveModal')">&times;</span>
            </div>
            <form id="approveForm" method="POST">
                @csrf
                <p style="margin-bottom: 20px; color: #64748b;">
                    Yakin ingin approve draft SKPI ini? Draft yang sudah di-approve bisa dilanjutkan ke finalisasi.
                </p>
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    <i class="fas fa-check"></i> Approve Draft SKPI
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL REJECT --}}
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-times-circle" style="color: #ef4444;"></i> Reject Draft SKPI</h3>
                <span class="close-modal" onclick="closeModal('rejectModal')">&times;</span>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>Alasan Penolakan <span style="color: #ef4444;">*</span></label>
                    <textarea name="catatan" class="form-control" placeholder="Jelaskan alasan penolakan..." required></textarea>
                </div>
                <button type="submit" class="btn btn-danger" style="width: 100%;">
                    <i class="fas fa-times"></i> Reject Draft SKPI
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL FINALIZE --}}
    <div id="finalizeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-lock" style="color: #f59e0b;"></i> Finalisasi SKPI</h3>
                <span class="close-modal" onclick="closeModal('finalizeModal')">&times;</span>
            </div>
            <form id="finalizeForm" method="POST">
                @csrf
                <p style="margin-bottom: 20px; color: #64748b;">
                    <strong>Perhatian!</strong> SKPI yang sudah difinalisasi akan dikunci dan tidak bisa diubah lagi.
                    Pastikan semua data sudah benar.
                </p>
                <button type="submit" class="btn btn-warning" style="width: 100%;">
                    <i class="fas fa-lock"></i> Finalisasi SKPI
                </button>
            </form>
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
        function openApproveModal(id) {
            document.getElementById('approveForm').action = `/admin/skpi/approve/${id}`;
            document.getElementById('approveModal').classList.add('active');
        }

        function openRejectModal(id) {
            document.getElementById('rejectForm').action = `/admin/skpi/reject/${id}`;
            document.getElementById('rejectModal').classList.add('active');
        }

        function openFinalizeModal(id) {
            document.getElementById('finalizeForm').action = `/admin/skpi/finalize/${id}`;
            document.getElementById('finalizeModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Loading for PDF Download
        document.querySelectorAll('.btn-download-pdf').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                document.getElementById('loadingOverlay').classList.add('active');
                
                // Hide loading after 5 seconds (PDF should be downloading by then)
                setTimeout(function() {
                    document.getElementById('loadingOverlay').classList.remove('active');
                }, 5000);
            });
        });
    </script>

@endsection
