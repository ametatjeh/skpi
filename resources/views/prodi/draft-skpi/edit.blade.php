@extends('prodi.layouts.app')

@section('title', 'Edit Draft SKPI')

@section('content')
<style>
    /* ============ EDIT DRAFT SKPI PREMIUM STYLES ============ */
    .edit-container {
        max-width: 1100px;
        margin: 0 auto;
    }
    
    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
        font-size: 14px;
    }
    
    .breadcrumb a {
        color: #6b7280;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }
    
    .breadcrumb a:hover {
        color: #2563eb;
    }
    
    .breadcrumb-separator {
        color: #d1d5db;
    }
    
    .breadcrumb-current {
        color: #111827;
        font-weight: 600;
    }
    
    /* Page Header */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
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
    
    /* Two Column Layout */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
    }
    
    /* Mahasiswa Info Card */
    .info-card {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-radius: 16px;
        padding: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(30, 64, 175, 0.25);
    }
    
    .info-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }
    
    .info-avatar {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 800;
    }
    
    .info-name h3 {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }
    
    .info-name p {
        font-size: 13px;
        opacity: 0.9;
        margin: 0;
    }
    
    .info-detail {
        display: grid;
        gap: 12px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }
    
    .info-item i {
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
    
    .info-item span {
        font-size: 13px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .status-badge.valid_prodi { color: #1e40af; }
    .status-badge.valid_pusat_bahasa { color: #7c3aed; }
    .status-badge.valid_fakultas { color: #92400e; }
    .status-badge.final_issued { color: #15803d; }
    
    /* Form Card */
    .form-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .form-header {
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .form-header i {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .form-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .form-body {
        padding: 24px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fff;
    }
    
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }
    
    .form-error {
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn {
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    /* Achievement List */
    .achievement-list {
        padding: 0;
    }
    
    .achievement-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s;
    }
    
    .achievement-item:last-child {
        border-bottom: none;
    }
    
    .achievement-item:hover {
        background: #f8fafc;
    }
    
    .achievement-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .achievement-icon.sertifikasi { background: #dcfce7; color: #15803d; }
    .achievement-icon.prestasi { background: #fef3c7; color: #92400e; }
    .achievement-icon.organisasi { background: #dbeafe; color: #1e40af; }
    .achievement-icon.pkm { background: #f3e8ff; color: #7c3aed; }
    .achievement-icon.karya { background: #fce7f3; color: #be185d; }
    .achievement-icon.penghargaan { background: #ffedd5; color: #ea580c; }
    
    .achievement-content {
        flex: 1;
    }
    
    .achievement-content h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }
    
    .achievement-content p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    .achievement-badge {
        padding: 4px 10px;
        background: #dcfce7;
        color: #15803d;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 40px;
        margin-bottom: 12px;
        opacity: 0.5;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<div class="edit-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('prodi.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('prodi.draft-skpi.index') }}"><i class="fas fa-file-signature"></i> Draft SKPI</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Edit Draft</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <h1><i class="fas fa-edit"></i> Edit Draft SKPI</h1>
    </div>
    
    <div class="content-grid">
        {{-- Left: Forms --}}
        <div>
            {{-- Edit Form --}}
            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-edit"></i>
                    <h3>Form Edit Draft</h3>
                </div>
                
                <div class="form-body">
                    <form action="{{ route('prodi.draft-skpi.update', $skpi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="form-label">Nomor SKPI</label>
                            <input type="text" name="nomor_skpi" value="{{ old('nomor_skpi', $skpi->nomor_skpi) }}" 
                                class="form-input" placeholder="Contoh: SKPI/2024/001">
                            @error('nomor_skpi')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan Prodi</label>
                            <textarea name="catatan" class="form-textarea" placeholder="Tambahkan catatan...">{{ old('catatan', $skpi->catatan) }}</textarea>
                            @error('catatan')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Ringkasan Bilingual Section --}}
                        <div style="margin: 24px 0; padding: 20px; background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%); border-radius: 12px; border: 1px solid #a5f3fc;">
                            <h4 style="margin: 0 0 16px 0; font-size: 15px; font-weight: 700; color: #0e7490; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-language" style="color: #06b6d4;"></i>
                                Ringkasan Bilingual SKPI
                            </h4>
                            <p style="font-size: 12px; color: #6b7280; margin: 0 0 16px 0;">
                                <i class="fas fa-info-circle"></i> Ringkasan ini akan diverifikasi oleh Pusat Bahasa sebelum SKPI diterbitkan.
                            </p>
                            
                            <div class="form-group">
                                <label class="form-label" style="display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 24px; height: 18px; background: linear-gradient(180deg, #dc2626 50%, #fff 50%); border-radius: 3px; border: 1px solid #ddd;"></span>
                                    Ringkasan Bahasa Indonesia
                                </label>
                                <textarea name="ringkasan_id" class="form-textarea" rows="5" 
                                    placeholder="Tuliskan ringkasan capaian mahasiswa dalam Bahasa Indonesia...">{{ old('ringkasan_id', $skpi->ringkasan_id) }}</textarea>
                                @error('ringkasan_id')
                                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label" style="display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 24px; height: 18px; background: linear-gradient(180deg, #1e40af 30%, #fff 30%, #fff 60%, #ef4444 60%); border-radius: 3px; border: 1px solid #ddd;"></span>
                                    Ringkasan English
                                </label>
                                <textarea name="ringkasan_en" class="form-textarea" rows="5" 
                                    placeholder="Write the student achievement summary in English...">{{ old('ringkasan_en', $skpi->ringkasan_en) }}</textarea>
                                @error('ringkasan_en')
                                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('prodi.draft-skpi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            @if(in_array($skpi->status, ['valid_prodi', 'draft']))
                                <a href="{{ route('prodi.draft-skpi.preview', $skpi->id) }}" class="btn btn-success">
                                    <i class="fas fa-eye"></i> Preview & Submit
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Achievement List --}}
            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-trophy"></i>
                    <h3>Butir Kegiatan (Approved)</h3>
                </div>
                
                @if(isset($approvedItems) && $approvedItems->count())
                    <div class="achievement-list">
                        @foreach($approvedItems as $item)
                            @php
                                $typeClass = match($item->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'sertifikasi',
                                    'App\Models\Prestasi' => 'prestasi',
                                    'App\Models\Organisasi' => 'organisasi',
                                    'App\Models\PengabdianMasyarakat' => 'pkm',
                                    'App\Models\KaryaIlmiah' => 'karya',
                                    'App\Models\Penghargaan' => 'penghargaan',
                                    default => 'sertifikasi'
                                };
                                $typeIcon = match($item->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'fa-certificate',
                                    'App\Models\Prestasi' => 'fa-trophy',
                                    'App\Models\Organisasi' => 'fa-users',
                                    'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
                                    'App\Models\KaryaIlmiah' => 'fa-book',
                                    'App\Models\Penghargaan' => 'fa-award',
                                    default => 'fa-star'
                                };
                                $typeName = match($item->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
                                    'App\Models\Prestasi' => 'Prestasi',
                                    'App\Models\Organisasi' => 'Organisasi',
                                    'App\Models\PengabdianMasyarakat' => 'PKM',
                                    'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                                    'App\Models\Penghargaan' => 'Penghargaan',
                                    default => 'Achievement'
                                };
                            @endphp
                            <div class="achievement-item">
                                <div class="achievement-icon {{ $typeClass }}">
                                    <i class="fas {{ $typeIcon }}"></i>
                                </div>
                                <div class="achievement-content">
                                    <h4>{{ $item->verifiable->judul ?? ($item->verifiable->nama ?? ($item->verifiable->nama_kegiatan ?? 'Achievement')) }}</h4>
                                    <p>{{ $typeName }}</p>
                                </div>
                                <span class="achievement-badge">
                                    <i class="fas fa-check"></i> Approved
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>Belum ada butir kegiatan yang disetujui.</p>
                    </div>
                @endif
            </div>
        </div>
        
        {{-- Right: Info Card --}}
        <div>
            <div class="info-card">
                <div class="info-header">
                    <div class="info-avatar">
                        {{ strtoupper(substr($skpi->mahasiswa->nama ?? 'M', 0, 2)) }}
                    </div>
                    <div class="info-name">
                        <h3>{{ $skpi->mahasiswa->nama ?? '-' }}</h3>
                        <p>{{ $skpi->mahasiswa->nim ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="info-detail">
                    <div class="info-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>{{ $skpi->mahasiswa->prodi->nama_prodi ?? 'Program Studi' }}</span>
                    </div>
                    @if($skpi->nomor_skpi)
                    <div class="info-item">
                        <i class="fas fa-hashtag"></i>
                        <span>{{ $skpi->nomor_skpi }}</span>
                    </div>
                    @endif
                    <div class="info-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $skpi->created_at ? $skpi->created_at->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-info-circle"></i>
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
                        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Success/Error Modal --}}
<div class="modal-overlay" id="statusModal">
    <div class="modal-content">
        <div class="modal-icon" id="modalIcon">
            <i class="fas fa-check" id="modalIconI"></i>
        </div>
        <h3 class="modal-title" id="modalTitle">Berhasil!</h3>
        <p class="modal-message" id="modalMessage">Data berhasil disimpan.</p>
        <button class="modal-btn success" onclick="closeModal()">
            <i class="fas fa-check"></i> OK
        </button>
    </div>
</div>

<style>
    /* Modal Overlay */
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
    
    /* Modal Content */
    .modal-content {
        background: #fff;
        border-radius: 24px;
        max-width: 380px;
        width: 90%;
        padding: 40px 32px;
        text-align: center;
        transform: scale(0.8) translateY(20px);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3);
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1) translateY(0);
    }
    
    /* Modal Icon */
    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 36px;
        animation: iconPop 0.5s ease 0.2s forwards;
        transform: scale(0);
    }
    
    .modal-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.4);
    }
    
    .modal-icon.error {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        box-shadow: 0 8px 32px rgba(239, 68, 68, 0.4);
    }
    
    @keyframes iconPop {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    /* Modal Title */
    .modal-title {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 12px 0;
    }
    
    /* Modal Message */
    .modal-message {
        font-size: 14px;
        color: #6b7280;
        margin: 0 0 28px 0;
        line-height: 1.6;
    }
    
    /* Modal Button */
    .modal-btn {
        padding: 14px 36px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .modal-btn.success {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .modal-btn.success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }
    
    .modal-btn.error {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
</style>

@push('scripts')
<script>
    function showModal(type, title, message) {
        const modal = document.getElementById('statusModal');
        const icon = document.getElementById('modalIcon');
        const iconI = document.getElementById('modalIconI');
        const titleEl = document.getElementById('modalTitle');
        const messageEl = document.getElementById('modalMessage');
        
        // Reset animation
        icon.style.animation = 'none';
        setTimeout(() => { icon.style.animation = ''; }, 10);
        
        if (type === 'success') {
            icon.className = 'modal-icon success';
            iconI.className = 'fas fa-check';
        } else {
            icon.className = 'modal-icon error';
            iconI.className = 'fas fa-times';
        }
        
        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.classList.add('show');
    }
    
    function closeModal() {
        document.getElementById('statusModal').classList.remove('show');
    }
    
    // Close on overlay click
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    
    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
    
    // Auto show modal if session has message
    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            showModal('success', 'Berhasil!', '{{ session('success') }}');
        });
    @endif
    
    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            showModal('error', 'Gagal!', '{{ session('error') }}');
        });
    @endif
</script>
@endpush
