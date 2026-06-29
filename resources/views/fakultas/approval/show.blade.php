@extends('fakultas.layouts.app')
@section('title', 'Review Draft SKPI')
@section('page_title', 'Review Draft SKPI')

@push('styles')
<style>
    /* ============ REVIEW PAGE - PURPLE THEME ============ */
    
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
    
    .header-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-header {
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-header.back {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        backdrop-filter: blur(4px);
    }
    
    .btn-header:hover {
        transform: translateY(-2px);
    }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
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
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    
    .card-header-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .card-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .card-body {
        padding: 24px;
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .info-item.full {
        grid-column: span 2;
    }
    
    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    
    .info-value.highlight {
        color: #7c3aed;
        font-family: 'Courier New', monospace;
        background: #f3e8ff;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #15803d; }
    
    /* Profile Card */
    .profile-card {
        text-align: center;
        padding: 32px 24px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        margin: 0 auto 16px;
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
    }
    
    .profile-name {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .profile-nim {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 16px;
    }
    
    .profile-prodi {
        font-size: 13px;
        color: #7c3aed;
        background: #f3e8ff;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }
    
    /* Bilingual Summary */
    .bilingual-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .bilingual-card {
        padding: 16px;
        border-radius: 12px;
        background: #f8fafc;
    }
    
    .bilingual-card.id {
        border-left: 4px solid #dc2626;
    }
    
    .bilingual-card.en {
        border-left: 4px solid #1e40af;
    }
    
    .bilingual-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .bilingual-card.id .bilingual-header { color: #dc2626; }
    .bilingual-card.en .bilingual-header { color: #1e40af; }
    
    .bilingual-text {
        font-size: 13px;
        color: #374151;
        line-height: 1.6;
    }
    
    /* Action Buttons */
    .action-section {
        padding: 24px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }
    
    .action-buttons {
        display: flex;
        gap: 12px;
    }
    
    .btn-approve {
        flex: 1;
        padding: 14px 24px;
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    
    .btn-revisi {
        flex: 1;
        padding: 14px 24px;
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-revisi:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }
    
    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    
    .modal-overlay.active {
        display: flex;
    }
    
    .modal-content {
        background: #fff;
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    
    .modal-header {
        padding: 24px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        border-bottom: 1px solid #f1f5f9;
    }
    
    .modal-header h4 {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-body label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .modal-body textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        resize: vertical;
        min-height: 120px;
    }
    
    .modal-body textarea:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
    
    .modal-footer {
        padding: 16px 24px;
        background: #f8fafc;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }
    
    .btn-modal {
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-modal.cancel {
        background: #e5e7eb;
        color: #374151;
    }
    
    .btn-modal.confirm {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
    }
    
    /* ============ RESULT MODAL WITH ANIMATION ============ */
    .result-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    }
    
    .result-modal-overlay.active {
        display: flex;
    }
    
    .result-modal-content {
        background: #fff;
        border-radius: 24px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        padding: 48px 32px;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
        animation: scaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    /* Icon Container */
    .result-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .result-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
    }
    
    .result-icon.error {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        box-shadow: 0 10px 40px rgba(239, 68, 68, 0.4);
    }
    
    .result-icon i {
        font-size: 48px;
        color: #fff;
        animation: iconBounce 0.6s ease-out 0.2s both;
    }
    
    /* Circle Animation */
    .result-icon::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 3px solid transparent;
        animation: circleGrow 0.6s ease-out both;
    }
    
    .result-icon.success::before {
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .result-icon.error::before {
        border-color: rgba(239, 68, 68, 0.3);
    }
    
    .result-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 12px;
        animation: slideUp 0.4s ease-out 0.3s both;
    }
    
    .result-title.success {
        color: #10b981;
    }
    
    .result-title.error {
        color: #ef4444;
    }
    
    .result-message {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 28px;
        animation: slideUp 0.4s ease-out 0.4s both;
    }
    
    .result-btn {
        padding: 14px 32px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        animation: slideUp 0.4s ease-out 0.5s both;
    }
    
    .result-btn.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    .result-btn.success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    }
    
    .result-btn.error {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    .result-btn.error:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.4);
    }
    
    /* Keyframes */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes iconBounce {
        0% {
            opacity: 0;
            transform: scale(0);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes circleGrow {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
        
        .bilingual-section {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .info-item.full {
            grid-column: span 1;
        }
        
        .action-buttons {
            flex-direction: column;
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
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div>
                    <h1>Review Draft SKPI</h1>
                    <p>Verifikasi dan setujui pengajuan SKPI mahasiswa</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('fakultas.verifikasi.index') }}" class="btn-header back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
    
    {{-- Session alerts now handled by animated modals in JavaScript --}}
    <div class="content-grid">
        {{-- Left Column --}}
        <div>
            {{-- Data SKPI --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3>Informasi Draft SKPI</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nomor SKPI</span>
                            <span class="info-value highlight">{{ $draft->nomor_skpi ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tahun Lulus</span>
                            <span class="info-value">{{ $draft->tahun_lulus ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status Saat Ini</span>
                            <span class="status-badge pending">
                                <i class="fas fa-clock"></i> {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Pengajuan</span>
                            <span class="info-value">{{ $draft->created_at ? $draft->created_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                        @if($draft->catatan)
                        <div class="info-item full">
                            <span class="info-label">Catatan</span>
                            <span class="info-value">{{ $draft->catatan }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Ringkasan Bilingual --}}
            @if($draft->ringkasan_id || $draft->ringkasan_en)
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <h3>Ringkasan Bilingual</h3>
                </div>
                <div class="card-body">
                    <div class="bilingual-section">
                        <div class="bilingual-card id">
                            <div class="bilingual-header">
                                <i class="fas fa-flag"></i> Bahasa Indonesia
                            </div>
                            <div class="bilingual-text">
                                {{ $draft->ringkasan_id ?? 'Belum diisi' }}
                            </div>
                        </div>
                        <div class="bilingual-card en">
                            <div class="bilingual-header">
                                <i class="fas fa-globe"></i> English
                            </div>
                            <div class="bilingual-text">
                                {{ $draft->ringkasan_en ?? 'Not filled yet' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        {{-- Right Column --}}
        <div>
            {{-- Profile Card --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Data Mahasiswa</h3>
                </div>
                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($draft->mahasiswa->nama ?? 'M', 0, 1)) }}
                    </div>
                    <div class="profile-name">{{ $draft->mahasiswa->nama ?? '-' }}</div>
                    <div class="profile-nim">{{ $draft->mahasiswa->nim ?? '-' }}</div>
                    <div class="profile-prodi">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}
                    </div>
                </div>
            </div>
            
            {{-- Action Card --}}
            @if(in_array($draft->status, ['valid_fakultas', 'revisi_pusat_bahasa']))
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h3>Keputusan Verifikasi</h3>
                </div>
                <div class="action-section">
                    <div class="action-buttons">
                        <button type="button" class="btn-approve" onclick="openApproveModal()">
                            <i class="fas fa-check"></i> Approve & Terbitkan
                        </button>
                        <button type="button" class="btn-revisi" onclick="openRevisiModal()">
                            <i class="fas fa-undo"></i> Revisi
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    {{-- Approve Modal --}}
    <div class="modal-overlay" id="approveModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-check-circle" style="color: #10b981;"></i> Konfirmasi Persetujuan</h4>
            </div>
            <form action="{{ route('fakultas.approval.update', $draft->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="aksi" value="approve">
                <div class="modal-body">
                    <p style="margin-bottom: 16px; color: #374151;">
                        Anda akan menyetujui dan menerbitkan SKPI untuk mahasiswa:
                    </p>
                    <p style="font-weight: 700; color: #111827; font-size: 16px; margin-bottom: 16px;">
                        {{ $draft->mahasiswa->nama ?? '-' }} ({{ $draft->mahasiswa->nim ?? '-' }})
                    </p>
                    <label>Catatan (opsional)</label>
                    <textarea name="catatan" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal cancel" onclick="closeApproveModal()">Batal</button>
                    <button type="submit" class="btn-modal confirm" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%);">
                        <i class="fas fa-check"></i> Ya, Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Revisi Modal --}}
    <div class="modal-overlay" id="revisiModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-undo" style="color: #ef4444;"></i> Kembalikan untuk Revisi</h4>
            </div>
            <form action="{{ route('fakultas.approval.update', $draft->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="aksi" value="revisi">
                <div class="modal-body">
                    <p style="margin-bottom: 16px; color: #374151;">
                        Draft akan dikembalikan ke Pusat Bahasa untuk revisi.
                    </p>
                    <label>Alasan Revisi <span style="color: #ef4444;">*</span></label>
                    <textarea name="catatan" placeholder="Jelaskan alasan pengembalian untuk revisi..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal cancel" onclick="closeRevisiModal()">Batal</button>
                    <button type="submit" class="btn-modal confirm" style="background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);">
                        <i class="fas fa-undo"></i> Kembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Success Result Modal --}}
    <div class="result-modal-overlay" id="successModal">
        <div class="result-modal-content">
            <div class="result-icon success">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="result-title success">Berhasil!</h3>
            <p class="result-message" id="successMessage">Aksi berhasil dilakukan.</p>
            <button class="result-btn success" onclick="closeSuccessModal()">
                <i class="fas fa-arrow-right"></i> Lanjutkan
            </button>
        </div>
    </div>
    
    {{-- Error Result Modal --}}
    <div class="result-modal-overlay" id="errorModal">
        <div class="result-modal-content">
            <div class="result-icon error">
                <i class="fas fa-times"></i>
            </div>
            <h3 class="result-title error">Gagal!</h3>
            <p class="result-message" id="errorMessage">Terjadi kesalahan.</p>
            <button class="result-btn error" onclick="closeErrorModal()">
                <i class="fas fa-redo"></i> Coba Lagi
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Session Flash Data -->
<div id="sessionFlashData"
    data-success="{{ session('success') }}"
    data-error="{{ session('error') }}"
    style="display: none;"></div>

<script>
    function openApproveModal() {
        document.getElementById('approveModal').classList.add('active');
    }
    
    function closeApproveModal() {
        document.getElementById('approveModal').classList.remove('active');
    }
    
    function openRevisiModal() {
        document.getElementById('revisiModal').classList.add('active');
    }
    
    function closeRevisiModal() {
        document.getElementById('revisiModal').classList.remove('active');
    }
    
    // Result Modal Functions
    function showSuccessModal(message) {
        document.getElementById('successMessage').textContent = message;
        document.getElementById('successModal').classList.add('active');
    }
    
    function closeSuccessModal() {
        document.getElementById('successModal').classList.remove('active');
        // Redirect to index after closing
        window.location.href = '{{ route("fakultas.approval.index") }}';
    }
    
    function showErrorModal(message) {
        document.getElementById('errorMessage').textContent = message;
        document.getElementById('errorModal').classList.add('active');
    }
    
    function closeErrorModal() {
        document.getElementById('errorModal').classList.remove('active');
    }
    
    // Check for session flash messages on page load
    document.addEventListener('DOMContentLoaded', function() {
        const flashData = document.getElementById('sessionFlashData');
        if (!flashData) return;

        const success = flashData.getAttribute('data-success');
        const error = flashData.getAttribute('data-error');

        if (success) {
            showSuccessModal(success);
        }
        if (error) {
            showErrorModal(error);
        }
    });
    
    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });
    
    // Close result modal on overlay click
    document.querySelectorAll('.result-modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                if (this.id === 'successModal') {
                    closeSuccessModal();
                } else {
                    closeErrorModal();
                }
            }
        });
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.classList.remove('active');
            });
            // Also handle result modals
            if (document.getElementById('successModal').classList.contains('active')) {
                closeSuccessModal();
            }
            document.getElementById('errorModal').classList.remove('active');
        }
    });
</script>
@endpush
