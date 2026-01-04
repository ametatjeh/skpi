@extends('prodi.layouts.app')

@section('title', 'Kelola CPL - Prodi')
@section('page_title', 'Kelola CPL (Capaian Pembelajaran)')

@push('styles')
<style>
    /* ============ PREMIUM CPL MANAGEMENT STYLES ============ */
    .cpl-container * {
        box-sizing: border-box;
    }
    
    .cpl-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(5, 150, 105, 0.25);
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
    
    .btn-add {
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
    }
    
    .btn-add:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
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
    
    .stat-card.total .stat-icon { background: #d1fae5; color: #059669; }
    .stat-card.sikap .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.pengetahuan .stat-icon { background: #fef3c7; color: #92400e; }
    .stat-card.keterampilan .stat-icon { background: #f3e8ff; color: #7c3aed; }
    
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
    
    .alert-danger {
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
        font-size: 18px;
        color: inherit;
    }
    
    /* Section Card */
    .section-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .section-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .section-title i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .section-badge {
        padding: 8px 16px;
        background: #d1fae5;
        color: #059669;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
    }
    
    /* CPL Table */
    .cpl-table-wrapper {
        overflow-x: auto;
    }
    
    .cpl-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }
    
    .cpl-table th,
    .cpl-table td {
        padding: 18px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .cpl-table th {
        background: #fafbfc;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .cpl-table tbody tr {
        transition: background 0.2s;
    }
    
    .cpl-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .cpl-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* CPL Info Cell */
    .cpl-info {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    
    .cpl-code {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }
    
    .cpl-deskripsi {
        font-size: 14px;
        color: #374151;
        line-height: 1.6;
        max-width: 400px;
    }
    
    /* Category Badge */
    .kategori-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .kategori-badge.sikap { background: #dcfce7; color: #15803d; }
    .kategori-badge.pengetahuan { background: #fef3c7; color: #92400e; }
    .kategori-badge.keterampilan_umum { background: #d1fae5; color: #059669; }
    .kategori-badge.keterampilan_khusus { background: #f3e8ff; color: #7c3aed; }
    
    /* Urutan Badge */
    .urutan-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
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
    
    .status-badge.aktif {
        background: #dcfce7;
        color: #15803d;
    }
    
    .status-badge.nonaktif {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13px;
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
        background: #d1fae5;
        color: #059669;
    }
    
    .btn-edit:hover {
        background: #a7f3d0;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    .btn-delete:hover {
        background: #fecaca;
        transform: translateY(-2px);
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
    
    .empty-state p {
        font-size: 14px;
        margin-bottom: 20px;
    }
    
    .empty-state a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .empty-state a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        background: #fff;
        border-radius: 20px;
        max-width: 420px;
        width: 90%;
        padding: 32px;
        text-align: center;
        transform: scale(0.9);
        transition: transform 0.3s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1);
    }
    
    .modal-icon {
        width: 64px;
        height: 64px;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
    }
    
    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }
    
    .modal-message {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 24px;
        line-height: 1.6;
    }
    
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    
    .modal-btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .modal-btn.cancel {
        background: #f3f4f6;
        color: #374151;
    }
    
    .modal-btn.cancel:hover {
        background: #e5e7eb;
    }
    
    .modal-btn.danger {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    .modal-btn.danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
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
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .modal-buttons {
            flex-direction: column;
        }
        
        .modal-btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
@php
    // Define kategori mapping locally
    $kategoriLabels = [
        'sikap' => 'Sikap',
        'pengetahuan' => 'Pengetahuan', 
        'keterampilan_umum' => 'Keterampilan Umum',
        'keterampilan_khusus' => 'Keterampilan Khusus',
    ];
    
    $totalCpl = $cpl->count();
    $sikapCount = $cpl->where('kategori', 'sikap')->count();
    $pengetahuanCount = $cpl->where('kategori', 'pengetahuan')->count();
    $keterampilanCount = $cpl->whereIn('kategori', ['keterampilan_umum', 'keterampilan_khusus'])->count();
@endphp

<div class="cpl-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h1>Kelola CPL Program Studi</h1>
                    <p>Atur daftar Capaian Pembelajaran Lulusan untuk program studi Anda</p>
                </div>
            </div>
            <a href="{{ route('prodi.cpl.create') }}" class="btn-add">
                <i class="fas fa-plus-circle"></i> Tambah CPL Baru
            </a>
        </div>
    </div>
    
    {{-- Stats Row --}}
    <div class="stats-row">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalCpl }}</div>
                <div class="stat-label">Total CPL</div>
            </div>
        </div>
        
        <div class="stat-card sikap">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div>
                <div class="stat-value">{{ $sikapCount }}</div>
                <div class="stat-label">Sikap</div>
            </div>
        </div>
        
        <div class="stat-card pengetahuan">
            <div class="stat-icon">
                <i class="fas fa-brain"></i>
            </div>
            <div>
                <div class="stat-value">{{ $pengetahuanCount }}</div>
                <div class="stat-label">Pengetahuan</div>
            </div>
        </div>
        
        <div class="stat-card keterampilan">
            <div class="stat-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <div class="stat-value">{{ $keterampilanCount }}</div>
                <div class="stat-label">Keterampilan</div>
            </div>
        </div>
    </div>
    
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    
    {{-- CPL Table Card --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-book-open"></i>
                Daftar CPL
            </div>
            <span class="section-badge">{{ $cpl->count() }} CPL Terdaftar</span>
        </div>
        
        @if($cpl->count())
            <div class="cpl-table-wrapper">
                <table class="cpl-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Urutan</th>
                            <th style="width: 140px;">Kode</th>
                            <th>Deskripsi</th>
                            <th style="width: 160px;">Kategori</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cpl as $item)
                            <tr>
                                <td>
                                    <span class="urutan-badge">{{ $item->urutan ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="cpl-code">{{ $item->kode }}</span>
                                </td>
                                <td>
                                    <div class="cpl-deskripsi">{{ Str::limit($item->deskripsi, 100) }}</div>
                                </td>
                                <td>
                                    <span class="kategori-badge {{ $item->kategori }}">
                                        @if($item->kategori == 'sikap')
                                            <i class="fas fa-heart"></i>
                                        @elseif($item->kategori == 'pengetahuan')
                                            <i class="fas fa-brain"></i>
                                        @else
                                            <i class="fas fa-tools"></i>
                                        @endif
                                        {{ $kategoriLabels[$item->kategori] ?? ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="status-badge aktif">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </span>
                                    @else
                                        <span class="status-badge nonaktif">
                                            <i class="fas fa-times-circle"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('prodi.cpl.edit', $item->id) }}" class="btn-action btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn-action btn-delete" onclick="openDeleteModal({{ $item->id }}, '{{ $item->kode }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h4>Belum Ada CPL</h4>
                <p>Klik tombol di bawah untuk menambahkan CPL baru</p>
                <a href="{{ route('prodi.cpl.create') }}">
                    <i class="fas fa-plus-circle"></i> Tambah CPL Baru
                </a>
            </div>
        @endif
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-trash-alt"></i>
        </div>
        <h3 class="modal-title">Hapus CPL?</h3>
        <p class="modal-message">
            Apakah Anda yakin ingin menghapus <strong id="deleteCplCode"></strong>? 
            Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="modal-buttons">
            <button class="modal-btn cancel" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="modal-btn danger">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openDeleteModal(id, kode) {
    const form = document.getElementById('deleteForm');
    form.action = '{{ route("prodi.cpl.destroy", ":id") }}'.replace(':id', id);
    document.getElementById('deleteCplCode').textContent = kode;
    document.getElementById('deleteModal').classList.add('show');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}

// Close modal on overlay click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endpush
