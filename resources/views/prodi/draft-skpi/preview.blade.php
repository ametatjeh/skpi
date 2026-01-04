@extends('prodi.layouts.app')

@section('title', 'Preview Draft SKPI')

@section('content')
<style>
    /* ============ PREMIUM PREVIEW SKPI STYLES ============ */
    .preview-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 24px;
    }
    
    /* Header Section */
    .preview-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding: 24px 28px;
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-radius: 20px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(30, 64, 175, 0.25);
    }
    
    .preview-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .preview-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .preview-title {
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 4px;
    }
    
    .preview-subtitle {
        font-size: 14px;
        opacity: 0.9;
    }
    
    /* Status Badge */
    .status-badge {
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-badge.pending {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    
    .status-badge.submitted {
        background: #dcfce7;
        color: #15803d;
    }
    
    .status-badge.final {
        background: #dbeafe;
        color: #1e40af;
    }
    
    /* Action Buttons */
    .action-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-edit {
        background: #fff;
        color: #1e40af;
        border: 2px solid #dbeafe;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    
    .btn-edit:hover {
        background: #eff6ff;
        border-color: #3b82f6;
        transform: translateY(-2px);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35);
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(124, 58, 237, 0.45);
    }
    
    .btn-download {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.35);
    }
    
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(16, 185, 129, 0.45);
    }
    
    /* Alert Box */
    .alert-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .alert-box.success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .alert-box.info {
        background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
        color: #7c3aed;
        border: 1px solid #c4b5fd;
    }
    
    .alert-box.warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #fcd34d;
    }
    
    .alert-box i {
        font-size: 20px;
    }
    
    /* Main Card */
    .skpi-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .skpi-card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 20px 28px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .skpi-card-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .skpi-card-header-text {
        flex: 1;
    }
    
    .skpi-card-header-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .skpi-card-header-subtitle {
        font-size: 13px;
        color: #6b7280;
    }
    
    .skpi-card-body {
        padding: 28px;
    }
    
    /* Section Styles */
    .section-block {
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px dashed #e5e7eb;
    }
    
    .section-block:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
    }
    
    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(180deg, #1e40af, #3b82f6);
        border-radius: 2px;
    }
    
    .section-title i {
        color: #1e40af;
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .info-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .info-value {
        font-size: 15px;
        color: #111827;
        font-weight: 600;
    }
    
    /* Content Text */
    .content-text {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.7;
        background: #f8fafc;
        padding: 16px 20px;
        border-radius: 12px;
        border-left: 4px solid #3b82f6;
    }
    
    /* Achievement List */
    .achievement-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .achievement-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    
    .achievement-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateX(4px);
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
    
    .achievement-icon.cert { background: #dcfce7; color: #15803d; }
    .achievement-icon.trophy { background: #fef3c7; color: #92400e; }
    .achievement-icon.org { background: #dbeafe; color: #1e40af; }
    .achievement-icon.pkm { background: #f3e8ff; color: #7c3aed; }
    
    .achievement-content {
        flex: 1;
    }
    
    .achievement-name {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }
    
    .achievement-type {
        font-size: 12px;
        color: #6b7280;
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
        padding: 32px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 40px;
        margin-bottom: 12px;
        opacity: 0.5;
    }
    
    /* Flow Indicator */
    .flow-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 16px 20px;
        background: linear-gradient(135deg, #f3e8ff 0%, #ede9fe 100%);
        border-radius: 12px;
        margin-bottom: 24px;
    }
    
    .flow-step {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
    }
    
    .flow-step.active {
        color: #7c3aed;
    }
    
    .flow-step.completed {
        color: #10b981;
    }
    
    .flow-step.pending {
        color: #9ca3af;
    }
    
    .flow-step i.check {
        color: #10b981;
    }
    
    .flow-arrow {
        color: #c4b5fd;
    }
    
    /* Custom Modal Styles */
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
        border-radius: 24px;
        padding: 40px;
        max-width: 420px;
        width: 90%;
        text-align: center;
        transform: scale(0.8);
        transition: transform 0.3s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1);
    }
    
    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 36px;
    }
    
    .modal-icon.confirm {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
    }
    
    .modal-icon.loading {
        background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        color: #fff;
    }
    
    .modal-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    .modal-icon.error {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }
    
    .modal-message {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 28px;
    }
    
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    
    .modal-btn {
        padding: 12px 28px;
        border-radius: 12px;
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
    
    .modal-btn.confirm {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
    }
    
    .modal-btn.confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }
    
    .modal-btn.success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: #fff;
    }
    
    /* Loading Spinner */
    .spinner {
        width: 36px;
        height: 36px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Success Checkmark Animation */
    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #fff;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }
    
    .checkmark {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: block;
        stroke-width: 4;
        stroke: #fff;
        stroke-miterlimit: 10;
    }
    
    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.4s forwards;
    }
    
    @keyframes stroke {
        100% { stroke-dashoffset: 0; }
    }
    
    /* Error X Animation */
    .error-x {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke-width: 4;
        stroke: #fff;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.2s forwards;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .preview-header {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }
        
        .preview-header-left {
            flex-direction: column;
        }
        
        .action-bar {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
            justify-content: center;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .flow-indicator {
            flex-direction: column;
            gap: 12px;
        }
        
        .modal-content {
            padding: 30px 24px;
        }
        
        .modal-buttons {
            flex-direction: column;
        }
        
        .modal-btn {
            width: 100%;
        }
    }
</style>

<div class="preview-container">
    {{-- Header --}}
    <div class="preview-header">
        <div class="preview-header-left">
            <div class="preview-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div>
                <div class="preview-title">Preview Draft SKPI</div>
                <div class="preview-subtitle">{{ $skpi->mahasiswa->nama ?? '-' }} - {{ $skpi->mahasiswa->nim ?? '-' }}</div>
            </div>
        </div>
        
        @php
            $statusLabel = match($skpi->status) {
                'valid_prodi' => 'Siap Kirim',
                'valid_pusat_bahasa' => 'Di Pusat Bahasa',
                'valid_fakultas' => 'Di Fakultas',
                'final_issued' => 'Final',
                default => ucfirst(str_replace('_', ' ', $skpi->status))
            };
            $statusClass = match($skpi->status) {
                'valid_prodi' => 'pending',
                'valid_pusat_bahasa', 'valid_fakultas' => 'submitted',
                'final_issued' => 'final',
                default => 'pending'
            };
        @endphp
        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
    </div>
    
    {{-- Flow Indicator --}}
    <div class="flow-indicator">
        <div class="flow-step completed">
            <i class="fas fa-check-circle check"></i> Prodi
        </div>
        <i class="fas fa-arrow-right flow-arrow"></i>
        <div class="flow-step {{ $skpi->status == 'valid_prodi' ? 'active' : ($skpi->status == 'valid_pusat_bahasa' ? 'active' : 'completed') }}">
            <i class="fas fa-{{ $skpi->status == 'valid_prodi' ? 'circle' : 'check-circle check' }}"></i> Pusat Bahasa
        </div>
        <i class="fas fa-arrow-right flow-arrow"></i>
        <div class="flow-step {{ in_array($skpi->status, ['valid_fakultas', 'final_issued']) ? 'completed' : 'pending' }}">
            <i class="fas fa-{{ in_array($skpi->status, ['valid_fakultas', 'final_issued']) ? 'check-circle check' : 'circle' }}"></i> Fakultas
        </div>
        <i class="fas fa-arrow-right flow-arrow"></i>
        <div class="flow-step {{ $skpi->status == 'final_issued' ? 'completed' : 'pending' }}">
            <i class="fas fa-{{ $skpi->status == 'final_issued' ? 'check-circle check' : 'circle' }}"></i> Final
        </div>
    </div>
    
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert-box success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('warning'))
        <div class="alert-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('warning') }}
        </div>
    @endif
    
    {{-- Action Buttons --}}
    <div class="action-bar">
        @if($skpi->status === 'valid_prodi')
            <a href="{{ route('prodi.draft-skpi.edit', $skpi->id) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Edit Draft
            </a>
            
            <button type="button" class="btn-action btn-submit" onclick="showConfirmModal()">
                <i class="fas fa-paper-plane"></i> Teruskan ke Pusat Bahasa
            </button>
            
            <form id="submitForm" action="{{ route('prodi.draft-skpi.submit_fakultas', $skpi->id) }}" method="POST" style="display:none;">
                @csrf
            </form>
        @elseif($skpi->status === 'valid_pusat_bahasa')
            <div class="alert-box info">
                <i class="fas fa-hourglass-half"></i>
                Draft sedang diproses oleh Pusat Bahasa. Silakan tunggu verifikasi bilingual.
            </div>
        @elseif($skpi->status === 'valid_fakultas')
            <div class="alert-box info">
                <i class="fas fa-university"></i>
                Draft sudah diteruskan ke Fakultas untuk persetujuan final.
            </div>
        @elseif($skpi->status === 'final_issued')
            <div class="alert-box success">
                <i class="fas fa-check-double"></i>
                SKPI sudah diterbitkan dan bersifat final.
            </div>
            
            <a href="{{ route('prodi.draft-skpi.generate-pdf', $skpi->id) }}" class="btn-action btn-download">
                <i class="fas fa-download"></i> Download PDF
            </a>
        @endif
    </div>
    
    {{-- Main Content Card --}}
    <div class="skpi-card">
        <div class="skpi-card-header">
            <i class="fas fa-id-card"></i>
            <div class="skpi-card-header-text">
                <div class="skpi-card-header-title">Dokumen SKPI</div>
                <div class="skpi-card-header-subtitle">Surat Keterangan Pendamping Ijazah</div>
            </div>
        </div>
        
        <div class="skpi-card-body">
            {{-- Section A: Identitas --}}
            <div class="section-block">
                <div class="section-title">
                    <i class="fas fa-user"></i>
                    A. Identitas Mahasiswa
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $skpi->mahasiswa->nama ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">NIM</span>
                        <span class="info-value">{{ $skpi->mahasiswa->nim ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Program Studi</span>
                        <span class="info-value">{{ $skpi->mahasiswa->prodi->nama_prodi ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tahun Lulus</span>
                        <span class="info-value">{{ $skpi->tahun_lulus ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor SKPI</span>
                        <span class="info-value">{{ $skpi->nomor_skpi ?? 'Belum ditetapkan' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Pengesahan</span>
                        <span class="info-value">{{ $skpi->tanggal_pengesahan ? $skpi->tanggal_pengesahan->format('d F Y') : 'Belum disahkan' }}</span>
                    </div>
                </div>
            </div>
            
            {{-- Section B: CPL --}}
            <div class="section-block">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    B. Capaian Pembelajaran Lulusan
                </div>
                
                <div class="content-text">
                    <p style="margin: 0;">
                        Capaian Pembelajaran Lulusan (CPL) Program Studi akan ditampilkan di sini mencakup aspek:
                    </p>
                    <ul style="margin: 12px 0 0 20px; padding: 0;">
                        <li><strong>Sikap</strong> - Nilai moral dan etika</li>
                        <li><strong>Pengetahuan</strong> - Pemahaman teoritis</li>
                        <li><strong>Keterampilan Umum</strong> - Kemampuan generik</li>
                        <li><strong>Keterampilan Khusus</strong> - Kompetensi bidang</li>
                    </ul>
                </div>
            </div>
            
            {{-- Section C: Aktivitas & Prestasi --}}
            <div class="section-block">
                <div class="section-title">
                    <i class="fas fa-trophy"></i>
                    C. Aktivitas, Prestasi, dan Penghargaan
                </div>
                
                @php
                    $verifikasiSkpi = \App\Models\VerifikasiSkpi::with('verifiable')
                        ->where('mahasiswa_id', $skpi->mahasiswa_id)
                        ->whereIn('status', ['approved', 'included_in_summary'])
                        ->get();
                @endphp
                
                @if($verifikasiSkpi->count() > 0)
                    <div class="achievement-list">
                        @foreach($verifikasiSkpi as $item)
                            @php
                                $iconClass = match($item->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'cert',
                                    'App\Models\Prestasi' => 'trophy',
                                    'App\Models\Organisasi' => 'org',
                                    default => 'pkm'
                                };
                                $iconName = match($item->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'fa-certificate',
                                    'App\Models\Prestasi' => 'fa-trophy',
                                    'App\Models\Organisasi' => 'fa-users',
                                    'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
                                    'App\Models\KaryaIlmiah' => 'fa-book',
                                    default => 'fa-award'
                                };
                            @endphp
                            <div class="achievement-item">
                                <div class="achievement-icon {{ $iconClass }}">
                                    <i class="fas {{ $iconName }}"></i>
                                </div>
                                <div class="achievement-content">
                                    <div class="achievement-name">{{ $item->achievement_name }}</div>
                                    <div class="achievement-type">{{ $item->achievement_type_display }}</div>
                                </div>
                                <span class="achievement-badge">Verified</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada kegiatan yang terverifikasi.</p>
                    </div>
                @endif
            </div>
            
            {{-- Catatan --}}
            @if($skpi->catatan)
            <div class="section-block">
                <div class="section-title">
                    <i class="fas fa-sticky-note"></i>
                    Catatan
                </div>
                <div class="content-text">
                    {{ $skpi->catatan }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Custom Modal --}}
<div class="modal-overlay" id="confirmModal">
    <div class="modal-content">
        <div class="modal-icon confirm" id="modalIcon">
            <i class="fas fa-paper-plane"></i>
        </div>
        <h3 class="modal-title" id="modalTitle">Teruskan ke Pusat Bahasa?</h3>
        <p class="modal-message" id="modalMessage">
            Draft SKPI akan dikirim ke Pusat Bahasa untuk verifikasi bilingual. 
            Setelah diverifikasi, draft akan diteruskan ke Fakultas untuk pengesahan final.
        </p>
        <div class="modal-buttons" id="modalButtons">
            <button class="modal-btn cancel" onclick="hideModal()">Batal</button>
            <button class="modal-btn confirm" onclick="submitForm()">
                <i class="fas fa-paper-plane"></i> Ya, Teruskan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showConfirmModal() {
    document.getElementById('confirmModal').classList.add('show');
}

function hideModal() {
    document.getElementById('confirmModal').classList.remove('show');
}

function submitForm() {
    const modal = document.getElementById('confirmModal');
    const icon = document.getElementById('modalIcon');
    const title = document.getElementById('modalTitle');
    const message = document.getElementById('modalMessage');
    const buttons = document.getElementById('modalButtons');
    
    // Show loading state
    icon.className = 'modal-icon loading';
    icon.innerHTML = '<div class="spinner"></div>';
    title.textContent = 'Mengirim...';
    message.textContent = 'Sedang memproses pengiriman draft SKPI ke Pusat Bahasa.';
    buttons.style.display = 'none';
    
    // Submit form via AJAX
    const form = document.getElementById('submitForm');
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (response.redirected) {
            // Success - show success animation then redirect
            showSuccess();
            setTimeout(() => {
                window.location.href = response.url;
            }, 1500);
        } else if (response.ok) {
            showSuccess();
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            throw new Error('Gagal mengirim');
        }
    })
    .catch(error => {
        showError(error.message || 'Terjadi kesalahan');
    });
}

function showSuccess() {
    const icon = document.getElementById('modalIcon');
    const title = document.getElementById('modalTitle');
    const message = document.getElementById('modalMessage');
    const buttons = document.getElementById('modalButtons');
    
    icon.className = 'modal-icon success';
    icon.innerHTML = `
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    `;
    title.textContent = 'Berhasil!';
    message.textContent = 'Draft SKPI berhasil diteruskan ke Pusat Bahasa.';
    buttons.innerHTML = '<button class="modal-btn success" onclick="window.location.reload()">OK</button>';
    buttons.style.display = 'flex';
}

function showError(errorMessage) {
    const icon = document.getElementById('modalIcon');
    const title = document.getElementById('modalTitle');
    const message = document.getElementById('modalMessage');
    const buttons = document.getElementById('modalButtons');
    
    icon.className = 'modal-icon error';
    icon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="56" height="56">
            <circle cx="26" cy="26" r="25" fill="none" stroke="#fff" stroke-width="2"/>
            <path class="error-x" fill="none" stroke="#fff" d="M16 16 L36 36"/>
            <path class="error-x" fill="none" stroke="#fff" d="M36 16 L16 36"/>
        </svg>
    `;
    title.textContent = 'Gagal!';
    message.textContent = errorMessage || 'Terjadi kesalahan saat mengirim draft SKPI.';
    buttons.innerHTML = `
        <button class="modal-btn cancel" onclick="hideModal()">Tutup</button>
        <button class="modal-btn confirm" onclick="submitForm()">Coba Lagi</button>
    `;
    buttons.style.display = 'flex';
}

// Close modal on overlay click
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideModal();
    }
});
</script>
@endpush
