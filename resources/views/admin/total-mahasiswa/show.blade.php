@extends('admin.layouts.app')

@section('title', 'Detail Mahasiswa')
@section('page_title', 'Detail Mahasiswa')
@section('page_icon', 'user-graduate')

@section('content')
<style>
    .content-wrapper {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
    }
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: bold;
    }
    .profile-info h3 {
        margin: 0;
        font-size: 24px;
        color: #111827;
        font-weight: 700;
    }
    .profile-info p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 15px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    .info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
    }
    .info-card h4 {
        margin: 0 0 15px;
        font-size: 16px;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 10px;
    }
    .info-item {
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
    }
    .info-label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }
    .info-value {
        font-size: 15px;
        color: #111827;
        font-weight: 500;
        margin-top: 4px;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #f3f4f6;
        color: #374151;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s;
        margin-bottom: 20px;
    }
    .btn-back:hover {
        background: #e5e7eb;
        color: #111827;
    }
</style>

<div class="content-wrapper">
    <a href="{{ route('admin.total-mahasiswa.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
    </a>

    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
        </div>
        <div class="profile-info">
            <h3>{{ $mahasiswa->nama }}</h3>
            <p><i class="fas fa-id-card"></i> NIM: {{ $mahasiswa->nim }} | <i class="fas fa-envelope"></i> {{ optional($mahasiswa->user)->email ?? '-' }}</p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h4><i class="fas fa-user"></i> Informasi Pribadi</h4>
            <div class="info-item">
                <span class="info-label">NIK</span>
                <span class="info-value">{{ $mahasiswa->nik ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Jenis Kelamin</span>
                <span class="info-value">{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : ($mahasiswa->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tempat, Tanggal Lahir</span>
                <span class="info-value">{{ $mahasiswa->tempat_tanggal_lahir ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Agama</span>
                <span class="info-value">{{ $mahasiswa->agama ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Alamat</span>
                <span class="info-value">{{ $mahasiswa->alamat ?? '-' }}</span>
            </div>
        </div>

        <div class="info-card">
            <h4><i class="fas fa-graduation-cap"></i> Informasi Akademik</h4>
            <div class="info-item">
                <span class="info-label">Fakultas</span>
                <span class="info-value">{{ optional(optional($mahasiswa->prodi)->fakultas)->nama_fakultas ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Program Studi</span>
                <span class="info-value">{{ optional($mahasiswa->prodi)->nama_prodi ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Angkatan / Tahun Masuk</span>
                <span class="info-value">{{ $mahasiswa->angkatan ?? '-' }} / {{ $mahasiswa->tahun_masuk ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Masuk</span>
                <span class="info-value">{{ $mahasiswa->tanggal_masuk ? $mahasiswa->tanggal_masuk->format('d F Y') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Status Mahasiswa</span>
                <span class="info-value">
                    @if(strtolower($mahasiswa->status_mahasiswa) == 'aktif')
                        <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: bold;">AKTIF</span>
                    @elseif(strtolower($mahasiswa->status_mahasiswa) == 'lulus')
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: bold;">LULUS</span>
                    @else
                        <span style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: bold;">{{ strtoupper($mahasiswa->status_mahasiswa ?? 'TIDAK DIKETAHUI') }}</span>
                    @endif
                </span>
            </div>
        </div>

        <div class="info-card">
            <h4><i class="fas fa-certificate"></i> Informasi Kelulusan</h4>
            <div class="info-item">
                <span class="info-label">Tanggal Lulus</span>
                <span class="info-value">{{ $mahasiswa->tanggal_lulus ? $mahasiswa->tanggal_lulus->format('d F Y') : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Gelar</span>
                <span class="info-value">{{ $mahasiswa->gelar ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Nomor Ijazah</span>
                <span class="info-value">{{ $mahasiswa->no_ijazah ?? '-' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
