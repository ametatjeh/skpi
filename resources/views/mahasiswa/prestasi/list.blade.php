@extends('mahasiswa.layouts.app')

@section('title', 'Daftar Prestasi')
@section('page_title', 'Prestasi')
@section('page_icon', 'trophy')

@section('content')
<style>
    /* ============ ACHIEVEMENT LIST PREMIUM SKY BLUE ============ */
    .achievement-container * {
        box-sizing: border-box;
    }

    .achievement-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Page Header */
    .achievement-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        position: relative;
        overflow: hidden;
    }

    .achievement-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .achievement-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        z-index: 1;
    }

    .achievement-header-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .achievement-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }

    .achievement-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .btn-add-new {
        padding: 14px 24px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        position: relative;
        z-index: 1;
    }

    .btn-add-new:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    /* Stats Grid */
    .stats-grid {
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
        transition: all 0.2s;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
    }

    .stat-card.draft::before { background: linear-gradient(180deg, #6b7280, #9ca3af); }
    .stat-card.pending::before { background: linear-gradient(180deg, #f59e0b, #fbbf24); }
    .stat-card.approved::before { background: linear-gradient(180deg, #10b981, #34d399); }
    .stat-card.rejected::before { background: linear-gradient(180deg, #ef4444, #f87171); }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .stat-card.draft .stat-icon { background: #f3f4f6; color: #6b7280; }
    .stat-card.pending .stat-icon { background: #fef3c7; color: #f59e0b; }
    .stat-card.approved .stat-icon { background: #dcfce7; color: #10b981; }
    .stat-card.rejected .stat-icon { background: #fee2e2; color: #ef4444; }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
    }

    .stat-label {
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
    }

    /* Alert */
    .alert-premium {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-premium.success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }

    .alert-premium.info {
        background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
        color: #0369a1;
        border: 1px solid #22d3ee;
    }

    /* Table Card */
    .table-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
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
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .table-badge {
        padding: 6px 14px;
        background: #cffafe;
        color: #0891b2;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .premium-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .premium-table th,
    .premium-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }

    .premium-table th {
        background: #fafbfc;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .premium-table tbody tr {
        transition: background 0.2s;
    }

    .premium-table tbody tr:hover {
        background: #f0f9ff;
    }

    .premium-table tbody tr:last-child td {
        border-bottom: none;
    }

    .item-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .item-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #f59e0b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .item-detail h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }

    .item-detail p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-badge.draft { background: #f3f4f6; color: #6b7280; }
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.revision { background: #ffedd5; color: #c2410c; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #cffafe;
        color: #0891b2;
    }

    .btn-edit:hover {
        background: #a5f3fc;
    }

    .btn-submit {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
    }

    .btn-delete {
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #fecaca;
    }

    .btn-revision {
        background: #ffedd5;
        color: #c2410c;
    }

    .btn-detail {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-waiting {
        background: #f3f4f6;
        color: #9ca3af;
        cursor: default;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 56px;
        color: #cffafe;
        margin-bottom: 16px;
    }

    .empty-state h4 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #9ca3af;
        margin-bottom: 24px;
    }

    .empty-state .btn-add-new {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border: none;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .achievement-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-add-new {
            width: 100%;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<div class="achievement-container">
    {{-- Header --}}
    <div class="achievement-header">
        <div class="achievement-header-left">
            <div class="achievement-header-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <div>
                <h1>Prestasi</h1>
                <p>Kelola semua prestasi dan pencapaian Anda</p>
            </div>
        </div>
        <a href="{{ route('mahasiswa.prestasi.create') }}" class="btn-add-new">
            <i class="fas fa-plus-circle"></i> Tambah Prestasi
        </a>
    </div>

    {{-- Alerts --}}
    @if ($message = Session::get('success'))
        <div class="alert-premium success">
            <i class="fas fa-check-circle"></i> {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="alert-premium info">
            <i class="fas fa-info-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card draft">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
            <div class="stat-value">{{ $prestasi->where('status', 'draft')->count() }}</div>
            <div class="stat-label">Draft (Belum Submit)</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">{{ $prestasi->where('status', 'submitted')->count() }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
        <div class="stat-card approved">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $prestasi->where('status', 'approved')->count() }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $prestasi->whereIn('status', ['rejected', 'revision_required'])->count() }}</div>
            <div class="stat-label">Ditolak / Revisi</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-list"></i>
                Daftar Prestasi
            </div>
            <span class="table-badge">{{ $prestasi->count() }} Data</span>
        </div>

        @if ($prestasi->count() > 0)
            <div class="table-wrapper">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Prestasi</th>
                            <th>Tingkat</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $key => $item)
                            @php
                                $statusVerifikasi = $item->verifikasiSkpi->status ?? $item->status;
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="item-info">
                                        <div class="item-icon">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                        <div class="item-detail">
                                            <h4>{{ $item->judul_prestasi }}</h4>
                                            <p>{{ $item->penyelenggara }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-transform: capitalize;">{{ $item->tingkat }}</td>
                                <td>{{ $item->tanggal_perolehan?->format('d M Y') ?? '-' }}</td>
                                <td>
                                    @if ($statusVerifikasi == 'pending')
                                        <span class="status-badge pending">
                                            <i class="fas fa-clock"></i> Menunggu
                                        </span>
                                    @elseif($statusVerifikasi == 'revision_required')
                                        <span class="status-badge revision">
                                            <i class="fas fa-exclamation-triangle"></i> Revisi
                                        </span>
                                    @elseif($statusVerifikasi == 'approved')
                                        <span class="status-badge approved">
                                            <i class="fas fa-check-circle"></i> Disetujui
                                        </span>
                                    @elseif($statusVerifikasi == 'rejected')
                                        <span class="status-badge rejected">
                                            <i class="fas fa-times-circle"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="status-badge draft">
                                            <i class="fas fa-file"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if ($item->status == 'draft')
                                            <a href="{{ route('mahasiswa.prestasi.edit', $item->id) }}" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('mahasiswa.prestasi.submit', $item->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="btn-action btn-submit">
                                                    <i class="fas fa-paper-plane"></i> Submit
                                                </button>
                                            </form>
                                            <form action="{{ route('mahasiswa.prestasi.destroy', $item->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @elseif($statusVerifikasi == 'revision_required')
                                            <a href="{{ route('mahasiswa.prestasi.edit', $item->id) }}" class="btn-action btn-revision">
                                                <i class="fas fa-edit"></i> Revisi
                                            </a>
                                        @elseif($statusVerifikasi == 'pending')
                                            <span class="btn-action btn-waiting">
                                                <i class="fas fa-clock"></i> Menunggu
                                            </span>
                                        @else
                                            <a href="{{ route('mahasiswa.prestasi.show', $item->id) }}" class="btn-action btn-detail">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-trophy"></i>
                <h4>Belum Ada Prestasi</h4>
                <p>Mulai dengan menambahkan prestasi pertama Anda</p>
                <a href="{{ route('mahasiswa.prestasi.create') }}" class="btn-add-new">
                    <i class="fas fa-plus-circle"></i> Tambah Prestasi
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

