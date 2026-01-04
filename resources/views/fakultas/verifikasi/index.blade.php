@extends('fakultas.layouts.app')
@section('title', 'Verifikasi Draft SKPI Fakultas')
@section('page_title', 'Verifikasi Draft SKPI')
@section('page_icon', 'tasks')

@push('styles')
<style>
    /* ============ VERIFIKASI PAGE - PURPLE THEME ============ */
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(124, 58, 237, 0.25);
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
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
    
    .page-header h1 {
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 13px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Stats Mini */
    .stats-mini {
        display: flex;
        gap: 12px;
    }
    
    .stat-mini-item {
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 20px;
        border-radius: 12px;
        text-align: center;
        backdrop-filter: blur(4px);
    }
    
    .stat-mini-value {
        font-size: 24px;
        font-weight: 800;
    }
    
    .stat-mini-label {
        font-size: 11px;
        opacity: 0.9;
        text-transform: uppercase;
    }
    
    /* Card */
    .card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .card-header-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .card-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    /* Filter Form */
    .filter-form {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .filter-form label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
    }
    
    .filter-form select,
    .filter-form input {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #fff;
        font-size: 13px;
        transition: all 0.2s;
    }
    
    .filter-form select:focus,
    .filter-form input:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
    
    .filter-form input {
        min-width: 180px;
    }
    
    /* Table Wrapper */
    .table-wrapper {
        width: 100%;
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar {
        height: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-track {
        background: #e5e7eb;
        border-radius: 10px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        border-radius: 10px;
    }
    
    /* Table */
    .modern-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }
    
    .modern-table thead th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .modern-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
    }
    
    .modern-table tbody tr:hover {
        background: #faf5ff;
    }
    
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Student Info */
    .student-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .student-name {
        font-weight: 600;
        color: #111827;
    }
    
    .student-nim {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.revisi { background: #fee2e2; color: #dc2626; }
    .status-badge.process { background: #f3e8ff; color: #7c3aed; }
    
    /* Action Button */
    .btn-action {
        padding: 8px 16px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }
    
    .btn-action.secondary {
        background: #f1f5f9;
        color: #374151;
    }
    
    .btn-action.secondary:hover {
        background: #e5e7eb;
        box-shadow: none;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 56px;
        opacity: 0.4;
        margin-bottom: 16px;
        color: #a78bfa;
    }
    
    .empty-state h4 {
        font-size: 18px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 0 8px 0;
    }
    
    .empty-state p {
        font-size: 14px;
        margin: 0;
    }
    
    /* Card Footer */
    .card-footer {
        padding: 16px 24px;
        border-top: 1px solid #f1f5f9;
        background: #f8fafc;
    }
    
    /* Pagination */
    .pagination {
        display: flex;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .pagination li a,
    .pagination li span {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        text-decoration: none;
        color: #374151;
        background: #fff;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    
    .pagination li.active span {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border-color: transparent;
    }
    
    .pagination li a:hover {
        background: #f3e8ff;
        border-color: #7c3aed;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-mini {
            width: 100%;
        }
        
        .stat-mini-item {
            flex: 1;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .filter-form {
            width: 100%;
        }
        
        .filter-form input {
            flex: 1;
            min-width: unset;
        }
    }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div>
                    <h1>Verifikasi Draft SKPI</h1>
                    <p>Review dan verifikasi pengajuan SKPI dari Program Studi</p>
                </div>
            </div>
            <div class="stats-mini">
                <div class="stat-mini-item">
                    <div class="stat-mini-value">{{ $drafts->where('status', 'valid_fakultas')->count() }}</div>
                    <div class="stat-mini-label">Pending</div>
                </div>
                <div class="stat-mini-item">
                    <div class="stat-mini-value">{{ $drafts->total() }}</div>
                    <div class="stat-mini-label">Total</div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Main Card --}}
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <i class="fas fa-list"></i>
                </div>
                <h3>Daftar Draft SKPI</h3>
            </div>
            <form method="GET" class="filter-form">
                <label>Status:</label>
                <select name="status" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="valid_fakultas" {{ request('status') == 'valid_fakultas' ? 'selected' : '' }}>Pending</option>
                    <option value="approved_fakultas" {{ request('status') == 'approved_fakultas' ? 'selected' : '' }}>Disetujui</option>
                    <option value="revisi_prodi" {{ request('status') == 'revisi_prodi' ? 'selected' : '' }}>Perlu Revisi</option>
                </select>
                <input name="q" placeholder="🔍 Cari NIM atau Nama..." value="{{ request('q') }}">
            </form>
        </div>
        
        <div class="table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Prodi</th>
                        <th>No SKPI</th>
                        <th>Status</th>
                        <th>Tgl Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drafts as $index => $draft)
                        <tr>
                            <td>{{ $drafts->firstItem() + $index }}</td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="student-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                                        <div class="student-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td><strong>{{ $draft->nomor_skpi ?? '-' }}</strong></td>
                            <td>
                                @if ($draft->status === 'valid_fakultas')
                                    <span class="status-badge pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @elseif ($draft->status === 'approved_fakultas' || $draft->status === 'final_issued')
                                    <span class="status-badge approved">
                                        <i class="fas fa-check-circle"></i> Disetujui
                                    </span>
                                @elseif ($draft->status === 'revisi_prodi')
                                    <span class="status-badge revisi">
                                        <i class="fas fa-undo"></i> Revisi
                                    </span>
                                @else
                                    <span class="status-badge process">
                                        <i class="fas fa-spinner"></i> {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $draft->created_at ? $draft->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('fakultas.approval.show', $draft->id) }}" class="btn-action">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>Belum Ada Draft SKPI</h4>
                                    <p>Draft SKPI dari Program Studi akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($drafts->hasPages())
        <div class="card-footer">
            {{ $drafts->withQueryString()->links() }}
        </div>
        @endif
    </div>
@endsection
