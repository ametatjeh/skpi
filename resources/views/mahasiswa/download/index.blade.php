@extends('mahasiswa.layouts.app')

@section('title', 'Status SKPI')
@section('page_title', 'Status SKPI')
@section('page_icon', 'file-alt')

@section('content')
<style>
    /* ============ DOWNLOAD SKPI PREMIUM SKY BLUE ============ */
    .download-page * {
        box-sizing: border-box;
    }

    .download-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Premium Header */
    .download-header {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(14, 165, 233, 0.25);
        position: relative;
        overflow: hidden;
    }

    .download-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .download-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .download-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .download-header-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .download-header-text h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .download-header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .download-header-badge {
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 600;
    }

    .download-header-badge i {
        font-size: 18px;
    }

    /* Info Card */
    .download-info-card {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        border: 1px solid #7dd3fc;
    }

    .download-info-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .download-info-content h3 {
        font-size: 16px;
        font-weight: 700;
        color: #0369a1;
        margin: 0 0 8px;
    }

    .download-info-content p {
        font-size: 14px;
        color: #0c4a6e;
        margin: 0;
        line-height: 1.6;
    }

    .download-info-content strong {
        color: #0369a1;
    }

    /* Status Steps */
    .download-steps {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .download-step {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        text-align: center;
        position: relative;
        transition: all 0.2s;
    }

    .download-step:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .download-step-num {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        margin: 0 auto 12px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .download-step h4 {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px;
    }

    .download-step p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    /* Table Card */
    .download-table-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .download-table-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .download-table-header-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .download-table-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .download-table-container {
        overflow-x: auto;
    }

    .download-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .download-table thead th {
        padding: 16px 20px;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #f8fafc;
        border-bottom: 2px solid #e5e7eb;
    }

    .download-table tbody td {
        padding: 18px 20px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        text-align: center;
        vertical-align: middle;
    }

    .download-table tbody tr {
        transition: all 0.2s;
    }

    .download-table tbody tr:hover {
        background: #f0f9ff;
    }

    .download-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* SKPI Number */
    .download-skpi-number {
        font-weight: 700;
        color: #0ea5e9;
        font-family: 'Courier New', monospace;
    }

    /* Status Badge */
    .download-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .download-badge.draft {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    .download-badge.final {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
    }

    .download-badge.selesai {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: #0369a1;
    }

    /* Keterangan */
    .download-note {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        justify-content: center;
    }

    .download-note.ready {
        color: #059669;
        font-weight: 600;
    }

    .download-note.waiting {
        color: #9ca3af;
    }

    /* Success Box */
    .download-success-box {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: #fff;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
    }

    .download-success-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .download-success-content h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .download-success-content p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    /* Empty State */
    .download-empty {
        padding: 60px 40px;
        text-align: center;
    }

    .download-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: #0ea5e9;
    }

    .download-empty-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .download-empty-text {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    .download-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
        transition: all 0.2s;
    }

    .download-empty-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .download-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .download-header-text h1 {
            font-size: 20px;
        }

        .download-steps {
            grid-template-columns: 1fr;
        }

        .download-info-card {
            flex-direction: column;
            text-align: center;
        }

        .download-success-box {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="download-page">
    {{-- Premium Header --}}
    <div class="download-header">
        <div class="download-header-content">
            <div class="download-header-left">
                <div class="download-header-icon">
                    <i class="fas fa-file-download"></i>
                </div>
                <div class="download-header-text">
                    <h1>Status SKPI Anda</h1>
                    <p>Pantau status dan pengambilan dokumen SKPI resmi Anda</p>
                </div>
            </div>
            <div class="download-header-badge">
                <i class="fas fa-user-graduate"></i>
                {{ $mahasiswa->nim ?? auth()->user()->mahasiswa->nim ?? '-' }}
            </div>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="download-info-card">
        <div class="download-info-icon">
            <i class="fas fa-print"></i>
        </div>
        <div class="download-info-content">
            <h3>Panduan Pengambilan SKPI</h3>
            <p>
                Setelah SKPI Anda berstatus <strong>"Final"</strong>, silakan datang ke 
                <strong>Biro Akademik (Pusat Bahasa)</strong> untuk mencetak dokumen SKPI resmi Anda.
                Jangan lupa membawa <strong>KTM/Identitas</strong> yang masih berlaku.
            </p>
        </div>
    </div>

    {{-- Process Steps --}}
    <div class="download-steps">
        <div class="download-step">
            <div class="download-step-num">1</div>
            <h4>Verifikasi Achievement</h4>
            <p>Semua data achievement Anda diverifikasi oleh Prodi</p>
        </div>
        <div class="download-step">
            <div class="download-step-num">2</div>
            <h4>Generate SKPI</h4>
            <p>Admin membuat draft SKPI berdasarkan data terverifikasi</p>
        </div>
        <div class="download-step">
            <div class="download-step-num">3</div>
            <h4>Pengambilan SKPI</h4>
            <p>Ambil dokumen resmi di Biro Akademik</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="download-table-card">
        <div class="download-table-header">
            <div class="download-table-header-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3>Daftar SKPI Anda</h3>
        </div>

        @if ($skpis->count() > 0)
            <div class="download-table-container">
                <table class="download-table">
                    <thead>
                        <tr>
                            <th>Nomor SKPI</th>
                            <th>Status</th>
                            <th>Tanggal Pengesahan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skpis as $skpi)
                            @php $status = $skpi->status; @endphp
                            <tr>
                                <td>
                                    <span class="download-skpi-number">
                                        {{ $skpi->nomor_skpi ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($status === 'draft')
                                        <span class="download-badge draft">
                                            <i class="fas fa-clock"></i> Draft
                                        </span>
                                    @elseif ($status === 'final_issued' || $status === 'final')
                                        <span class="download-badge final">
                                            <i class="fas fa-check-circle"></i> Final
                                        </span>
                                    @elseif ($status === 'selesai')
                                        <span class="download-badge selesai">
                                            <i class="fas fa-check-double"></i> Selesai
                                        </span>
                                    @else
                                        <span class="download-badge">{{ ucfirst($status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($skpi->tanggal_pengesahan)
                                        <i class="fas fa-calendar" style="color: #9ca3af; margin-right: 6px;"></i>
                                        {{ \Carbon\Carbon::parse($skpi->tanggal_pengesahan)->format('d M Y') }}
                                    @else
                                        <span style="color: #9ca3af;">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($status === 'final_issued' || $status === 'final')
                                        <span class="download-note ready">
                                            <i class="fas fa-check-circle"></i>
                                            Siap diambil di Biro Akademik
                                        </span>
                                    @elseif ($status === 'selesai')
                                        <span class="download-note ready">
                                            <i class="fas fa-check-double"></i>
                                            Sudah diambil
                                        </span>
                                    @else
                                        <span class="download-note waiting">
                                            <i class="fas fa-hourglass-half"></i>
                                            Menunggu proses verifikasi
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="download-empty">
                <div class="download-empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="download-empty-title">Belum Ada SKPI</div>
                <div class="download-empty-text">
                    Data SKPI Anda akan muncul setelah proses verifikasi achievement selesai.
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="download-empty-btn">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>

    {{-- Success Box jika ada SKPI Final --}}
    @if ($skpis->where('status', 'final_issued')->count() > 0 || $skpis->where('status', 'final')->count() > 0)
        <div class="download-success-box">
            <div class="download-success-icon">
                <i class="fas fa-award"></i>
            </div>
            <div class="download-success-content">
                <h3>🎉 Selamat! SKPI Anda Telah Terverifikasi</h3>
                <p>
                    Silakan datang ke <strong>Biro Akademik (Pusat Bahasa)</strong> untuk mengambil dokumen SKPI resmi Anda.
                    Jangan lupa membawa KTM/Identitas yang masih berlaku!
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
