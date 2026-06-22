@extends('admin.layouts.app')

@section('title', 'Manajemen QR Code SKPI')

@push('styles')
<style>
    /* ============ PREMIUM QR CODE STYLES ============ */
    .qr-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .page-header {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(30, 41, 59, 0.25);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .header-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,0.2);
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
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .stat-card.total .stat-icon { background: #e0e7ff; color: #4338ca; }
    .stat-card.aktif .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.nonaktif .stat-icon { background: #fee2e2; color: #b91c1c; }
    
    .stat-info h4 {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 4px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .stat-info .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }
    
    /* Alerts */
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
    
    .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #f87171; }
    
    /* Table Card */
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
        gap: 12px;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .custom-table th {
        background: #fafbfc;
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .custom-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }
    
    .custom-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .mhs-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .mhs-avatar {
        width: 40px;
        height: 40px;
        background: #e0e7ff;
        color: #4338ca;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }
    
    .mhs-name {
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }
    
    .mhs-nim {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    .qr-preview {
        width: 48px;
        height: 48px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 4px;
        background: #fff;
    }
    
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-aktif { background: #dcfce7; color: #15803d; }
    .badge-nonaktif { background: #fee2e2; color: #b91c1c; }
    .badge-expired { background: #fef3c7; color: #92400e; }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .btn-edit { background: #dbeafe; color: #1e40af; }
    .btn-edit:hover { background: #bfdbfe; }
    
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #fecaca; }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 16px;
    }
    
    .empty-state h3 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        font-size: 14px;
        color: #6b7280;
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    
    .modal-overlay.show {
        display: flex;
        animation: fadeIn 0.2s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .modal-content {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 450px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transform: scale(0.95);
        transition: transform 0.2s ease;
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1);
    }
    
    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 20px;
        color: #6b7280;
        cursor: pointer;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
    }
    
    .modal-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    
    .btn-cancel {
        padding: 10px 20px;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
    }
    
    .btn-submit {
        padding: 10px 20px;
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
    }
</style>
@endpush

@php
    $total = $data->count();
    $aktif = $data->where('is_active', true)->count();
    $nonaktif = $total - $aktif;
@endphp

@section('content')
<div class="qr-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-icon">
            <i class="fas fa-qrcode"></i>
        </div>
        <div>
            <h1>Manajemen QR Code SKPI</h1>
            <p>Kelola akses verifikasi dan validitas QR Code SKPI Mahasiswa</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif
    
    {{-- Stats Row --}}
    <div class="stats-row">
        <div class="stat-card total">
            <div class="stat-icon"><i class="fas fa-qrcode"></i></div>
            <div class="stat-info">
                <h4>Total QR Code</h4>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>
        <div class="stat-card aktif">
            <div class="stat-icon"><i class="fas fa-check"></i></div>
            <div class="stat-info">
                <h4>Status Aktif</h4>
                <div class="stat-value">{{ $aktif }}</div>
            </div>
        </div>
        <div class="stat-card nonaktif">
            <div class="stat-icon"><i class="fas fa-ban"></i></div>
            <div class="stat-info">
                <h4>Status Nonaktif</h4>
                <div class="stat-value">{{ $nonaktif }}</div>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="section-card">
        <div class="section-header">
            <i class="fas fa-list" style="width:36px;height:36px;background:#334155;color:#fff;display:flex;align-items:center;justify-content:center;border-radius:10px;"></i>
            <h3 class="section-title">Daftar QR Code Mahasiswa</h3>
        </div>
        
        @if($total > 0)
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Mahasiswa</th>
                            <th>SKPI Ref.</th>
                            <th>Status Akses</th>
                            <th>Berlaku Sampai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>
                                    @if($item->qr_image_path)
                                        <img src="{{ asset('storage/' . $item->qr_image_path) }}" class="qr-preview" alt="QR Code">
                                    @else
                                        <div class="qr-preview" style="display:flex;align-items:center;justify-content:center;color:#9ca3af;background:#f3f4f6;">
                                            <i class="fas fa-qrcode fa-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="mhs-info">
                                        <div class="mhs-avatar">
                                            {{ strtoupper(substr($item->mahasiswa->nama ?? 'M', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="mhs-name">{{ $item->mahasiswa->nama ?? 'Tidak Ditemukan' }}</p>
                                            <p class="mhs-nim">{{ $item->mahasiswa->nim ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $item->draftSkpi->nomor_skpi ?? 'Belum ada SKPI' }}</strong>
                                </td>
                                <td>
                                    @php
                                        $isExpired = $item->expired_at && \Carbon\Carbon::parse($item->expired_at)->isPast();
                                    @endphp
                                    
                                    @if($isExpired)
                                        <span class="badge-status badge-expired"><i class="fas fa-clock"></i> Kedaluwarsa</span>
                                    @elseif($item->is_active)
                                        <span class="badge-status badge-aktif"><i class="fas fa-check-circle"></i> Aktif</span>
                                    @else
                                        <span class="badge-status badge-nonaktif"><i class="fas fa-ban"></i> Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->expired_at ? \Carbon\Carbon::parse($item->expired_at)->format('d M Y') : 'Tanpa Batas' }}
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-action btn-edit" data-item="{{ json_encode($item) }}" onclick="openModal(this)" title="Ubah Status">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <form action="{{ route('admin.qr.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus QR Code ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-qrcode"></i>
                <h3>Belum ada QR Code</h3>
                <p>QR Code akan dibuat otomatis saat SKPI mahasiswa disetujui (Final).</p>
            </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Pengaturan QR Code</h3>
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <form id="qrForm" method="POST" action="">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <p style="margin-top:0; font-size:13px; color:#6b7280; margin-bottom:20px;">
                    Anda dapat mematikan sementara akses scan QR Code untuk dokumen SKPI tertentu jika diperlukan.
                </p>
                
                <div class="form-group">
                    <label class="form-label">Status Akses</label>
                    <select name="is_active" id="is_active" class="form-input" required>
                        <option value="1">Aktif (Dapat di-scan)</option>
                        <option value="0">Nonaktif (Diblokir sementara)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Berlaku Sampai Tanggal</label>
                    <input type="date" name="expired_at" id="expired_at" class="form-input">
                    <small style="color:#6b7280; font-size:12px; margin-top:4px; display:block;">Kosongkan jika masa berlaku tanpa batas (seumur hidup).</small>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openModal(btn) {
        const data = JSON.parse(btn.getAttribute('data-item'));
        const modal = document.getElementById('editModal');
        const form = document.getElementById('qrForm');
        
        form.action = `/admin/qr/${data.id}`;
        
        document.getElementById('is_active').value = data.is_active ? '1' : '0';
        
        if (data.expired_at) {
            document.getElementById('expired_at').value = data.expired_at.split(' ')[0];
        } else {
            document.getElementById('expired_at').value = '';
        }
        
        modal.classList.add('show');
    }
    
    function closeModal() {
        document.getElementById('editModal').classList.remove('show');
    }
    
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
