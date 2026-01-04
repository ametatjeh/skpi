@extends('mahasiswa.layouts.app')

@section('title', 'Edit Penghargaan')
@section('page_title', 'Edit Penghargaan')
@section('page_icon', 'edit')

@section('content')

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Penghargaan</h3>
            </div>

            <form action="{{ route('mahasiswa.penghargaan.update', $penghargaan->id) }}" method="POST"
                enctype="multipart/form-data" style="padding: 24px;">
                @csrf
                @method('PUT')

                <!-- Field 1: Nama Penghargaan -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Nama Penghargaan <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="nama_penghargaan" class="form-control"
                        value="{{ old('nama_penghargaan', $penghargaan->nama_penghargaan) }}"
                        placeholder="Contoh: Mahasiswa Berprestasi Tingkat Nasional"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('nama_penghargaan')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 2: Tingkat -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Tingkat <span style="color: red;">*</span>
                    </label>
                    <select name="tingkat" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                        <option value="">Pilih Tingkat</option>
                        <option value="internasional"
                            {{ old('tingkat', $penghargaan->tingkat) == 'internasional' ? 'selected' : '' }}>Internasional
                        </option>
                        <option value="nasional"
                            {{ old('tingkat', $penghargaan->tingkat) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="regional"
                            {{ old('tingkat', $penghargaan->tingkat) == 'regional' ? 'selected' : '' }}>Regional</option>
                        <option value="provinsi"
                            {{ old('tingkat', $penghargaan->tingkat) == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="universitas"
                            {{ old('tingkat', $penghargaan->tingkat) == 'universitas' ? 'selected' : '' }}>Universitas
                        </option>
                        <option value="kampus" {{ old('tingkat', $penghargaan->tingkat) == 'kampus' ? 'selected' : '' }}>
                            Kampus</option>
                    </select>
                    @error('tingkat')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 3: Pemberi Penghargaan -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Pemberi Penghargaan <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="pemberi_penghargaan" class="form-control"
                        value="{{ old('pemberi_penghargaan', $penghargaan->pemberi_penghargaan) }}"
                        placeholder="Contoh: Kementerian Pendidikan dan Kebudayaan"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('pemberi_penghargaan')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 4: Tahun Perolehan -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Tahun Perolehan <span style="color: red;">*</span>
                    </label>
                    <input type="number" name="tahun_perolehan" class="form-control"
                        value="{{ old('tahun_perolehan', $penghargaan->tahun_perolehan) }}" placeholder="Contoh: 2024"
                        min="1900" max="{{ date('Y') }}" step="1"
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('tahun_perolehan')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 5: Deskripsi -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                        placeholder="Jelaskan tentang penghargaan yang diterima..."
                        style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; font-family: inherit;">{{ old('deskripsi', $penghargaan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span style="color: var(--danger); font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 6: Upload File -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                        Upload Bukti (Opsional)
                    </label>

                    @if ($penghargaan->file_path)
                        <div style="padding: 12px; background: #f3f4f6; border-radius: 6px; margin-bottom: 12px;">
                            <p style="margin: 0; font-size: 14px; color: var(--text-secondary);">
                                <i class="fas fa-file"></i> File saat ini:
                                <a href="{{ Storage::url($penghargaan->file_path) }}" target="_blank"
                                    style="color: var(--brand);">
                                    {{ basename($penghargaan->file_path) }}
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
                        <small style="color: var(--muted);">Max 5MB (PDF, JPG, PNG)</small>
                    </div>
                    <input type="file" id="file_input" name="file_path" style="display: none;"
                        accept=".pdf,.jpg,.jpeg,.png">
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
                    <a href="{{ route('mahasiswa.penghargaan.list') }}" class="btn"
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
