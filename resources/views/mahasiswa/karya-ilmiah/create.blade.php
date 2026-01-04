@extends('mahasiswa.layouts.app')

@section('title', 'Tambah Karya Ilmiah')
@section('page_title', 'Tambah Karya Ilmiah')
@section('page_icon', 'plus')

@section('content')

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Karya Ilmiah</h3>
            </div>

            <form action="{{ route('mahasiswa.karya.store') }}" method="POST" enctype="multipart/form-data"
                style="padding: 24px;">
                @csrf

                <!-- Field 1: Judul Karya -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Judul Karya <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="judul_karya" class="form-control"
                        placeholder="Contoh: Implementasi Machine Learning untuk Prediksi Data"
                        value="{{ old('judul_karya') }}" required
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('judul_karya')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 2: Jenis Publikasi -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Jenis Publikasi <span style="color: red;">*</span>
                    </label>
                    <select name="jenis_publikasi" class="form-control" required
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                        <option value="">Pilih Jenis Publikasi</option>
                        <option value="jurnal" {{ old('jenis_publikasi') == 'jurnal' ? 'selected' : '' }}>Jurnal</option>
                        <option value="prosiding" {{ old('jenis_publikasi') == 'prosiding' ? 'selected' : '' }}>Prosiding
                        </option>
                        <option value="konferensi" {{ old('jenis_publikasi') == 'konferensi' ? 'selected' : '' }}>Konferensi
                        </option>
                        <option value="seminar" {{ old('jenis_publikasi') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                        <option value="lainnya" {{ old('jenis_publikasi') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_publikasi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 3: Nama Jurnal/Konferensi -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Nama Jurnal/Konferensi <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="nama_jurnal_konferensi" class="form-control"
                        placeholder="Contoh: IEEE Conference on Computer Vision" value="{{ old('nama_jurnal_konferensi') }}"
                        required
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('nama_jurnal_konferensi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 4: Tahun Publikasi -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Tahun Publikasi <span style="color: red;">*</span>
                    </label>
                    <input type="number" name="tahun_publikasi" class="form-control" placeholder="Contoh: 2024"
                        value="{{ old('tahun_publikasi') }}" min="1900" max="{{ date('Y') }}" required
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('tahun_publikasi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 5: DOI/ISSN -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        DOI/ISSN (Opsional)
                    </label>
                    <input type="text" name="doi_issn" class="form-control"
                        placeholder="Contoh: 10.1109/CVPR.2024.12345 atau ISSN 2345-6789" value="{{ old('doi_issn') }}"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('doi_issn')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 6: Deskripsi -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                        placeholder="Jelaskan abstrak atau ringkasan karya ilmiah..."
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; font-family: inherit;">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 7: Upload File -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Upload File (Opsional)
                    </label>
                    <div style="border: 2px dashed var(--border); border-radius: 8px; padding: 20px; text-align: center; cursor: pointer;"
                        onclick="document.getElementById('file_input').click()">
                        <i class="fas fa-cloud-upload-alt"
                            style="font-size: 32px; color: var(--brand); margin-bottom: 8px; display: block;"></i>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">Klik untuk upload file</p>
                        <small style="color: var(--muted);">Max 5MB (PDF, DOC, DOCX)</small>
                    </div>
                    <input type="file" id="file_input" name="file_path" style="display: none;" accept=".pdf,.doc,.docx">
                    <small id="file_name" style="color: var(--brand); display: block; margin-top: 8px;"></small>
                    @error('file_path')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Info Box -->
                <div
                    style="background: #eff6ff; border-left: 4px solid #3b82f6; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                    <p style="margin: 0; font-size: 14px; color: #1e40af;">
                        <strong><i class="fas fa-info-circle"></i> Informasi:</strong><br>
                        • <strong>Simpan sebagai Draft:</strong> Data tersimpan dan bisa Anda edit kapan saja sebelum
                        disubmit<br>
                        • <strong>Submit untuk Verifikasi:</strong> Data akan masuk ke proses verifikasi dan tidak bisa
                        diedit lagi
                    </p>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 32px;">
                    <!-- Button Save as Draft -->
                    <button type="submit" name="action" value="draft" class="btn"
                        style="flex: 1; padding: 12px; border-radius: 8px; font-weight: 600; background: #6b7280; color: white; border: none;">
                        <i class="fas fa-save"></i> Simpan sebagai Draft
                    </button>

                    <!-- Button Submit for Verification -->
                    <button type="submit" name="action" value="submit" class="btn btn-success"
                        style="flex: 1; padding: 12px; border-radius: 8px; font-weight: 600; background: #10b981; color: white; border: none;">
                        <i class="fas fa-paper-plane"></i> Submit untuk Verifikasi
                    </button>

                    <!-- Button Batal -->
                    <a href="{{ route('mahasiswa.karya.list') }}" class="btn"
                        style="flex: 0.5; padding: 12px; border-radius: 8px; font-weight: 600; background: var(--muted); color: white; text-align: center; text-decoration: none;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('file_input').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || '';
            document.getElementById('file_name').textContent = fileName ? '✓ ' + fileName : '';
        });
    </script>

@endsection
