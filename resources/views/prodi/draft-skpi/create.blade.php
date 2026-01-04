@extends('prodi.layouts.app')

@section('title', 'Buat Draft SKPI')

@section('content')
<style>
    /* ============ CREATE DRAFT SKPI PREMIUM STYLES ============ */
    .create-container {
        max-width: 900px;
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
        margin-bottom: 24px;
    }
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .page-header p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }
    
    /* Mahasiswa Card */
    .mahasiswa-card {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 8px 32px rgba(30, 64, 175, 0.25);
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .mahasiswa-avatar {
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
    
    .mahasiswa-info h2 {
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 8px 0;
    }
    
    .mahasiswa-meta {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        opacity: 0.9;
    }
    
    /* Achievement Summary */
    .achievement-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
        margin-top: 20px;
    }
    
    .achievement-badge {
        padding: 10px 14px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .achievement-badge i {
        font-size: 18px;
    }
    
    .achievement-badge span {
        font-size: 13px;
        font-weight: 500;
    }
    
    /* Form Card */
    .form-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .form-header {
        padding: 20px 28px;
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
        padding: 28px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.2s;
        background: #fff;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-input.invalid, .form-textarea.invalid {
        border-color: #ef4444;
    }
    
    .form-error {
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .form-hint {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 6px;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 14px 24px;
        border-radius: 12px;
        font-size: 15px;
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
        flex: 1;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    
    .info-box i {
        font-size: 20px;
        color: #2563eb;
        margin-top: 2px;
    }
    
    .info-box-content h4 {
        font-size: 14px;
        font-weight: 700;
        color: #1e40af;
        margin: 0 0 4px 0;
    }
    
    .info-box-content p {
        font-size: 13px;
        color: #374151;
        margin: 0;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .mahasiswa-card {
            padding: 20px;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .mahasiswa-meta {
            flex-direction: column;
            gap: 8px;
        }
        
        .achievement-summary {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .form-body {
            padding: 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<div class="create-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('prodi.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <span class="breadcrumb-separator">/</span>
        <a href="{{ route('prodi.draft-skpi.index') }}"><i class="fas fa-file-signature"></i> Draft SKPI</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Buat Draft</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <h1><i class="fas fa-plus-circle"></i> Buat Draft SKPI</h1>
        <p>Buat draft Surat Keterangan Pendamping Ijazah untuk mahasiswa</p>
    </div>
    
    {{-- Mahasiswa Card --}}
    <div class="mahasiswa-card">
        <div class="mahasiswa-avatar">
            {{ strtoupper(substr($mahasiswa->nama ?? 'M', 0, 2)) }}
        </div>
        <div class="mahasiswa-info">
            <h2>{{ $mahasiswa->nama }}</h2>
            <div class="mahasiswa-meta">
                <div class="meta-item">
                    <i class="fas fa-id-card"></i>
                    {{ $mahasiswa->nim }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-graduation-cap"></i>
                    {{ $mahasiswa->prodi->nama_prodi ?? 'Program Studi' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    {{ $mahasiswa->prodi->fakultas->nama_fakultas ?? 'Fakultas' }}
                </div>
            </div>
            
            {{-- Achievement Summary --}}
            @php
                $achievements = $mahasiswa->verifikasiSkpi()
                    ->where('status', 'approved')
                    ->where('level_verifikasi', 'prodi')
                    ->get()
                    ->groupBy('verifiable_type');
            @endphp
            
            @if($achievements->count() > 0)
                <div class="achievement-summary">
                    @foreach($achievements as $type => $items)
                        @php
                            $typeIcon = match($type) {
                                'App\Models\SertifikasiKompetensi' => 'fa-certificate',
                                'App\Models\Prestasi' => 'fa-trophy',
                                'App\Models\Organisasi' => 'fa-users',
                                'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
                                'App\Models\KaryaIlmiah' => 'fa-book',
                                'App\Models\Penghargaan' => 'fa-award',
                                default => 'fa-star'
                            };
                            $typeName = match($type) {
                                'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
                                'App\Models\Prestasi' => 'Prestasi',
                                'App\Models\Organisasi' => 'Organisasi',
                                'App\Models\PengabdianMasyarakat' => 'PKM',
                                'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                                'App\Models\Penghargaan' => 'Penghargaan',
                                default => 'Achievement'
                            };
                        @endphp
                        <div class="achievement-badge">
                            <i class="fas {{ $typeIcon }}"></i>
                            <span>{{ $items->count() }} {{ $typeName }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
    {{-- Info Box --}}
    <div class="info-box">
        <i class="fas fa-info-circle"></i>
        <div class="info-box-content">
            <h4>Informasi</h4>
            <p>Setelah draft SKPI dibuat, data akan diteruskan ke Pusat Bahasa untuk verifikasi bilingual, kemudian ke Fakultas untuk persetujuan final.</p>
        </div>
    </div>
    
    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-edit"></i>
            <h3>Form Draft SKPI</h3>
        </div>
        
        <div class="form-body">
            <form action="{{ route('prodi.draft-skpi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                
                <div class="form-group">
                    <label class="form-label">Nomor SKPI</label>
                    <input type="text" name="nomor_skpi" value="{{ old('nomor_skpi') }}" 
                        class="form-input @error('nomor_skpi') invalid @enderror"
                        placeholder="Contoh: SKPI/2024/001">
                    @error('nomor_skpi')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-hint"><i class="fas fa-info-circle"></i> Boleh dikosongkan, dapat diisi nanti.</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', date('Y')) }}" 
                        class="form-input @error('tahun_lulus') invalid @enderror"
                        placeholder="Contoh: 2024">
                    @error('tahun_lulus')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan Prodi</label>
                    <textarea name="catatan" class="form-textarea @error('catatan') invalid @enderror"
                        placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('prodi.draft-skpi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan & Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
