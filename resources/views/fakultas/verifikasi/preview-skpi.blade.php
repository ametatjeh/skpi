@extends('fakultas.layouts.app')
@section('title', 'Preview SKPI')

@push('styles')
<style>
    .preview-container { max-width: 900px; margin: 0 auto; }
    .page-header {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden;
        box-shadow: 0 10px 40px rgba(124, 58, 237, 0.25);
    }
    .page-header::before {
        content: ''; position: absolute; top: -50%; right: -20%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .page-header h1 { font-size: 24px; font-weight: 800; margin: 0 0 6px 0; position: relative; z-index: 1; }
    .page-header p { font-size: 14px; opacity: 0.9; margin: 0; position: relative; z-index: 1; }
    .header-actions { display: flex; gap: 10px; margin-top: 16px; position: relative; z-index: 1; }
    .btn-action {
        padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600;
        text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        border: none; cursor: pointer; transition: all 0.2s;
    }
    .btn-action:hover { transform: translateY(-2px); }
    .btn-action.primary { background: rgba(255,255,255,0.2); color: #fff; backdrop-filter: blur(4px); }
    .btn-action.success { background: #22c55e; color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,0.3); }
    .btn-action.danger { background: #ef4444; color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,0.3); }

    .skpi-card {
        background: #fff; border-radius: 16px; border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04); margin-bottom: 20px; overflow: hidden;
    }
    .skpi-card-header {
        padding: 18px 24px; border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: 12px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    }
    .skpi-card-header-icon {
        width: 40px; height: 40px; background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        color: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center;
    }
    .skpi-card-header h3 { font-size: 16px; font-weight: 700; color: #111827; margin: 0; }
    .skpi-card-body { padding: 24px; }

    .info-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;
    }
    .info-item label {
        display: block; font-size: 12px; font-weight: 600; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;
    }
    .info-item span {
        font-size: 15px; font-weight: 600; color: #111827;
    }
    .info-item.full { grid-column: span 2; }

    .kegiatan-list { list-style: none; padding: 0; margin: 0; }
    .kegiatan-item {
        padding: 14px 0; border-bottom: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center;
    }
    .kegiatan-item:last-child { border-bottom: none; }
    .kegiatan-name { font-weight: 600; color: #111827; font-size: 14px; }
    .kegiatan-detail { font-size: 12px; color: #6b7280; margin-top: 2px; }
    .status-badge {
        padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.pending { background: #fef3c7; color: #92400e; }

    .ringkasan-box {
        background: #f8fafc; border-radius: 12px; padding: 20px;
        border: 1px solid #e2e8f0; margin-bottom: 12px;
    }
    .ringkasan-box h4 { font-size: 13px; font-weight: 700; color: #7c3aed; margin: 0 0 8px 0; }
    .ringkasan-box p { font-size: 14px; color: #374151; line-height: 1.6; margin: 0; }

    @media (max-width: 768px) {
        .info-grid { grid-template-columns: 1fr; }
        .info-item.full { grid-column: span 1; }
        .header-actions { flex-direction: column; }
    }
</style>
@endpush

@section('content')
<div class="preview-container">
    <div class="page-header">
        <h1><i class="fas fa-file-alt" style="margin-right:10px"></i> Preview Draft SKPI</h1>
        <p>Review kelengkapan draft SKPI sebelum menyetujui atau menolak</p>
        <div class="header-actions">
            <a href="{{ url()->previous() }}" class="btn-action primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Data Mahasiswa --}}
    <div class="skpi-card">
        <div class="skpi-card-header">
            <div class="skpi-card-header-icon"><i class="fas fa-user-graduate"></i></div>
            <h3>Data Mahasiswa</h3>
        </div>
        <div class="skpi-card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Lengkap</label>
                    <span>{{ $draft->mahasiswa->nama ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <label>NIM</label>
                    <span>{{ $draft->mahasiswa->nim ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <label>Program Studi</label>
                    <span>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <label>Status Draft</label>
                    <span class="status-badge {{ $draft->status == 'final_issued' ? 'approved' : 'pending' }}">
                        {{ ucfirst(str_replace('_', ' ', $draft->status)) }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Nomor SKPI</label>
                    <span>{{ $draft->nomor_skpi ?? 'Belum ditetapkan' }}</span>
                </div>
                <div class="info-item">
                    <label>Tanggal Dibuat</label>
                    <span>{{ $draft->created_at ? $draft->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Ringkasan Bilingual --}}
    <div class="skpi-card">
        <div class="skpi-card-header">
            <div class="skpi-card-header-icon"><i class="fas fa-language"></i></div>
            <h3>Ringkasan Bilingual</h3>
        </div>
        <div class="skpi-card-body">
            <div class="ringkasan-box">
                <h4><i class="fas fa-flag"></i> Ringkasan (Bahasa Indonesia)</h4>
                <p>{{ $draft->ringkasan_id ?? 'Belum ada ringkasan' }}</p>
            </div>
            <div class="ringkasan-box">
                <h4><i class="fas fa-globe"></i> Summary (English)</h4>
                <p>{{ $draft->ringkasan_en ?? 'No summary available' }}</p>
            </div>
        </div>
    </div>

    {{-- Kegiatan / Achievement --}}
    <div class="skpi-card">
        <div class="skpi-card-header">
            <div class="skpi-card-header-icon"><i class="fas fa-trophy"></i></div>
            <h3>Kegiatan & Pencapaian</h3>
        </div>
        <div class="skpi-card-body">
            <ul class="kegiatan-list">
                @forelse($draft->verifikasiSkpi ?? [] as $verif)
                    <li class="kegiatan-item">
                        <div>
                            <div class="kegiatan-name">{{ class_basename($verif->verifiable_type ?? '') }}</div>
                            <div class="kegiatan-detail">
                                {{ $verif->verifiable->nama ?? $verif->verifiable->judul ?? $verif->verifiable->nama_organisasi ?? '-' }}
                            </div>
                        </div>
                        <span class="status-badge {{ $verif->status }}">
                            <i class="fas {{ $verif->status == 'approved' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                            {{ ucfirst(str_replace('_', ' ', $verif->status)) }}
                        </span>
                    </li>
                @empty
                    <li style="padding:20px;text-align:center;color:#9ca3af">
                        <i class="fas fa-inbox" style="font-size:24px;opacity:0.4;display:block;margin-bottom:8px"></i>
                        Belum ada data kegiatan
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
