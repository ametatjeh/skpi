@extends('mahasiswa.layouts.app')

@section('title', 'Tambah Organisasi')
@section('page_title', 'Tambah Organisasi')
@section('page_icon', 'users')

@section('content')
<style>
    .form-page * { box-sizing: border-box; }
    .form-page { max-width: 900px; margin: 0 auto; }
    .form-back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; background: #fff; color: #374151; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.2s; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04); }
    .form-back-btn:hover { background: #f3f4f6; transform: translateX(-4px); }
    .form-header { background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 50%, #c4b5fd 100%); border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff; box-shadow: 0 8px 32px rgba(139, 92, 246, 0.25); position: relative; overflow: hidden; }
    .form-header::before { content: ''; position: absolute; top: -50%; right: -20%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; }
    .form-header-content { display: flex; align-items: center; gap: 20px; position: relative; z-index: 1; }
    .form-header-icon { width: 64px; height: 64px; border-radius: 16px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; font-size: 28px; }
    .form-header-text h1 { font-size: 22px; font-weight: 800; margin: 0 0 6px 0; }
    .form-header-text p { font-size: 14px; opacity: 0.9; margin: 0; }
    .form-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04); overflow: hidden; }
    .form-card-header { padding: 20px 24px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 12px; }
    .form-card-header-icon { width: 44px; height: 44px; background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25); }
    .form-card-header h3 { font-size: 16px; font-weight: 700; color: #111827; margin: 0; }
    .form-card-body { padding: 28px 24px; }
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .form-grid .full-width { grid-column: 1 / -1; }
    .form-group { margin-bottom: 0; }
    .form-label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
    .form-label .required { color: #ef4444; margin-left: 2px; }
    .form-control { width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; font-family: inherit; background: #fff; color: #111827; transition: all 0.2s; }
    .form-control:hover { border-color: #ddd6fe; }
    .form-control:focus { outline: none; border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1); }
    textarea.form-control { resize: vertical; min-height: 100px; }
    .form-error { color: #ef4444; font-size: 12px; margin-top: 6px; }
    .upload-box { border: 2px dashed #e5e7eb; border-radius: 12px; padding: 32px 20px; text-align: center; cursor: pointer; background: #f8fafc; transition: all 0.2s; }
    .upload-box:hover { border-color: #8b5cf6; background: #f3e8ff; }
    .upload-icon { width: 56px; height: 56px; margin: 0 auto 12px; background: linear-gradient(135deg, #f3e8ff, #e9d5ff); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #8b5cf6; }
    .upload-text { font-size: 14px; font-weight: 600; color: #374151; margin: 0 0 4px; }
    .upload-hint { font-size: 12px; color: #6b7280; margin: 0; }
    .upload-filename { margin-top: 12px; padding: 10px 14px; background: #dcfce7; border-radius: 8px; font-size: 13px; color: #166534; display: none; align-items: center; gap: 8px; }
    .upload-filename.show { display: flex; }
    .info-box { background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%); border-radius: 12px; padding: 18px 20px; margin-top: 24px; border: 1px solid #c4b5fd; }
    .info-box-title { font-size: 14px; font-weight: 700; color: #6d28d9; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
    .info-box-content { font-size: 13px; color: #5b21b6; line-height: 1.6; }
    .form-actions { display: flex; gap: 12px; margin-top: 28px; padding-top: 24px; border-top: 1px solid #e5e7eb; }
    .form-btn { flex: 1; padding: 14px 24px; border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; transition: all 0.2s; }
    .form-btn-draft { background: #f3f4f6; color: #374151; border: 2px solid #e5e7eb; }
    .form-btn-draft:hover { background: #e5e7eb; transform: translateY(-2px); }
    .form-btn-submit { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); color: #fff; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .form-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); }
    .form-btn-cancel { flex: 0.5; background: #fff; color: #6b7280; border: 2px solid #e5e7eb; }
    .form-btn-cancel:hover { background: #f3f4f6; color: #374151; }
    @media (max-width: 768px) { .form-header-content { flex-direction: column; text-align: center; } .form-grid { grid-template-columns: 1fr; } .form-actions { flex-direction: column; } .form-btn-cancel { flex: 1; } }
</style>

<div class="form-page">
    <a href="{{ route('mahasiswa.organisasi.list') }}" class="form-back-btn"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>

    <div class="form-header">
        <div class="form-header-content">
            <div class="form-header-icon"><i class="fas fa-users"></i></div>
            <div class="form-header-text">
                <h1>Tambah Organisasi Baru</h1>
                <p>Lengkapi form berikut untuk menambahkan pengalaman organisasi Anda</p>
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-header-icon"><i class="fas fa-edit"></i></div>
            <h3>Form Input Organisasi</h3>
        </div>

        <form action="{{ route('mahasiswa.organisasi.store') }}" method="POST" enctype="multipart/form-data" class="form-card-body">
            @csrf

            <div class="form-grid">
                <div class="form-group full-width">
                    <label class="form-label">Nama Organisasi <span class="required">*</span></label>
                    <input type="text" name="nama_organisasi" class="form-control" placeholder="Contoh: Himpunan Mahasiswa Informatika" value="{{ old('nama_organisasi') }}" required>
                    @error('nama_organisasi')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Posisi <span class="required">*</span></label>
                    <input type="text" name="posisi" class="form-control" placeholder="Contoh: Ketua / Anggota" value="{{ old('posisi') }}" required>
                    @error('posisi')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tahun Masuk <span class="required">*</span></label>
                    <input type="number" name="tahun_masuk" class="form-control" placeholder="Contoh: 2022" value="{{ old('tahun_masuk') }}" min="1900" max="{{ date('Y') }}" required>
                    @error('tahun_masuk')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tahun Keluar (Opsional)</label>
                    <input type="number" name="tahun_keluar" class="form-control" placeholder="Kosongkan jika masih aktif" value="{{ old('tahun_keluar') }}" min="1900" max="{{ date('Y') }}">
                    @error('tahun_keluar')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Deskripsi Peran (Opsional)</label>
                    <textarea name="deskripsi_peran" rows="4" class="form-control" placeholder="Jelaskan peran dan kontribusi Anda di organisasi ini...">{{ old('deskripsi_peran') }}</textarea>
                    @error('deskripsi_peran')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Upload Bukti (Opsional)</label>
                    <div class="upload-box" id="uploadBox">
                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">Format: PDF, JPG, PNG (Maks. 5MB)</p>
                    </div>
                    <input type="file" id="fileInput" name="file_path" style="display:none;" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="upload-filename" id="fileName"><i class="fas fa-check-circle"></i><span></span></div>
                    @error('file_path')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="info-box">
                <div class="info-box-title"><i class="fas fa-info-circle"></i> Informasi Penting</div>
                <div class="info-box-content">
                    • <strong>Simpan sebagai Draft:</strong> Data tersimpan dan bisa Anda edit kapan saja.<br>
                    • <strong>Submit untuk Verifikasi:</strong> Data akan masuk proses verifikasi dan tidak bisa diedit.
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="action" value="draft" class="form-btn form-btn-draft"><i class="fas fa-save"></i> Simpan Draft</button>
                <button type="submit" name="action" value="submit" class="form-btn form-btn-submit"><i class="fas fa-paper-plane"></i> Submit untuk Verifikasi</button>
                <a href="{{ route('mahasiswa.organisasi.list') }}" class="form-btn form-btn-cancel"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    const uploadBox = document.getElementById('uploadBox');
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');
    uploadBox.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => {
        if (e.target.files[0]) {
            fileName.querySelector('span').textContent = e.target.files[0].name;
            fileName.classList.add('show');
        }
    });
</script>
@endsection
