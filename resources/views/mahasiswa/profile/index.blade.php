@extends('mahasiswa.layouts.app')

@section('title', 'Profil Mahasiswa')
@section('page_title', 'Profil Saya')
@section('page_icon', 'user')

@section('content')
<style>
    /* ============ PREMIUM PROFILE PAGE - SKY BLUE THEME ============ */
    .profile-page * {
        box-sizing: border-box;
    }

    .profile-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Premium Header */
    .profile-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(8, 145, 178, 0.25);
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 24px;
        position: relative;
        z-index: 1;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 800;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .profile-header-info h1 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 6px 0;
    }

    .profile-header-info p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 8px;
    }

    /* Alerts */
    .profile-alert {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
    }

    .profile-alert.success {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
        border-left: 4px solid #22c55e;
    }

    .profile-alert.danger {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .profile-alert i {
        font-size: 20px;
    }

    /* Form Sections */
    .profile-form-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .profile-section-header {
        background: linear-gradient(135deg, #f0f9ff 0%, #cffafe 100%);
        padding: 16px 24px;
        border-bottom: 1px solid #a5f3fc;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-section-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.25);
    }

    .profile-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #0369a1;
        margin: 0;
    }

    .profile-section-body {
        padding: 24px;
    }

    /* Form Grid */
    .profile-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .profile-form-group {
        position: relative;
    }

    .profile-form-group.full-width {
        grid-column: span 2;
    }

    .profile-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .profile-form-group label i {
        margin-right: 6px;
        color: #0891b2;
    }

    .profile-input,
    .profile-select,
    .profile-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        color: #111827;
        background: #fff;
        transition: all 0.2s ease;
    }

    .profile-input:focus,
    .profile-select:focus,
    .profile-textarea:focus {
        outline: none;
        border-color: #0891b2;
        box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.1);
    }

    .profile-input[readonly] {
        background: #f8fafc;
        color: #64748b;
        cursor: not-allowed;
        border-color: #e2e8f0;
    }

    .profile-input[readonly]:focus {
        border-color: #e2e8f0;
        box-shadow: none;
    }

    .profile-textarea {
        min-height: 80px;
        resize: vertical;
    }

    .readonly-badge {
        position: absolute;
        top: 8px;
        right: 0;
        font-size: 10px;
        background: #e2e8f0;
        color: #64748b;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }

    /* Submit Button */
    .profile-submit-section {
        display: flex;
        justify-content: flex-end;
        padding: 20px 24px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
    }

    .btn-save-profile {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(8, 145, 178, 0.35);
    }

    .btn-save-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(8, 145, 178, 0.45);
    }

    .btn-save-profile i {
        font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-header-content {
            flex-direction: column;
            text-align: center;
        }

        .profile-header-info p {
            justify-content: center;
        }

        .profile-form-grid {
            grid-template-columns: 1fr;
        }

        .profile-form-group.full-width {
            grid-column: span 1;
        }

        .profile-submit-section {
            justify-content: stretch;
        }

        .btn-save-profile {
            width: 100%;
            justify-content: center;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }

        .profile-header-info h1 {
            font-size: 20px;
        }
    }
</style>

