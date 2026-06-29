@extends('pusat.layouts.app')
@section('title', 'Daftar Mahasiswa - Pusat Bahasa')

@push('styles')
<style>
    /* ============ MAHASISWA INDEX - PUSAT BAHASA - CYAN THEME ============ */
    .mhs-container * {
        box-sizing: border-box;
    }

    .mhs-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -60%;
        right: -15%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        position: relative;
        z-index: 1;
    }

    .page-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        backdrop-filter: blur(4px);
    }

    .header-title {
        font-size: 22px;
        font-weight: 800;
    }

    .header-subtitle {
        font-size: 14px;
        opacity: 0.9;
        margin-top: 2px;
    }

    /* Filter Section */
    .filter-section {
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .filter-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .filter-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: #1f2937;
        background: #f9fafb;
        transition: all 0.2s ease;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #0891b2;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.15);
        background: #fff;
    }

    .btn-filter {
        padding: 10px 20px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }

    .btn-reset {
        padding: 10px 20px;
        background: #f3f4f6;
        color: #6b7280;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-reset:hover {
        background: #e5e7eb;
        color: #374151;
    }

    /* Table Section */
    .table-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    }

    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .table-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-count {
        font-size: 12px;
        background: #0891b2;
        color: #fff;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .mhs-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .mhs-table thead th {
        padding: 14px 16px;
        text-align: left;
        font-weight: 700;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
        background: #f8fafc;
    }

    .mhs-table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #4b5563;
    }

    .mhs-table tbody tr {
        transition: background 0.2s;
    }

    .mhs-table tbody tr:hover {
        background: #f0fdfa;
    }

    .mhs-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.approved {
        background: #dcfce7;
        color: #15803d;
    }

    .status-badge.rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-badge.final {
        background: #dbeafe;
        color: #1d4ed8;
    }

    /* Mahasiswa Info */
    .mhs-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mhs-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0891b2, #22d3ee);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
    }

    .mhs-name {
        font-weight: 600;
        color: #1f2937;
    }

    .mhs-nim {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Action Button */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 14px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.15s, box-shadow 0.15s;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
        color: #fff;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 48px;
        color: #d1d5db;
        margin-bottom: 16px;
    }

    .empty-state h4 {
        font-size: 18px;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #9ca3af;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 16px 24px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination-wrapper .pagination li a,
    .pagination-wrapper .pagination li span {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-decoration: none;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .pagination-wrapper .pagination li.active span {
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        color: #fff;
        border-color: transparent;
    }

    .pagination-wrapper .pagination li a:hover {
        background: #f0fdfa;
        border-color: #0891b2;
        color: #0891b2;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
        }

        .filter-group {
            min-width: 100%;
        }

        .table-section {
            overflow-x: auto;
        }

        .mhs-table {
            min-width: 800px;
        }

        .page-header-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="mhs-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <div class="header-title">Daftar Mahasiswa</div>
                    <div class="header-subtitle">Mahasiswa yang SKPI-nya sudah masuk ke Pusat Bahasa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ url()->current() }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label>Cari NIM / Nama</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik NIM atau nama...">
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak / Revisi</option>
                    </select>
                </div>
                <div style="display:flex;gap:8px;align-items:flex-end;">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ url()->current() }}" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-section">
        <div class="table-header">
            <h3>
                <i class="fas fa-list"></i>
                Data Mahasiswa
            </h3>
            <span class="table-count">{{ $mahasiswaList->total() ?? 0 }} data</span>
        </div>

        <table class="mhs-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th>Status SKPI</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswaList ?? [] as $index => $mhs)
                    <tr>
                        <td>{{ ($mahasiswaList->currentPage() - 1) * $mahasiswaList->perPage() + $index + 1 }}</td>
                        <td>
                            <div class="mhs-info">
                                <div class="mhs-avatar">
                                    {{ strtoupper(substr($mhs->nama ?? 'M', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="mhs-name">{{ $mhs->nama ?? '-' }}</div>
                                    <div class="mhs-nim">{{ $mhs->nim ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $mhs->prodi->nama_prodi ?? '-' }}</td>
                        <td>{{ $mhs->prodi->fakultas->nama_fakultas ?? '-' }}</td>
                        <td>
                            @php
                                $latestVerif = $mhs->verifikasiSkpi->first();
                                $status = $latestVerif->status ?? 'pending';
                            @endphp
                            @if($status == 'approved')
                                <span class="status-badge approved">
                                    <i class="fas fa-check-circle"></i> Disetujui
                                </span>
                            @elseif($status == 'rejected')
                                <span class="status-badge rejected">
                                    <i class="fas fa-times-circle"></i> Ditolak
                                </span>
                            @elseif($status == 'final_issued')
                                <span class="status-badge final">
                                    <i class="fas fa-award"></i> Final
                                </span>
                            @else
                                <span class="status-badge pending">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td>{{ $latestVerif ? $latestVerif->created_at->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('pusat.verifikasi.show', $mhs->draftSkpi->id ?? '#') }}" class="btn-detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h4>Belum Ada Mahasiswa</h4>
                                <p>Data mahasiswa yang SKPI-nya masuk ke pusat bahasa akan ditampilkan di sini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(isset($mahasiswaList) && $mahasiswaList->hasPages())
            <div class="pagination-wrapper">
                {{ $mahasiswaList->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
