<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ... HEAD Tetap (CSS & Style sama seperti sebelumnya) ... -->
</head>

<body>
    <!-- ... HEADER, BREADCRUMB, FOOTER Tetap ... -->

    <main class="main-content">
        <div class="container">
            @if (session('success'))
                <div style="background:#DEF7EC;color:#03543F;padding:.75rem 1rem;border-radius:6px;margin-bottom:1rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div style="background:#FDE8E8;color:#9B1C1C;padding:.75rem 1rem;border-radius:6px;margin-bottom:1rem;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="filter-section">
                <form method="GET" action="{{ route('prodi.verifikasi') }}">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="filter-select">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Menunggu Verifikasi</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                    Ditolak</option>
                                <option value="revision_required"
                                    {{ request('status') == 'revision_required' ? 'selected' : '' }}>
                                    Perlu Revisi</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="search">Cari Nama/NIM</label>
                            <input type="text" name="search" id="search" class="filter-input"
                                placeholder="Nama atau NIM..." value="{{ request('search') }}">
                        </div>
                        <div class="filter-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="filter-select">
                                <option value="">Semua Tahun</option>
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}"
                                        {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="filter-group">
                            <button type="submit" class="filter-btn"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('prodi.verifikasi') }}" class="btn btn-secondary"
                                style="margin-left:.5rem;">
                                <i class="fas fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="applications-section">
                <div class="section-header">
                    <h2>Daftar Pengajuan SKPI</h2>
                    <div class="table-info">Menampilkan {{ $verifikasi->count() }} dari {{ $verifikasi->total() }}
                        pengajuan</div>
                </div>
                <div class="applications-content">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Mahasiswa</th>
                                <th>NIM</th>
                                <th>Program Studi</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($verifikasi as $v)
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-name">{{ $v->mahasiswa->nama ?? '-' }}</div>
                                            <div class="student-email" style="font-size:.75rem;color:#718096;">
                                                {{ $v->mahasiswa->user->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $v->mahasiswa->nim }}</td>
                                    <td>{{ $v->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                                    <td>
                                        @php
                                            $tgl = $v->tanggal_pengajuan ?? $v->created_at;
                                        @endphp
                                        {{ \Illuminate\Support\Carbon::parse($tgl)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @if ($v->status === 'pending')
                                            <span class="status-badge status-pending"><i class="fas fa-clock"></i>
                                                Menunggu</span>
                                        @elseif ($v->status === 'approved')
                                            <span class="status-badge status-verified"><i class="fas fa-check"></i>
                                                Disetujui</span>
                                        @elseif ($v->status === 'rejected')
                                            <span class="status-badge status-rejected"><i class="fas fa-times"></i>
                                                Ditolak</span>
                                        @elseif ($v->status === 'revision_required')
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-edit"></i> Revisi
                                            </span>
                                        @else
                                            <span class="status-badge">{{ $v->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('prodi.verifikasi.detail', $v->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            @if ($v->status === 'pending')
                                                <form action="{{ route('prodi.verifikasi.approve', $v->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Setujui pengajuan SKPI ini?')">
                                                        <i class="fas fa-check"></i> Setuju
                                                    </button>
                                                </form>
                                                <form action="{{ route('prodi.verifikasi.reject', $v->id) }}"
                                                    method="POST" style="display:none;"
                                                    id="rejectForm{{ $v->id }}">
                                                    @csrf
                                                    <input type="hidden" name="catatan"
                                                        id="rejectCatatan{{ $v->id }}">
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="showRejectPrompt({{ $v->id }})">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            @endif
                                            @if ($v->status === 'revision_required')
                                                <span style="font-size:.85rem;color:#718096;">Menunggu revisi
                                                    mahasiswa</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h3>Tidak ada pengajuan SKPI</h3>
                                        <p>Belum ada mahasiswa yang mengajukan SKPI</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($verifikasi->hasPages())
                    <div class="pagination" style="padding:1.5rem;border-top:1px solid #e2e8f0;">
                        {{ $verifikasi->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- ... FOOTER Tetap ... -->
    <script>
        function showRejectPrompt(id) {
            const catatan = prompt('Masukkan alasan penolakan (minimal 10 karakter):');
            if (catatan === null) return;
            if (catatan.trim() === '') return alert('Alasan penolakan tidak boleh kosong!');
            if (catatan.length < 10) return alert('Alasan penolakan harus minimal 10 karakter!');
            document.getElementById('rejectCatatan' + id).value = catatan;
            document.getElementById('rejectForm' + id).submit();
        }
    </script>
</body>

</html>

