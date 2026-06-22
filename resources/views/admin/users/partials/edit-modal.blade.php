{{-- resources/views/admin/users/partials/edit-modal.blade.php --}}
<div id="editModal{{ $user->id }}" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit Data Mahasiswa</h3>
            <a href="#" class="close-modal">&times;</a>
        </div>

        <form action="{{ route('admin.mahasiswa.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- SECTION: Data Login --}}
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                    <i class="fas fa-lock"></i> Data Login
                </h4>

                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            {{-- SECTION: Data Pribadi --}}
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                    <i class="fas fa-user"></i> Data Pribadi
                </h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>NIM <span class="required">*</span></label>
                        <input type="text" name="nim" class="form-control" value="{{ $user->nim }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIK (KTP)</label>
                        <input type="text" name="nik" class="form-control" value="{{ $user->nik }}"
                            maxlength="16">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="required">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Agama <span class="required">*</span></label>
                        <select name="agama" class="form-control" required>
                            <option value="Islam" {{ $user->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $user->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $user->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $user->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $user->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ $user->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Tempat, Tanggal Lahir <span class="required">*</span></label>
                    <input type="text" name="tempat_tanggal_lahir" class="form-control"
                        value="{{ $user->tempat_tanggal_lahir }}" required>
                </div>

                <div class="form-group full-width">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ $user->alamat }}</textarea>
                </div>
            </div>

            {{-- SECTION: Data Akademik --}}
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="font-size: 15px; font-weight: 700; color: #1e40af; margin-bottom: 15px;">
                    <i class="fas fa-graduation-cap"></i> Data Akademik
                </h4>

                <div class="form-group full-width">
                    <label>Program Studi <span class="required">*</span></label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">Pilih Program Studi</option>
                        @php
                            $prodis = \App\Models\Prodi::orderBy('nama_prodi')->get();
                        @endphp
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ $user->prodi_id == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }} (Fakultas ID: {{ $prodi->fakultas_id }})
                            </option>
                        @endforeach

                        {{-- Handle prodi_id yang tidak ada di master --}}
                        @if ($user->prodi_id && !$prodis->contains('id', $user->prodi_id))
                            <option value="{{ $user->prodi_id }}" selected>
                                Prodi ID: {{ $user->prodi_id }} (Data lama)
                            </option>
                        @endif
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tahun Masuk <span class="required">*</span></label>
                        <input type="number" name="tahun_masuk" class="form-control" value="{{ $user->tahun_masuk }}"
                            min="1900" max="{{ date('Y') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Angkatan <span class="required">*</span></label>
                        <input type="number" name="angkatan" class="form-control" value="{{ $user->angkatan }}"
                            min="1900" max="{{ date('Y') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Masuk <span class="required">*</span></label>
                        <input type="date" name="tanggal_masuk" class="form-control"
                            value="{{ $user->tanggal_masuk ? \Carbon\Carbon::parse($user->tanggal_masuk)->format('Y-m-d') : '' }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status Mahasiswa <span class="required">*</span></label>
                        <select name="status_mahasiswa" class="form-control" required>
                            <option value="Aktif" {{ $user->status_mahasiswa == 'Aktif' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="Cuti" {{ $user->status_mahasiswa == 'Cuti' ? 'selected' : '' }}>Cuti
                            </option>
                            <option value="Lulus" {{ $user->status_mahasiswa == 'Lulus' ? 'selected' : '' }}>Lulus
                            </option>
                            <option value="DO" {{ $user->status_mahasiswa == 'DO' ? 'selected' : '' }}>DO (Drop
                                Out)</option>
                            <option value="Mengundurkan Diri"
                                {{ $user->status_mahasiswa == 'Mengundurkan Diri' ? 'selected' : '' }}>Mengundurkan
                                Diri</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- SECTION: Data Kelulusan --}}
            <div style="background: #fef3c7; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="font-size: 15px; font-weight: 700; color: #92400e; margin-bottom: 15px;">
                    <i class="fas fa-award"></i> Data Kelulusan (Opsional)
                </h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Lulus</label>
                        <input type="date" name="tanggal_lulus" class="form-control"
                            value="{{ $user->tanggal_lulus ? \Carbon\Carbon::parse($user->tanggal_lulus)->format('Y-m-d') : '' }}">
                    </div>

                    <div class="form-group">
                        <label>Gelar</label>
                        <input type="text" name="gelar" class="form-control" value="{{ $user->gelar }}"
                            maxlength="20">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Nomor Ijazah</label>
                    <input type="text" name="no_ijazah" class="form-control" value="{{ $user->no_ijazah }}"
                        maxlength="100">
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                <i class="fas fa-save"></i> Update Data Mahasiswa
            </button>
        </form>
    </div>
</div>
