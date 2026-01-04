@extends('pusat.layouts.app')
@section('title', 'Verifikasi Draft SKPI - Pusat Bahasa')

@push('styles')
<style>
    /* ============ PREMIUM VERIFICATION INDEX STYLES ============ */
    .verif-container * {
        box-sizing: border-box;
    }
    
    .verif-container {
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
    }
    
    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
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
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .stat-card.total .stat-icon { background: #dbeafe; color: #1e40af; }
    .stat-card.pending .stat-icon { background: #fef3c7; color: #92400e; }
    .stat-card.approved .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.rejected .stat-icon { background: #fee2e2; color: #b91c1c; }
    
    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }
    
    /* Filter Section */
    .filter-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .filter-input {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        min-width: 200px;
    }
    
    .filter-input:focus {
        outline: none;
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }
    
    .filter-btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .filter-btn.primary {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
    }
    
    /* Table Card */
    .table-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .table-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .table-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .table-title i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .table-badge {
        padding: 8px 16px;
        background: #cffafe;
        color: #0e7490;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
    }
    
    /* Draft Table */
    .draft-table-wrapper {
        overflow-x: auto;
    }
    
    .draft-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }
    
    .draft-table th,
    .draft-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .draft-table th {
        background: #fafbfc;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .draft-table tbody tr {
        transition: background 0.2s;
    }
    
    .draft-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .draft-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Student Info */
    .student-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .student-avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
    }
    
    .student-details h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }
    
    .student-details span {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.di_pusat_bahasa { background: #cffafe; color: #0e7490; }
    
    /* Prodi Badge */
    .prodi-badge {
        padding: 6px 12px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Date */
    .date-info {
        font-size: 13px;
        color: #6b7280;
    }
    
    .date-info i {
        margin-right: 4px;
        color: #9ca3af;
    }
    
    /* Action Button */
    .btn-review {
        padding: 10px 18px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-review:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.35);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 56px;
        margin-bottom: 16px;
        opacity: 0.4;
        color: #d1d5db;
    }
    
    .empty-state h4 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }
    
    /* Pagination */
    .pagination-wrapper {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
        
        .filter-section {
            flex-direction: column;
        }
        
        .filter-input {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
@php
    $totalDrafts = $drafts->total();
    $pendingCount = $drafts->where('status', 'di_pusat_bahasa')->count();
    $approvedCount = $drafts->where('status', 'disetujui')->count();
@endphp

<div class="verif-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-language"></i>
                </div>
                <div>
                    <h1>Verifikasi Draft SKPI</h1>
                    <p>Review dan verifikasi draft SKPI yang masuk dari Prodi</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Stats Row --}}
    <div class="stats-row">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalDrafts }}</div>
                <div class="stat-label">Total Draft</div>
            </div>
        </div>
        
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="stat-value">{{ $pendingCount }}</div>
                <div class="stat-label">Menunggu Review</div>
            </div>
        </div>
        
        <div class="stat-card approved">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <div class="stat-value">{{ $approvedCount }}</div>
                <div class="stat-label">Disetujui</div>
            </div>
        </div>
        
        <div class="stat-card rejected">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalDrafts - $pendingCount - $approvedCount }}</div>
                <div class="stat-label">Ditolak/Revisi</div>
            </div>
        </div>
    </div>
    
    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-inbox"></i>
                Draft SKPI Masuk
            </div>
            <span class="table-badge">{{ $drafts->total() }} Draft</span>
        </div>
        
        @if($drafts->count())
            <div class="draft-table-wrapper">
                <table class="draft-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drafts as $i => $draft)
                            <tr>
                                <td>
                                    <span style="font-weight: 600; color: #6b7280;">{{ $i + 1 }}</span>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                                        </div>
                                        <div class="student-details">
                                            <h4>{{ $draft->mahasiswa->nama ?? '-' }}</h4>
                                            <span>{{ $draft->mahasiswa->nim ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="prodi-badge">
                                        {{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($draft->status) {
                                            'di_pusat_bahasa' => 'di_pusat_bahasa',
                                            'disetujui', 'approved' => 'approved',
                                            'ditolak', 'revisi' => 'rejected',
                                            default => 'pending'
                                        };
                                        $statusIcon = match($draft->status) {
                                            'di_pusat_bahasa' => 'fas fa-clock',
                                            'disetujui', 'approved' => 'fas fa-check-circle',
                                            'ditolak', 'revisi' => 'fas fa-times-circle',
                                            default => 'fas fa-hourglass-half'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="{{ $statusIcon }}"></i>
                                        {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <i class="fas fa-calendar"></i>
                                        {{ $draft->created_at ? $draft->created_at->format('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('pusat.verifikasi.show', $draft->id) }}" class="btn-review">
                                        <i class="fas fa-eye"></i> Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($drafts->hasPages())
                <div class="pagination-wrapper">
                    {{ $drafts->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Belum Ada Draft Masuk</h4>
                <p>Draft SKPI dari Prodi akan muncul di sini</p>
            </div>
        @endif
    </div>
</div>
@endsection
