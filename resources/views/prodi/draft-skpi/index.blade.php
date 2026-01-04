@extends('prodi.layouts.app')

@section('title', 'Draft SKPI Mahasiswa')

@section('content')
<style>
    /* ============ DRAFT SKPI PREMIUM STYLES ============ */
    .draft-container * {
        box-sizing: border-box;
    }
    
    .draft-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 16px;
    }
    
    /* Header */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    
    .page-header-left h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .page-header-left p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }
    
    /* Stats Overview */
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }
    
    .stat-card.eligible .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.draft .stat-icon { background: #d1fae5; color: #059669; }
    .stat-card.pending .stat-icon { background: #fef3c7; color: #f59e0b; }
    .stat-card.final .stat-icon { background: #f3e8ff; color: #7c3aed; }
    
    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* Alert Messages */
    .alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
        border: 1px solid #f87171;
    }
    
    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.7;
    }
    
    .alert-close:hover {
        opacity: 1;
    }
    
    /* Section Card */
    .section-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title i {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .section-badge {
        padding: 4px 12px;
        background: #d1fae5;
        color: #059669;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .section-badge.green {
        background: #dcfce7;
        color: #15803d;
    }
    
    /* Eligible Mahasiswa Grid */
    .eligible-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 24px;
    }
    
    .eligible-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        overflow: hidden;
    }
    
    .eligible-card:hover {
        border-color: #059669;
        box-shadow: 0 8px 24px rgba(5, 150, 105, 0.12);
        transform: translateY(-2px);
    }
    
    .eligible-info {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .eligible-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .eligible-detail {
        flex: 1;
        min-width: 0;
        overflow: hidden;
    }
    
    .eligible-detail h4 {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px 0;
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .eligible-detail p {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }
    
    .btn-create-draft {
        display: block;
        width: 100%;
        padding: 12px 16px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    
    .btn-create-draft i {
        margin-right: 6px;
    }
    
    .btn-create-draft:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.5;
    }
    
    .empty-state h4 {
        font-size: 16px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 4px;
    }
    
    .empty-state p {
        font-size: 13px;
    }
    
    /* Draft List */
    .draft-list {
        padding: 0;
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
        white-space: nowrap;
    }
    
    .draft-table th {
        background: #f8fafc;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .draft-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .draft-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .draft-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    
    .draft-avatar {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .draft-detail h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }
    
    .draft-detail p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    .draft-nomor {
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        font-family: 'Courier New', monospace;
    }
    
    .draft-date {
        font-size: 13px;
        color: #6b7280;
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
        white-space: nowrap;
    }
    
    .status-badge.draft { background: #e0e7ff; color: #3730a3; }
    .status-badge.valid_prodi { background: #dbeafe; color: #1e40af; }
    .status-badge.valid_pusat_bahasa { background: #f3e8ff; color: #7c3aed; }
    .status-badge.valid_fakultas { background: #fef3c7; color: #92400e; }
    .status-badge.final_issued { background: #dcfce7; color: #15803d; }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
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
        white-space: nowrap;
    }
    
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }
    
    .btn-edit:hover {
        background: #fde68a;
    }
    
    .btn-preview {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
    }
    
    .btn-preview:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
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
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .eligible-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<div class="draft-container">
    {{-- Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1><i class="fas fa-file-signature"></i> Draft SKPI Mahasiswa</h1>
            <p>Kelola draft Surat Keterangan Pendamping Ijazah mahasiswa</p>
        </div>
    </div>
    
    {{-- Stats Overview --}}
    @php
        $totalEligible = $mahasiswaEligible->count();
        $totalDrafts = $drafts->total();
        $draftValidProdi = $drafts->where('status', 'valid_prodi')->count();
        $draftFinal = $drafts->where('status', 'final_issued')->count();
    @endphp
    
    <div class="stats-row">
        <div class="stat-card eligible">
            <div class="stat-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-value">{{ $totalEligible }}</div>
            <div class="stat-label">Mahasiswa Eligible</div>
        </div>
        
        <div class="stat-card draft">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-value">{{ $totalDrafts }}</div>
            <div class="stat-label">Total Draft SKPI</div>
        </div>
        
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ $draftValidProdi }}</div>
            <div class="stat-label">Menunggu Review</div>
        </div>
        
        <div class="stat-card final">
            <div class="stat-icon">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="stat-value">{{ $draftFinal }}</div>
            <div class="stat-label">Final / Terbit</div>
        </div>
    </div>
    
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    {{-- Mahasiswa Eligible Section --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-user-plus"></i>
                Mahasiswa Eligible untuk Draft SKPI
            </div>
            <span class="section-badge green">{{ $totalEligible }} Mahasiswa</span>
        </div>
        
        @if($mahasiswaEligible->count() > 0)
            <div class="eligible-grid">
                @foreach($mahasiswaEligible as $m)
                    <div class="eligible-card">
                        <div class="eligible-info">
                            <div class="eligible-avatar">
                                {{ strtoupper(substr($m->nama, 0, 2)) }}
                            </div>
                            <div class="eligible-detail">
                                <h4>{{ $m->nama }}</h4>
                                <p>NIM: {{ $m->nim }}</p>
                            </div>
                        </div>
                        <a href="{{ route('prodi.draft-skpi.create', $m->verifikasi_skpi_approved_id) }}" class="btn-create-draft">
                            <i class="fas fa-plus-circle"></i> Buat Draft SKPI
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-user-slash"></i>
                <h4>Tidak Ada Mahasiswa Eligible</h4>
                <p>Mahasiswa harus memiliki minimal 2 kategori achievement yang disetujui.</p>
            </div>
        @endif
    </div>
    
    {{-- Draft SKPI List --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-list-alt"></i>
                Daftar Draft SKPI
            </div>
            <span class="section-badge">{{ $totalDrafts }} Draft</span>
        </div>
        
        @if($drafts->count() > 0)
            <div class="draft-list">
                <table class="draft-table">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Nomor SKPI</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drafts as $skpi)
                            @php
                                $statusClass = str_replace(' ', '_', strtolower($skpi->status));
                                $statusLabel = match($skpi->status) {
                                    'draft' => 'Draft',
                                    'valid_prodi' => 'Valid Prodi',
                                    'valid_pusat_bahasa' => 'Di Pusat Bahasa',
                                    'valid_fakultas' => 'Di Fakultas',
                                    'final_issued' => 'Final / Terbit',
                                    default => ucwords(str_replace('_', ' ', $skpi->status))
                                };
                            @endphp
                            <tr>
                                <td>
                                    <div class="draft-info">
                                        <div class="draft-avatar">
                                            {{ strtoupper(substr($skpi->mahasiswa->nama ?? 'M', 0, 2)) }}
                                        </div>
                                        <div class="draft-detail">
                                            <h4>{{ $skpi->mahasiswa->nama ?? '-' }}</h4>
                                            <p>NIM: {{ $skpi->mahasiswa->nim ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="draft-nomor">{{ $skpi->nomor_skpi ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="draft-date">{{ $skpi->created_at ? $skpi->created_at->format('d M Y') : '-' }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if(in_array($skpi->status, ['draft', 'valid_prodi']))
                                            <a href="{{ route('prodi.draft-skpi.edit', $skpi->id) }}" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif
                                        <a href="{{ route('prodi.draft-skpi.preview', $skpi->id) }}" class="btn-action btn-preview">
                                            <i class="fas fa-eye"></i> Preview
                                        </a>
                                    </div>
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
                <i class="fas fa-file-alt"></i>
                <h4>Belum Ada Draft SKPI</h4>
                <p>Buat draft SKPI dari mahasiswa yang eligible di atas.</p>
            </div>
        @endif
    </div>
</div>
@endsection
