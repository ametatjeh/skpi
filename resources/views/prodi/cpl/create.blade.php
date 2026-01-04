@extends('prodi.layouts.app')

@section('title', 'Tambah CPL - Prodi')
@section('page_title', 'Tambah CPL Baru')

@push('styles')
<style>
    /* ============ PREMIUM CREATE CPL STYLES ============ */
    .create-container * {
        box-sizing: border-box;
    }
    
    .create-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(30, 64, 175, 0.25);
    }
    
    .page-header-content {
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
        color: #2563eb;
    }
    
    .breadcrumb span {
        color: #9ca3af;
    }
    
    .breadcrumb .current {
        color: #111827;
        font-weight: 600;
    }
    
    /* Form Card */
    .form-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
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
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .form-header-text h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .form-header-text p {
        font-size: 13px;
        color: #6b7280;
        margin: 4px 0 0 0;
    }
    
    .form-body {
        padding: 28px;
    }
    
    /* Form Group */
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-label .required {
        color: #ef4444;
    }
    
    .form-label i {
        color: #6b7280;
        font-size: 13px;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
        font-family: inherit;
        background: #fafbfc;
        transition: all 0.2s;
    }
    
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    
    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #9ca3af;
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #ef4444;
        background: #fef2f2;
    }
    
    .error-text {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
    }
    
    .error-text i {
        font-size: 11px;
    }
    
    /* Form Hint */
    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    /* Kategori Cards */
    .kategori-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    
    .kategori-card {
        position: relative;
        padding: 20px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }
    
    .kategori-card:hover {
        border-color: #bfdbfe;
        background: #f8fafc;
    }
    
    .kategori-card.selected {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    
    .kategori-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }
    
    .kategori-card i {
        font-size: 28px;
        margin-bottom: 10px;
        display: block;
    }
    
    .kategori-card.sikap i { color: #10b981; }
    .kategori-card.pengetahuan i { color: #f59e0b; }
    .kategori-card.keterampilan_umum i { color: #3b82f6; }
    .kategori-card.keterampilan_khusus i { color: #8b5cf6; }
    
    .kategori-card span {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        display: block;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid #e5e7eb;
        margin-top: 8px;
    }
    
    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    
    /* Tips Section */
    .tips-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #86efac;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
    }
    
    .tips-card h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #15803d;
        margin: 0 0 12px 0;
    }
    
    .tips-card ul {
        margin: 0;
        padding-left: 20px;
        font-size: 13px;
        color: #166534;
        line-height: 1.6;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px 24px;
        }
        
        .page-header h1 {
            font-size: 20px;
        }
        
        .form-body {
            padding: 20px;
        }
        
        .form-grid,
        .kategori-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .form-actions {
            flex-direction: column-reverse;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="create-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('prodi.cpl.index') }}">
            <i class="fas fa-book-open"></i> Kelola CPL
        </a>
        <span>/</span>
        <span class="current">Tambah CPL Baru</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="header-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div>
                <h1>Tambah CPL Baru</h1>
                <p>Buat Capaian Pembelajaran Lulusan baru untuk program studi</p>
            </div>
        </div>
    </div>
    
    {{-- Tips Card --}}
    <div class="tips-card">
        <h4><i class="fas fa-lightbulb"></i> Tips Membuat CPL</h4>
        <ul>
            <li>Gunakan kode yang unik dan mudah diidentifikasi (contoh: CPL-S1-TI01)</li>
            <li>Deskripsi harus detail menjelaskan kompetensi yang diharapkan</li>
            <li>Pilih kategori yang sesuai dengan jenis capaian pembelajaran</li>
        </ul>
    </div>
    
    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-edit"></i>
            <div class="form-header-text">
                <h3>Form CPL Baru</h3>
                <p>Lengkapi informasi di bawah ini</p>
            </div>
        </div>
        
        <div class="form-body">
            <form method="POST" action="{{ route('prodi.cpl.store') }}">
                @csrf
                
                {{-- Kode & Urutan --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-hashtag"></i>
                            Kode CPL <span class="required">*</span>
                        </label>
                        <input type="text" name="kode" required
                            class="form-input {{ $errors->has('kode') ? 'error' : '' }}"
                            value="{{ old('kode') }}" placeholder="Contoh: CPL-S1-TI01">
                        @error('kode')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="form-hint">Kode unik untuk identifikasi CPL</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-sort-numeric-up"></i>
                            Urutan
                        </label>
                        <input type="number" name="urutan" min="1"
                            class="form-input {{ $errors->has('urutan') ? 'error' : '' }}"
                            value="{{ old('urutan') }}" placeholder="Otomatis jika kosong">
                        @error('urutan')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="form-hint">Urutan tampil CPL (opsional)</div>
                    </div>
                </div>
                
                {{-- Kategori --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tags"></i>
                        Kategori <span class="required">*</span>
                    </label>
                    <div class="kategori-grid">
                        <label class="kategori-card sikap {{ old('kategori') == 'sikap' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="sikap" {{ old('kategori') == 'sikap' ? 'checked' : '' }} required>
                            <i class="fas fa-heart"></i>
                            <span>Sikap</span>
                        </label>
                        <label class="kategori-card pengetahuan {{ old('kategori') == 'pengetahuan' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="pengetahuan" {{ old('kategori') == 'pengetahuan' ? 'checked' : '' }}>
                            <i class="fas fa-brain"></i>
                            <span>Pengetahuan</span>
                        </label>
                        <label class="kategori-card keterampilan_umum {{ old('kategori') == 'keterampilan_umum' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="keterampilan_umum" {{ old('kategori') == 'keterampilan_umum' ? 'checked' : '' }}>
                            <i class="fas fa-tools"></i>
                            <span>Keterampilan Umum</span>
                        </label>
                        <label class="kategori-card keterampilan_khusus {{ old('kategori') == 'keterampilan_khusus' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="keterampilan_khusus" {{ old('kategori') == 'keterampilan_khusus' ? 'checked' : '' }}>
                            <i class="fas fa-cogs"></i>
                            <span>Keterampilan Khusus</span>
                        </label>
                    </div>
                    @error('kategori')
                        <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi <span class="required">*</span>
                    </label>
                    <textarea name="deskripsi" required 
                        class="form-textarea {{ $errors->has('deskripsi') ? 'error' : '' }}"
                        placeholder="Jelaskan secara detail capaian pembelajaran yang diharapkan...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Actions --}}
                <div class="form-actions">
                    <a href="{{ route('prodi.cpl.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan CPL
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Kategori card selection
document.querySelectorAll('.kategori-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.kategori-card').forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');
    });
});
</script>
@endpush
