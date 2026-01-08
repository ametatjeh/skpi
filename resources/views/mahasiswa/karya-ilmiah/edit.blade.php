@extends('mahasiswa.layouts.app')

@section('title', 'Edit Karya Ilmiah')
@section('page_title', 'Edit Karya Ilmiah')
@section('page_icon', 'edit')

@section('content')

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Karya Ilmiah</h3>
            </div>

            <form action="{{ route('mahasiswa.karya.update', $karya_ilmiah->id) }}" method="POST"
                enctype="multipart/form-data" style="padding: 24px;">
                @csrf
                @method('PUT')

                <!-- Field 1: Judul Karya -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Judul Karya <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="judul_karya" class="form-control"
                        value="{{ old('judul_karya', $karya_ilmiah->judul_karya) }}"
                        placeholder="Contoh: Implementasi Machine Learning untuk Prediksi Data"
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
                    <select name="jenis_publikasi" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                        <option value="">Pilih Jenis Publikasi</option>
                        <option value="jurnal"
                            {{ old('jenis_publikasi', $karya_ilmiah->jenis_publikasi) == 'jurnal' ? 'selected' : '' }}>
                            Jurnal</option>
                        <option value="prosiding"
                            {{ old('jenis_publikasi', $karya_ilmiah->jenis_publikasi) == 'prosiding' ? 'selected' : '' }}>
                            Prosiding</option>
                        <option value="konferensi"
                            {{ old('jenis_publikasi', $karya_ilmiah->jenis_publikasi) == 'konferensi' ? 'selected' : '' }}>
                            Konferensi</option>
                        <option value="seminar"
                            {{ old('jenis_publikasi', $karya_ilmiah->jenis_publikasi) == 'seminar' ? 'selected' : '' }}>
                            Seminar</option>
                        <option value="lainnya"
                            {{ old('jenis_publikasi', $karya_ilmiah->jenis_publikasi) == 'lainnya' ? 'selected' : '' }}>
                            Lainnya</option>
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
                        value="{{ old('nama_jurnal_konferensi', $karya_ilmiah->nama_jurnal_konferensi) }}"
                        placeholder="Contoh: IEEE Conference on Computer Vision"
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
                    <input type="number" name="tahun_publikasi" class="form-control"
                        value="{{ old('tahun_publikasi', $karya_ilmiah->tahun_publikasi) }}" placeholder="Contoh: 2024"
                        min="1900" max="{{ date('Y') }}" step="1"
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
                        value="{{ old('doi_issn', $karya_ilmiah->doi_issn) }}"
                        placeholder="Contoh: 10.1109/CVPR.2024.12345 atau ISSN 2345-6789"
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
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; font-family: inherit;">{{ old('deskripsi', $karya_ilmiah->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 7: Upload File -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Upload File (Opsional)
                    </label>

                    @if ($karya_ilmiah->file_path)
                        <div style="padding: 12px; background: #f3f4f6; border-radius: 6px; margin-bottom: 12px;">
                            <p style="margin: 0; font-size: 14px; color: var(--text-secondary);">
                                <i class="fas fa-file"></i> File saat ini:
                                <a href="{{ Storage::url($karya_ilmiah->file_path) }}" target="_blank"
                                    style="color: var(--brand);">
                                    {{ basename($karya_ilmiah->file_path) }}
                                </a>
                            </p>
                        </div>
                    @endif

                    <div style="border: 2px dashed var(--border); border-radius: 8px; padding: 20px; text-align: center; cursor: pointer;"
                        onclick="document.getElementById('file_input').click()">
                        <i class="fas fa-cloud-upload-alt"
                            style="font-size: 32px; color: var(--brand); margin-bottom: 8px; display: block;"></i>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">
                            Klik untuk upload file baru (opsional)
                        </p>
                        <small style="color: var(--muted);">Max 5MB (PDF, DOC, DOCX)</small>
                    </div>
                    <input type="file" id="file_input" name="file_path" style="display: none;" accept=".pdf,.doc,.docx">
                    <small id="file_name" style="color: var(--brand); display: block; margin-top: 8px;"></small>
                    @error('file_path')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 32px;">
                    <button type="submit" class="btn btn-primary"
                        style="flex: 1; padding: 12px; border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('mahasiswa.karya.list') }}" class="btn"
                        style="flex: 1; padding: 12px; border-radius: 8px; font-weight: 600; background: var(--muted); color: white; text-align: center; text-decoration: none;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('file_input').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || '';
            document.getElementById('file_name').textContent = fileName ? '✓ File baru: ' + fileName : '';
        });
    </script>

@endsection