<div class="profile-page">
    {{-- Premium Header --}}
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-avatar">
                {{ strtoupper(substr($mahasiswa->nama ?? 'M', 0, 1)) }}{{ strtoupper(substr($mahasiswa->nama ?? 'H', 1, 1)) }}
            </div>
            <div class="profile-header-info">
                <h1>{{ $mahasiswa->nama ?? 'Mahasiswa' }}</h1>
                <p><i class="fas fa-id-card"></i> NIM: {{ $mahasiswa->nim ?? '-' }}</p>
                <p><i class="fas fa-building"></i> {{ $mahasiswa->prodi->nama ?? 'Program Studi' }}</p>
                <div class="profile-header-badge">
                    <i class="fas fa-user-graduate"></i>
                    {{ $mahasiswa->status_mahasiswa ?? 'Aktif' }}
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="profile-alert success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="profile-alert danger">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                @foreach ($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('mahasiswa.profile.update') }}">
        @csrf
        @method('PUT')

        {{-- Personal Information Section --}}
        <div class="profile-form-section">
            <div class="profile-section-header">
                <div class="profile-section-icon">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="profile-section-title">Informasi Pribadi</h3>
            </div>
            <div class="profile-section-body">
                <div class="profile-form-grid">
                    <div class="profile-form-group">
                        <label><i class="fas fa-id-badge"></i> NIM</label>
                        <span class="readonly-badge">Tidak dapat diubah</span>
                        <input class="profile-input" value="{{ $mahasiswa->nim }}" readonly>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="nama" class="profile-input"
                            value="{{ old('nama', $mahasiswa->nama) }}" required>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-envelope"></i> Email Akun</label>
                        <input type="email" name="email" class="profile-input" 
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-phone"></i> No. HP</label>
                        <input type="text" name="no_hp" class="profile-input"
                            value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="profile-select">
                            <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-praying-hands"></i> Agama</label>
                        <input type="text" name="agama" class="profile-input"
                            value="{{ old('agama', $mahasiswa->agama) }}">
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Tempat, Tanggal Lahir</label>
                        <input type="text" name="tempat_tanggal_lahir" class="profile-input"
                            value="{{ old('tempat_tanggal_lahir', $mahasiswa->tempat_tanggal_lahir) }}"
                            placeholder="Contoh: Makassar, 01 Januari 2000">
                    </div>

                    <div class="profile-form-group full-width">
                        <label><i class="fas fa-home"></i> Alamat</label>
                        <textarea name="alamat" class="profile-textarea" placeholder="Alamat lengkap...">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Academic Information Section --}}
        <div class="profile-form-section">
            <div class="profile-section-header">
                <div class="profile-section-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="profile-section-title">Informasi Akademik</h3>
            </div>
            <div class="profile-section-body">
                <div class="profile-form-grid">
                    <div class="profile-form-group">
                        <label><i class="fas fa-calendar-alt"></i> Tahun Masuk</label>
                        <span class="readonly-badge">Tidak dapat diubah</span>
                        <input class="profile-input" value="{{ $mahasiswa->tahun_masuk }}" readonly>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-users"></i> Angkatan</label>
                        <span class="readonly-badge">Tidak dapat diubah</span>
                        <input class="profile-input" value="{{ $mahasiswa->angkatan }}" readonly>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-calendar-check"></i> Tanggal Masuk</label>
                        <span class="readonly-badge">Tidak dapat diubah</span>
                        <input class="profile-input" value="{{ $mahasiswa->tanggal_masuk }}" readonly>
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-user-check"></i> Status Mahasiswa</label>
                        <span class="readonly-badge">Tidak dapat diubah</span>
                        <input class="profile-input" value="{{ $mahasiswa->status_mahasiswa }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        {{-- Graduation Information Section --}}
        <div class="profile-form-section">
            <div class="profile-section-header">
                <div class="profile-section-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="profile-section-title">Informasi Kelulusan</h3>
            </div>
            <div class="profile-section-body">
                <div class="profile-form-grid">
                    <div class="profile-form-group">
                        <label><i class="fas fa-calendar-day"></i> Tanggal Lulus</label>
                        <input type="date" name="tanggal_lulus" class="profile-input"
                            value="{{ old('tanggal_lulus', $mahasiswa->tanggal_lulus) }}">
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-medal"></i> Gelar</label>
                        <input type="text" name="gelar" class="profile-input"
                            value="{{ old('gelar', $mahasiswa->gelar) }}" placeholder="Contoh: S.Kom">
                    </div>

                    <div class="profile-form-group">
                        <label><i class="fas fa-file-alt"></i> Nomor Ijazah</label>
                        <input type="text" name="no_ijazah" class="profile-input"
                            value="{{ old('no_ijazah', $mahasiswa->no_ijazah) }}" placeholder="Nomor ijazah...">
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="profile-submit-section">
                <button type="submit" class="btn-save-profile">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

