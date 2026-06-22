@extends('prodi.layouts.app')

@section('title', 'Detail Verifikasi SKPI')

@section('content')
<style>
    /* ============ DETAIL VERIFIKASI PREMIUM STYLES ============ */
    .detail-container {
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
        gap: 4px;
        transition: color 0.2s;
    }
    
    .breadcrumb a:hover {
        color: #0891b2;
    }
    
    .breadcrumb-separator {
        color: #d1d5db;
    }
    
    .breadcrumb-current {
        color: #111827;
        font-weight: 600;
    }
    
    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .header-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .header-avatar {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
    }
    
    .header-text h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }
    
    .header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .header-badges {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
    }
    
    .status-badge {
        padding: 8px 18px;
        border-radius: 24px;
        font-size: 13px;
        font-weight: 700;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.revision { background: #f3e8ff; color: #7c3aed; }
    
    .sla-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .sla-badge.safe { background: rgba(255, 255, 255, 0.2); color: #fff; }
    .sla-badge.overdue { background: #fee2e2; color: #b91c1c; }
    
    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    
    /* Cards */
    .card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 16px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .card-header i {
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
    
    .card-header h3 {
        font-size: 16px;
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
        gap: 4px;
    }
    
    .info-item.full {
        grid-column: span 2;
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
    
    /* Achievement Type Badge */
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .type-badge.sertifikasi { background: #dcfce7; color: #15803d; }
    .type-badge.prestasi { background: #fef3c7; color: #92400e; }
    .type-badge.organisasi { background: #dbeafe; color: #1e40af; }
    .type-badge.pkm { background: #f3e8ff; color: #7c3aed; }
    .type-badge.karya { background: #fce7f3; color: #be185d; }
    .type-badge.penghargaan { background: #ffedd5; color: #ea580c; }
    
    /* Document Section */
    .document-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    
    .document-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .document-info {
        flex: 1;
    }
    
    .document-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }
    
    .document-info p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    .btn-download {
        padding: 8px 16px;
        background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
        color: #fff;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
    }
    
    .document-preview {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #e5e7eb;
    }
    
    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    .timeline-icon {
        position: absolute;
        left: -30px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #fff;
    }
    
    .timeline-icon.approve { background: #06b6d4; }
    .timeline-icon.reject { background: #ef4444; }
    .timeline-icon.revision { background: #f59e0b; }
    
    .timeline-content {
        background: #f8fafc;
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    
    .timeline-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .timeline-action {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
    }
    
    .timeline-date {
        font-size: 12px;
        color: #6b7280;
    }
    
    .timeline-note {
        font-size: 13px;
        color: #4b5563;
        margin: 0;
    }
    
    /* Action Buttons */
    .action-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        margin-bottom: 24px;
    }
    
    .action-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-action {
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-approve {
        background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
        color: #fff;
    }
    
    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
    }
    
    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
    }
    
    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
    }
    
    .btn-revision {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #fff;
    }
    
    .btn-revision:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);
    }
    
    .textarea-catatan {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        resize: vertical;
        min-height: 80px;
        margin-bottom: 12px;
    }
    
    .textarea-catatan:focus {
        outline: none;
        border-color: #0891b2;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
    }
    
    /* Draft Eligibility */
    .eligibility-card {
        padding: 20px;
        border-radius: 12px;
        margin-top: 16px;
    }
    
    .eligibility-card.eligible {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border: 1px solid #86efac;
    }
    
    .eligibility-card.not-eligible {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border: 1px solid #fcd34d;
    }
    
    .eligibility-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .eligibility-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .eligibility-card.eligible .eligibility-icon {
        background: #15803d;
        color: #fff;
    }
    
    .eligibility-card.not-eligible .eligibility-icon {
        background: #92400e;
        color: #fff;
    }
    
    .eligibility-text h4 {
        font-size: 14px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }
    
    .eligibility-card.eligible .eligibility-text h4 { color: #15803d; }
    .eligibility-card.not-eligible .eligibility-text h4 { color: #92400e; }
    
    .eligibility-text p {
        font-size: 13px;
        margin: 0;
        color: #374151;
    }
    
    .btn-create-draft {
        margin-top: 12px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .btn-create-draft:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }
    
    /* No Document */
    .no-document {
        text-align: center;
        padding: 32px 20px;
        color: #9ca3af;
    }
    
    .no-document i {
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
        .header-card {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-badges {
            align-items: flex-start;
            flex-direction: row;
            flex-wrap: wrap;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .info-item.full {
            grid-column: span 1;
        }
        
        .document-item {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="detail-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('prodi.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('prodi.verifikasi.index') }}"><i class="fas fa-check-double"></i> Verifikasi</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ $mahasiswa->nama ?? 'Detail' }}</span>
    </div>
    
    {{-- Header Card --}}
    @php
        $statusClass = match($verifikasi->status) {
            'pending' => 'pending',
            'approved' => 'approved',
            'rejected' => 'rejected',
            'revision_required' => 'revision',
            default => 'pending'
        };
        $statusLabel = match($verifikasi->status) {
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'revision_required' => 'Perlu Revisi',
            default => ucfirst($verifikasi->status)
        };
    @endphp
    
    <div class="header-card">
        <div class="header-info">
            <div class="header-avatar">
                {{ strtoupper(substr($mahasiswa->nama ?? 'M', 0, 2)) }}
            </div>
            <div class="header-text">
                <h1>{{ $mahasiswa->nama ?? '-' }}</h1>
                <p>
                    <i class="fas fa-id-card"></i> {{ $mahasiswa->nim ?? '-' }}
                    <span style="opacity: 0.5;">•</span>
                    {{ $mahasiswa->prodi->nama_prodi ?? 'Program Studi' }}
                </p>
            </div>
        </div>
        
        <div class="header-badges">
            <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
            <span class="sla-badge {{ $slaStatus }}">
                <i class="fas fa-clock"></i>
                @if($slaStatus == 'safe')
                    {{ abs($slaRemaining) }} hari tersisa
                @else
                    {{ abs($slaRemaining) }} hari terlewat
                @endif
            </span>
        </div>
    </div>
    
    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Left Column --}}
        <div>
            {{-- Achievement Detail --}}
            <div class="card" style="margin-bottom: 24px;">
                <div class="card-header">
                    <i class="fas fa-trophy"></i>
                    <h3>Detail Achievement</h3>
                </div>
                <div class="card-body">
                    @php 
                        $a = $achievement ?? $verifikasi->verifiable;
                        $typeClass = match($verifikasi->verifiable_type) {
                            'App\Models\SertifikasiKompetensi' => 'sertifikasi',
                            'App\Models\Prestasi' => 'prestasi',
                            'App\Models\Organisasi' => 'organisasi',
                            'App\Models\PengabdianMasyarakat' => 'pkm',
                            'App\Models\KaryaIlmiah' => 'karya',
                            'App\Models\Penghargaan' => 'penghargaan',
                            default => 'sertifikasi'
                        };
                        $typeIcon = match($verifikasi->verifiable_type) {
                            'App\Models\SertifikasiKompetensi' => 'fa-certificate',
                            'App\Models\Prestasi' => 'fa-trophy',
                            'App\Models\Organisasi' => 'fa-users',
                            'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
                            'App\Models\KaryaIlmiah' => 'fa-book',
                            'App\Models\Penghargaan' => 'fa-award',
                            default => 'fa-star'
                        };
                        $typeName = match($verifikasi->verifiable_type) {
                            'App\Models\SertifikasiKompetensi' => 'Sertifikasi Kompetensi',
                            'App\Models\Prestasi' => 'Prestasi',
                            'App\Models\Organisasi' => 'Organisasi',
                            'App\Models\PengabdianMasyarakat' => 'Pengabdian Masyarakat',
                            'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                            'App\Models\Penghargaan' => 'Penghargaan',
                            default => 'Achievement'
                        };
                    @endphp
                    
                    <div style="margin-bottom: 20px;">
                        <span class="type-badge {{ $typeClass }}">
                            <i class="fas {{ $typeIcon }}"></i>
                            {{ $typeName }}
                        </span>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item full">
                            <span class="info-label">Nama / Judul</span>
                            <span class="info-value">
                                {{ $a->nama_sertifikasi ?? ($a->judul_prestasi ?? ($a->nama_organisasi ?? ($a->judul_pkm ?? ($a->judul_karya ?? ($a->nama_penghargaan ?? '-'))))) }}
                            </span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Tahun</span>
                            <span class="info-value">{{ $a->tahun ?? ($a->tahun_prestasi ?? ($a->tanggal_penerbit ?? '-')) }}</span>
                        </div>
                        
                        @if($a->tingkat ?? $a->level ?? false)
                        <div class="info-item">
                            <span class="info-label">Tingkat</span>
                            <span class="info-value">{{ $a->tingkat ?? ($a->level ?? '-') }}</span>
                        </div>
                        @endif
                        
                        @if($a->penyelenggara ?? false)
                        <div class="info-item">
                            <span class="info-label">Penyelenggara</span>
                            <span class="info-value">{{ $a->penyelenggara }}</span>
                        </div>
                        @endif
                        
                        @if($a->jabatan ?? $a->posisi ?? false)
                        <div class="info-item">
                            <span class="info-label">Jabatan / Posisi</span>
                            <span class="info-value">{{ $a->jabatan ?? ($a->posisi ?? '-') }}</span>
                        </div>
                        @endif
                        
                        <div class="info-item full">
                            <span class="info-label">Deskripsi</span>
                            <span class="info-value">{{ $a->deskripsi ?? ($a->keterangan ?? 'Tidak ada deskripsi') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Dokumen Pendukung --}}
            <div class="card" style="margin-bottom: 24px;">
                <div class="card-header">
                    <i class="fas fa-paperclip"></i>
                    <h3>Dokumen Pendukung</h3>
                </div>
                <div class="card-body">
                    @php $dok_file = $a->file_path ?? null; @endphp
                    @if($dok_file)
                        <div class="document-item">
                            <div class="document-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="document-info">
                                <h4>File Dokumen Pengajuan</h4>
                                <p>Format: {{ strtoupper(pathinfo($dok_file, PATHINFO_EXTENSION)) }}</p>
                            </div>
                            @if(in_array(strtolower(pathinfo($dok_file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/' . $dok_file) }}" alt="Preview" class="document-preview">
                            @endif
                            <a href="{{ asset('storage/' . $dok_file) }}" download class="btn-download">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    @else
                        <div class="no-document">
                            <i class="fas fa-folder-open"></i>
                            <p>Tidak ada dokumen pendukung</p>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Riwayat Approval --}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-history"></i>
                    <h3>Riwayat Approval</h3>
                </div>
                <div class="card-body">
                    @if($approvalHistory->count() > 0)
                        <div class="timeline">
                            @foreach($approvalHistory as $log)
                                @php
                                    $iconClass = match($log->action) {
                                        'approve' => 'approve',
                                        'reject' => 'reject',
                                        default => 'revision'
                                    };
                                    $iconSymbol = match($log->action) {
                                        'approve' => 'fa-check',
                                        'reject' => 'fa-times',
                                        default => 'fa-edit'
                                    };
                                    $actionLabel = match($log->action) {
                                        'approve' => 'Disetujui',
                                        'reject' => 'Ditolak',
                                        'revision_request' => 'Permintaan Revisi',
                                        default => ucfirst($log->action)
                                    };
                                @endphp
                                <div class="timeline-item">
                                    <div class="timeline-icon {{ $iconClass }}">
                                        <i class="fas {{ $iconSymbol }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <span class="timeline-action">{{ $actionLabel }}</span>
                                            <span class="timeline-date">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        @if($log->catatan)
                                            <p class="timeline-note">{{ $log->catatan }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-document">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Belum ada riwayat approval</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Right Column (Actions) --}}
        <div>
            @if($verifikasi->status == 'pending')
                <div class="action-card">
                    <div class="action-title">
                        <i class="fas fa-gavel"></i>
                        Aksi Verifikasi
                    </div>
                    
                    <div class="action-buttons">
                        {{-- Approve --}}
                        <form action="{{ route('prodi.verifikasi.approve', $verifikasi->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-action btn-approve" style="width: 100%;" onclick="return confirm('Setujui achievement ini?')">
                                <i class="fas fa-check-circle"></i> Setujui
                            </button>
                        </form>
                        
                        {{-- Revision --}}
                        <form action="{{ route('prodi.verifikasi.revisi', $verifikasi->id) }}" method="POST">
                            @csrf
                            <textarea name="catatan" class="textarea-catatan" placeholder="Tuliskan catatan revisi..." required></textarea>
                            <button type="submit" class="btn-action btn-revision" style="width: 100%;">
                                <i class="fas fa-edit"></i> Minta Revisi
                            </button>
                        </form>
                        
                        {{-- Reject --}}
                        <form action="{{ route('prodi.verifikasi.reject', $verifikasi->id) }}" method="POST">
                            @csrf
                            <textarea name="catatan" class="textarea-catatan" placeholder="Tuliskan alasan penolakan..." required></textarea>
                            <button type="submit" class="btn-action btn-reject" style="width: 100%;" onclick="return confirm('Tolak achievement ini?')">
                                <i class="fas fa-times-circle"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            
            {{-- Draft Eligibility --}}
            <div class="eligibility-card {{ $isDraftEligible ? 'eligible' : 'not-eligible' }}">
                <div class="eligibility-content">
                    <div class="eligibility-icon">
                        <i class="fas {{ $isDraftEligible ? 'fa-check' : 'fa-exclamation' }}"></i>
                    </div>
                    <div class="eligibility-text">
                        <h4>{{ $isDraftEligible ? 'Siap Buat Draft SKPI' : 'Draft SKPI Belum Tersedia' }}</h4>
                        <p>{{ $isDraftEligible ? 'Semua kategori wajib sudah disetujui.' : 'Lengkapi semua kategori wajib untuk membuat draft.' }}</p>
                    </div>
                </div>
                
                @if($isDraftEligible)
                    <a href="{{ route('prodi.draft-skpi.create', ['verifikasi_id' => $verifikasi->id]) }}" class="btn-create-draft">
                        <i class="fas fa-file-signature"></i> Buat Draft SKPI
                    </a>
                @endif
            </div>
            
            {{-- Back Button --}}
            <div style="margin-top: 20px;">
                <a href="{{ route('prodi.verifikasi.index') }}" style="display: flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 14px;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Verifikasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

