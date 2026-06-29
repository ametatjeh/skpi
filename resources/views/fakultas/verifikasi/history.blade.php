@extends('fakultas.layouts.app')
@section('title', 'Riwayat Verifikasi')

@push('styles')
<style>
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
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .page-header h1 { font-size: 24px; font-weight: 800; margin: 0 0 6px 0; position: relative; z-index: 1; }
    .page-header p { font-size: 14px; opacity: 0.9; margin: 0; position: relative; z-index: 1; }

    .filter-bar {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        align-items: center;
    }
    .filter-bar select, .filter-bar input {
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        background: #fff;
        transition: border-color 0.2s;
    }
    .filter-bar select:focus, .filter-bar input:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }
    .btn-filter {
        padding: 10px 20px;
        background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }

    .history-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    .history-card .card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    .history-card .card-header-icon {
        width: 40px; height: 40px;
        background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        color: #fff; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
    }
    .history-card .card-header h3 { font-size: 16px; font-weight: 700; color: #111827; margin: 0; }

    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table thead th {
        padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700;
        color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;
        background: #f8fafc; border-bottom: 1px solid #e5e7eb;
    }
    .modern-table tbody td {
        padding: 14px 20px; border-bottom: 1px solid #f1f5f9;
        font-size: 14px; color: #374151;
    }
    .modern-table tbody tr:hover { background: #faf5ff; }

    .status-badge {
        padding: 5px 12px; border-radius: 20px; font-size: 11px;
        font-weight: 700; display: inline-flex; align-items: center; gap: 4px;
    }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #dc2626; }
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.revision { background: #f3e8ff; color: #7c3aed; }

    .empty-state {
        text-align: center; padding: 48px 20px; color: #9ca3af;
    }
    .empty-state i { font-size: 48px; opacity: 0.4; margin-bottom: 12px; color: #a78bfa; }
    .empty-state h4 { font-size: 16px; font-weight: 600; color: #6b7280; margin: 0 0 6px 0; }

    .pagination-wrapper { padding: 16px 24px; display: flex; justify-content: center; }

    @media (max-width: 768px) {
        .filter-bar { flex-direction: column; }
        .modern-table { min-width: 600px; }
    }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-history" style="margin-right:10px"></i> Riwayat Verifikasi</h1>
        <p>Lihat seluruh riwayat proses verifikasi SKPI di fakultas Anda</p>
    </div>

    <form method="GET" class="filter-bar">
        <select name="status">
            <option value="">Semua Status</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="revision_required" {{ request('status') == 'revision_required' ? 'selected' : '' }}>Revisi</option>
        </select>
        <input type="date" name="dari" value="{{ request('dari') }}" placeholder="Dari tanggal">
        <input type="date" name="sampai" value="{{ request('sampai') }}" placeholder="Sampai tanggal">
        <button type="submit" class="btn-filter">
            <i class="fas fa-search"></i> Filter
        </button>
    </form>

    <div class="history-card">
        <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-clipboard-list"></i></div>
            <h3>Log Verifikasi</h3>
        </div>
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Verifikator</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs ?? [] as $log)
                        <tr>
                            <td>{{ $log->created_at ? $log->created_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <strong>{{ $log->draftSkpi->mahasiswa->nama ?? '-' }}</strong><br>
                                <small style="color:#6b7280">{{ $log->draftSkpi->mahasiswa->nim ?? '-' }}</small>
                            </td>
                            <td>{{ $log->kategori ?? class_basename($log->verifiable_type ?? '-') }}</td>
                            <td>
                                @php $st = $log->action ?? $log->status ?? 'pending'; @endphp
                                <span class="status-badge {{ $st }}">
                                    <i class="fas {{ $st == 'approved' ? 'fa-check-circle' : ($st == 'rejected' ? 'fa-times-circle' : 'fa-clock') }}"></i>
                                    {{ ucfirst(str_replace('_', ' ', $st)) }}
                                </span>
                            </td>
                            <td>{{ $log->performed_by_name ?? $log->verifikator_role ?? '-' }}</td>
                            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                {{ $log->catatan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>Belum Ada Riwayat</h4>
                                    <p>Riwayat verifikasi akan muncul setelah ada proses verifikasi</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($logs ?? collect(), 'links'))
            <div class="pagination-wrapper">
                {{ $logs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
