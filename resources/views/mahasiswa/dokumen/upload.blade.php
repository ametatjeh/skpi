@extends('mahasiswa.layouts.app')
@section('title', 'Upload Dokumen')
@section('page_title', 'Upload Dokumen')
@section('page_icon', 'cloud-upload-alt')

@section('content')
<style>
    .upload-page { max-width: 700px; margin: 0 auto; }
    .page-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px; color: #fff;
        position: relative; overflow: hidden; box-shadow: 0 10px 40px rgba(8, 145, 178, 0.25);
    }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .upload-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; }
    .upload-card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#f0f9ff,#cffafe); }
    .upload-card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#0891b2,#06b6d4); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
    .upload-card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .upload-card-body { padding:24px; }

    .form-group { margin-bottom:20px; }
    .form-group label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
    .form-group label i { margin-right:6px; color:#0891b2; }
    .form-input, .form-select { width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111827; background:#fff; transition:all 0.2s; font-family:'Inter',sans-serif; }
    .form-input:focus, .form-select:focus { outline:none; border-color:#0891b2; box-shadow:0 0 0 4px rgba(8,145,178,0.1); }

    .dropzone {
        border: 2px dashed #0891b2; border-radius: 16px; padding: 40px 20px;
        text-align: center; background: #f0f9ff; cursor: pointer;
        transition: all 0.3s; position: relative;
    }
    .dropzone:hover { background: #cffafe; border-color: #06b6d4; }
    .dropzone.dragover { background: #a5f3fc; border-color: #0891b2; transform: scale(1.02); }
    .dropzone-icon { font-size: 48px; color: #06b6d4; opacity: 0.6; margin-bottom: 12px; }
    .dropzone-text { font-size: 15px; font-weight: 600; color: #374151; margin-bottom: 4px; }
    .dropzone-sub { font-size: 12px; color: #6b7280; }
    .dropzone input[type="file"] { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .file-preview { display:none; margin-top:12px; padding:12px; background:#fff; border-radius:10px; border:1px solid #e5e7eb; font-size:13px; color:#374151; }
    .file-preview.active { display:flex; align-items:center; gap:10px; }

    .form-footer { padding:16px 24px; border-top:1px solid #e5e7eb; display:flex; justify-content:space-between; background:#f8fafc; }
    .btn-save { padding:12px 28px; background:linear-gradient(135deg,#0891b2,#06b6d4); color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; transition:all 0.2s; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 15px rgba(8,145,178,0.35); }
    .btn-save:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(8,145,178,0.45); }
    .btn-back { padding:12px 22px; background:#fff; color:#6b7280; border:2px solid #e5e7eb; border-radius:10px; font-size:14px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .btn-back:hover { background:#f1f5f9; }

    .alert-danger { padding:14px 18px; border-radius:12px; margin-bottom:20px; background:linear-gradient(135deg,#fee2e2,#fecaca); color:#991b1b; border-left:4px solid #ef4444; font-size:14px; }
</style>

<div class="upload-page">
    <div class="page-header">
        <h1><i class="fas fa-cloud-upload-alt" style="margin-right:10px"></i> Upload Dokumen</h1>
        <p>Upload dokumen pendukung untuk melengkapi pengajuan SKPI</p>
    </div>

    @if($errors->any())
        <div class="alert-danger">
            @foreach($errors->all() as $err)<div><i class="fas fa-exclamation-circle"></i> {{ $err }}</div>@endforeach
        </div>
    @endif

    <div class="upload-card">
        <div class="upload-card-header">
            <div class="upload-card-header-icon"><i class="fas fa-file-upload"></i></div>
            <h3>Form Upload</h3>
        </div>
        <form method="POST" action="{{ route('mahasiswa.dokumen.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="upload-card-body">
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" class="form-input" value="{{ old('nama_dokumen') }}" required placeholder="Contoh: Sertifikat TOEFL">
                </div>
                <div class="form-group">
                    <label><i class="fas fa-list"></i> Jenis Dokumen</label>
                    <select name="jenis_dokumen" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="sertifikat" {{ old('jenis_dokumen') == 'sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="piagam" {{ old('jenis_dokumen') == 'piagam' ? 'selected' : '' }}>Piagam</option>
                        <option value="sk" {{ old('jenis_dokumen') == 'sk' ? 'selected' : '' }}>SK/Surat Keputusan</option>
                        <option value="transkrip" {{ old('jenis_dokumen') == 'transkrip' ? 'selected' : '' }}>Transkrip</option>
                        <option value="foto" {{ old('jenis_dokumen') == 'foto' ? 'selected' : '' }}>Foto/Dokumentasi</option>
                        <option value="lainnya" {{ old('jenis_dokumen') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-paperclip"></i> File Dokumen</label>
                    <div class="dropzone" id="dropzone">
                        <div class="dropzone-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="dropzone-text">Drag & drop file di sini</div>
                        <div class="dropzone-sub">atau klik untuk memilih file (max 10MB)</div>
                        <input type="file" name="file_path" id="fileInput" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    </div>
                    <div class="file-preview" id="filePreview">
                        <i class="fas fa-file" style="color:#0891b2;font-size:18px"></i>
                        <span id="fileName"></span>
                        <span id="fileSize" style="color:#9ca3af;margin-left:auto"></span>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('mahasiswa.dokumen.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn-save"><i class="fas fa-upload"></i> Upload Dokumen</button>
            </div>
        </form>
    </div>
</div>

<script>
    var dz = document.getElementById('dropzone');
    var fi = document.getElementById('fileInput');
    var fp = document.getElementById('filePreview');
    var fn = document.getElementById('fileName');
    var fs = document.getElementById('fileSize');

    ['dragenter','dragover'].forEach(e => dz.addEventListener(e, function(ev) { ev.preventDefault(); dz.classList.add('dragover'); }));
    ['dragleave','drop'].forEach(e => dz.addEventListener(e, function(ev) { ev.preventDefault(); dz.classList.remove('dragover'); }));
    dz.addEventListener('drop', function(ev) { fi.files = ev.dataTransfer.files; showFile(); });
    fi.addEventListener('change', showFile);

    function showFile() {
        if (fi.files.length > 0) {
            var f = fi.files[0];
            fn.textContent = f.name;
            fs.textContent = (f.size / 1024).toFixed(1) + ' KB';
            fp.classList.add('active');
        }
    }
</script>
@endsection
