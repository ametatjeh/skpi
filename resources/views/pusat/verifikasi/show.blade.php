@extends('pusat.layouts.app')
@section('title', 'Review Draft SKPI - Pusat Bahasa')

@push('styles')
<style>
    /* ============ PREMIUM REVIEW PAGE STYLES ============ */
    .review-container * {
        box-sizing: border-box;
    }
    
    .review-container {
        max-width: 1200px;
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
        gap: 6px;
        transition: color 0.2s;
    }
    
    .breadcrumb a:hover {
        color: #0891b2;
    }
    
    .breadcrumb span {
        color: #9ca3af;
    }
    
    .breadcrumb .current {
        color: #111827;
        font-weight: 600;
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
    
    .status-header-badge {
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
    }
    
    /* Student Info Card */
    .student-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .student-avatar-large {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
    }
    
    .student-details {
        flex: 1;
    }
    
    .student-details h3 {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 8px 0;
    }
    
    .student-meta {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6b7280;
    }
    
    .meta-item i {
        color: #9ca3af;
    }
    
    .meta-item strong {
        color: #374151;
    }
    
    .draft-info {
        text-align: right;
    }
    
    .draft-number {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 4px;
    }
    
    .draft-date {
        font-size: 13px;
        color: #374151;
    }
    
    /* Bilingual Content */
    .bilingual-section {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .language-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .language-header {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .language-header.indonesian {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        color: #fff;
    }
    
    .language-header.english {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .language-header i {
        font-size: 20px;
    }
    
    .language-header h4 {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }
    
    .language-body {
        padding: 24px;
    }
    
    .content-text {
        font-size: 14px;
        color: #374151;
        line-height: 1.8;
        white-space: pre-line;
    }
    
    .content-empty {
        color: #9ca3af;
        font-style: italic;
        text-align: center;
        padding: 20px;
    }
    
    /* Action Section */
    .action-section {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .action-header {
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .action-header i {
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
    
    .action-header h4 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .action-body {
        padding: 24px;
    }
    
    /* Catatan Form */
    .catatan-group {
        margin-bottom: 24px;
    }
    
    .catatan-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 10px;
    }
    
    .catatan-label i {
        color: #6b7280;
    }
    
    .catatan-textarea {
        width: 100%;
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
        font-family: inherit;
        min-height: 100px;
        resize: vertical;
        transition: all 0.2s;
    }
    
    .catatan-textarea:focus {
        outline: none;
        border-color: #06b6d4;
        box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1);
    }
    
    .catatan-hint {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 6px;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .btn-action {
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s;
    }
    
    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
    }
    
    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
    }
    
    .btn-back {
        background: #f3f4f6;
        color: #374151;
        text-decoration: none;
    }
    
    .btn-back:hover {
        background: #e5e7eb;
    }
    
    /* Log Section */
    .log-section {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .log-header {
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .log-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .log-header h4 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .log-body {
        padding: 24px;
    }
    
    .log-timeline {
        position: relative;
        padding-left: 28px;
    }
    
    .log-timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e5e7eb;
    }
    
    .log-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .log-item:last-child {
        padding-bottom: 0;
    }
    
    .log-item::before {
        content: '';
        position: absolute;
        left: -22px;
        top: 6px;
        width: 12px;
        height: 12px;
        background: #06b6d4;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #e5e7eb;
    }
    
    .log-role {
        display: inline-block;
        padding: 4px 10px;
        background: #cffafe;
        color: #0e7490;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }
    
    .log-action {
        font-size: 14px;
        color: #374151;
        margin-bottom: 4px;
    }
    
    .log-action .arrow {
        color: #9ca3af;
        margin: 0 4px;
    }
    
    .log-date {
        font-size: 12px;
        color: #9ca3af;
    }
    
    .log-catatan {
        margin-top: 8px;
        padding: 10px 14px;
        background: #f8fafc;
        border-radius: 8px;
        font-size: 13px;
        color: #6b7280;
        border-left: 3px solid #06b6d4;
    }
    
    /* Modal Confirm */
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
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
    }
    
    .modal-icon.warning {
        background: #fef3c7;
        color: #92400e;
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
    
    .modal-btn.confirm {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .student-card {
            flex-direction: column;
            text-align: center;
        }
        
        .student-meta {
            justify-content: center;
        }
        
        .draft-info {
            text-align: center;
        }
        
        .bilingual-section {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="review-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('pusat.verifikasi.index') }}">
            <i class="fas fa-inbox"></i> Verifikasi Draft
        </a>
        <span>/</span>
        <span class="current">Review Draft</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div>
                    <h1>Review Draft SKPI</h1>
                    <p>Verifikasi konten bilingual SKPI mahasiswa</p>
                </div>
            </div>
            <div class="status-header-badge">
                <i class="fas fa-circle" style="font-size: 8px; margin-right: 6px;"></i>
                {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
            </div>
        </div>
    </div>
    
    {{-- Student Info Card --}}
    <div class="student-card">
        <div class="student-avatar-large">
            {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
        </div>
        <div class="student-details">
            <h3>{{ $draft->mahasiswa->nama ?? '-' }}</h3>
            <div class="student-meta">
                <div class="meta-item">
                    <i class="fas fa-id-card"></i>
                    <span>NIM: <strong>{{ $draft->mahasiswa->nim ?? '-' }}</strong></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Prodi: <strong>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</strong></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    <span>Fakultas: <strong>{{ $draft->mahasiswa->prodi->fakultas->nama_fakultas ?? '-' }}</strong></span>
                </div>
            </div>
        </div>
        <div class="draft-info">
            <div class="draft-number">No. SKPI: {{ $draft->nomor_skpi ?? 'Belum ada' }}</div>
            <div class="draft-date">
                <i class="fas fa-calendar"></i> 
                {{ $draft->created_at ? $draft->created_at->format('d M Y, H:i') : '-' }}
            </div>
        </div>
    </div>
    
    {{-- Editable Bilingual Content --}}
    <div class="action-section" style="margin-bottom: 24px;">
        <div class="action-header" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); color: #fff;">
            <i class="fas fa-language" style="background: rgba(255,255,255,0.2);"></i>
            <h4 style="color: #fff;">Edit Ringkasan Bilingual</h4>
        </div>
        <div class="action-body">
            @if(session('success'))
                <div style="background: #dcfce7; border: 1px solid #86efac; color: #15803d; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('pusat.verifikasi.update-ringkasan', $draft->id) }}">
                @csrf
                @method('PUT')
                
                <p style="font-size: 13px; color: #6b7280; margin: 0 0 20px 0; background: #f0fdfa; padding: 12px 16px; border-radius: 10px; border-left: 4px solid #06b6d4;">
                    <i class="fas fa-info-circle" style="color: #06b6d4;"></i>
                    Anda dapat mengedit dan memperbaiki ringkasan bilingual sebelum menyetujui draft ini.
                </p>
                
                <div class="catatan-group" style="margin-bottom: 20px;">
                    <label class="catatan-label" style="display: flex; align-items: center; gap: 8px;">
                        <span style="display: inline-block; width: 24px; height: 18px; background: linear-gradient(180deg, #dc2626 50%, #fff 50%); border-radius: 3px; border: 1px solid #ddd;"></span>
                        Ringkasan Bahasa Indonesia
                    </label>
                    <textarea name="ringkasan_id" class="catatan-textarea" rows="5" 
                        placeholder="Tuliskan ringkasan capaian mahasiswa dalam Bahasa Indonesia...">{{ old('ringkasan_id', $draft->ringkasan_id) }}</textarea>
                </div>
                
                <div class="catatan-group" style="margin-bottom: 20px;">
                    <label class="catatan-label" style="display: flex; align-items: center; gap: 8px;">
                        <span style="display: inline-block; width: 24px; height: 18px; background: linear-gradient(180deg, #1e40af 30%, #fff 30%, #fff 60%, #ef4444 60%); border-radius: 3px; border: 1px solid #ddd;"></span>
                        Ringkasan English
                    </label>
                    <textarea name="ringkasan_en" class="catatan-textarea" rows="5" 
                        placeholder="Write the student achievement summary in English...">{{ old('ringkasan_en', $draft->ringkasan_en) }}</textarea>
                </div>
                
                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="btn-action" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); color: #fff;">
                        <i class="fas fa-save"></i> Simpan Ringkasan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Action Section (Approve/Reject) --}}
    <div class="action-section">
        <div class="action-header">
            <i class="fas fa-tasks"></i>
            <h4>Tindakan Verifikasi</h4>
        </div>
        <div class="action-body">
            <form method="POST" action="{{ route('pusat.verifikasi.approve', $draft->id) }}" id="approveForm">
                @csrf
                <div class="catatan-group">
                    <label class="catatan-label">
                        <i class="fas fa-comment-alt"></i>
                        Catatan Reviewer (opsional)
                    </label>
                    <textarea name="catatan" id="catatan" class="catatan-textarea" 
                        placeholder="Tambahkan catatan, saran perbaikan terjemahan, atau komentar lainnya..."></textarea>
                    <div class="catatan-hint">Catatan akan disimpan dan terlihat di riwayat approval</div>
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('pusat.verifikasi.index') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="button" class="btn-action btn-reject" onclick="openRejectModal()">
                        <i class="fas fa-times"></i> Kembalikan (Revisi)
                    </button>
                    <button type="submit" class="btn-action btn-approve">
                        <i class="fas fa-check"></i> Setujui Draft
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Log Section --}}
    @if(isset($draft->approvalLogs) && count($draft->approvalLogs))
        <div class="log-section">
            <div class="log-header">
                <i class="fas fa-history"></i>
                <h4>Riwayat Approval</h4>
            </div>
            <div class="log-body">
                <div class="log-timeline">
                    @foreach($draft->approvalLogs as $log)
                        <div class="log-item">
                            <span class="log-role">{{ ucfirst($log->approver_role) }}</span>
                            <div class="log-action">
                                {{ ucfirst($log->action) }} draft 
                                <span class="arrow">→</span>
                                <strong>{{ $log->status_from }}</strong> 
                                <span class="arrow">→</span>
                                <strong>{{ $log->status_to }}</strong>
                            </div>
                            <div class="log-date">
                                <i class="fas fa-clock"></i>
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </div>
                            @if($log->catatan)
                                <div class="log-catatan">
                                    <i class="fas fa-quote-left" style="margin-right: 6px; opacity: 0.5;"></i>
                                    {{ $log->catatan }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Reject Modal --}}
<div class="modal-overlay" id="rejectModal">
    <div class="modal-content">
        <div class="modal-icon warning">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 class="modal-title">Kembalikan Draft?</h3>
        <p class="modal-message">
            Draft akan dikembalikan ke Prodi untuk direvisi. Pastikan Anda sudah menambahkan catatan 
            revisi yang diperlukan.
        </p>
        <div class="modal-buttons">
            <button class="modal-btn cancel" onclick="closeRejectModal()">Batal</button>
            <form method="POST" action="{{ route('pusat.verifikasi.reject', $draft->id) }}" style="margin: 0;">
                @csrf
                <input type="hidden" name="catatan" id="rejectCatatan">
                <button type="submit" class="modal-btn confirm">
                    <i class="fas fa-undo"></i> Ya, Kembalikan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openRejectModal() {
    // Copy catatan to hidden field
    document.getElementById('rejectCatatan').value = document.getElementById('catatan').value;
    document.getElementById('rejectModal').classList.add('show');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.remove('show');
}

// Close modal on overlay click
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
    }
});
</script>
@endpush
