@extends('prodi.layouts.app')

@section('title', 'Edit CPL - Prodi')
@section('page_title', 'Edit CPL')

@push('styles')
<style>
    /* ============ PREMIUM EDIT CPL STYLES ============ */
    .edit-container * {
        box-sizing: border-box;
    }
    
    .edit-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(124, 58, 237, 0.25);
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
        color: #7c3aed;
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
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
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
        border-color: #7c3aed;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
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
    
    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }
    
    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .form-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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
        border-color: #c4b5fd;
        background: #f8fafc;
    }
    
    .kategori-card.selected {
        border-color: #7c3aed;
        background: #f5f3ff;
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
    
    /* Status Toggle */
    .status-toggle {
        display: flex;
        gap: 12px;
    }
    
    .status-option {
        flex: 1;
        position: relative;
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }
    
    .status-option:hover {
        background: #f8fafc;
    }
    
    .status-option.selected.aktif {
        border-color: #10b981;
        background: #dcfce7;
    }
    
    .status-option.selected.nonaktif {
        border-color: #ef4444;
        background: #fee2e2;
    }
    
    .status-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }
    
    .status-option i {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }
    
    .status-option.aktif i { color: #10b981; }
    .status-option.nonaktif i { color: #ef4444; }
    
    .status-option span {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
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
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        color: #fff;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }
    
    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #93c5fd;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .info-card-icon {
        width: 48px;
        height: 48px;
        background: #3b82f6;
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .info-card-content h4 {
        font-size: 14px;
        font-weight: 700;
        color: #1e40af;
        margin: 0 0 4px 0;
    }
    
    .info-card-content p {
        font-size: 13px;
        color: #3b82f6;
        margin: 0;
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
        .form-grid-3,
        .kategori-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .status-toggle {
            flex-direction: column;
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
<div class="edit-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('prodi.cpl.index') }}">
            <i class="fas fa-book-open"></i> Kelola CPL
        </a>
        <span>/</span>
        <span class="current">Edit CPL</span>
    </div>
    
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="header-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div>
                <h1>Edit CPL</h1>
                <p>{{ $cpl->kode }} - Perbarui informasi CPL</p>
            </div>
        </div>
    </div>
    
    {{-- Info Card --}}
    <div class="info-card">
        <div class="info-card-icon">
            <i class="fas fa-info"></i>
        </div>
        <div class="info-card-content">
            <h4>Editing: {{ $cpl->kode }}</h4>
            <p>Dibuat pada {{ $cpl->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
    
    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-pen"></i>
            <div class="form-header-text">
                <h3>Edit Data CPL</h3>
                <p>Perbarui informasi di bawah ini</p>
            </div>
        </div>
        
        <div class="form-body">
            <form method="POST" action="{{ route('prodi.cpl.update', $cpl->id) }}">
                @csrf
                @method('PUT')
                
                {{-- Kode, Urutan, Status --}}
                <div class="form-grid-3">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-hashtag"></i>
                            Kode CPL <span class="required">*</span>
                        </label>
                        <input type="text" name="kode" required
                            class="form-input {{ $errors->has('kode') ? 'error' : '' }}"
                            value="{{ old('kode', $cpl->kode) }}" placeholder="Contoh: CPL-S1-TI01">
                        @error('kode')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-sort-numeric-up"></i>
                            Urutan
                        </label>
                        <input type="number" name="urutan" min="1"
                            class="form-input {{ $errors->has('urutan') ? 'error' : '' }}"
                            value="{{ old('urutan', $cpl->urutan) }}" placeholder="Urutan tampil">
                        @error('urutan')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-toggle-on"></i>
                            Status <span class="required">*</span>
                        </label>
                        <select name="status" required class="form-select {{ $errors->has('status') ? 'error' : '' }}">
                            <option value="1" {{ old('status', $cpl->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $cpl->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                {{-- Kategori --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tags"></i>
                        Kategori <span class="required">*</span>
                    </label>
                    <div class="kategori-grid">
                        <label class="kategori-card sikap {{ old('kategori', $cpl->kategori) == 'sikap' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="sikap" {{ old('kategori', $cpl->kategori) == 'sikap' ? 'checked' : '' }} required>
                            <i class="fas fa-heart"></i>
                            <span>Sikap</span>
                        </label>
                        <label class="kategori-card pengetahuan {{ old('kategori', $cpl->kategori) == 'pengetahuan' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="pengetahuan" {{ old('kategori', $cpl->kategori) == 'pengetahuan' ? 'checked' : '' }}>
                            <i class="fas fa-brain"></i>
                            <span>Pengetahuan</span>
                        </label>
                        <label class="kategori-card keterampilan_umum {{ old('kategori', $cpl->kategori) == 'keterampilan_umum' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="keterampilan_umum" {{ old('kategori', $cpl->kategori) == 'keterampilan_umum' ? 'checked' : '' }}>
                            <i class="fas fa-tools"></i>
                            <span>Keterampilan Umum</span>
                        </label>
                        <label class="kategori-card keterampilan_khusus {{ old('kategori', $cpl->kategori) == 'keterampilan_khusus' ? 'selected' : '' }}">
                            <input type="radio" name="kategori" value="keterampilan_khusus" {{ old('kategori', $cpl->kategori) == 'keterampilan_khusus' ? 'checked' : '' }}>
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
                        placeholder="Jelaskan secara detail capaian pembelajaran...">{{ old('deskripsi', $cpl->deskripsi) }}</textarea>
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
                        <i class="fas fa-save"></i> Simpan Perubahan
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
