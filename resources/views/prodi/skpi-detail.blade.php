{{-- resources/views/prodi/skpi-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail SKPI - Prodi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #f6f7fb;
            --text: #1a202c;
            --muted: #718096;
            --card: #ffffff;
            --line: #e2e8f0;
            --primary: #3182ce;
            --primary-600: #2b6cb0;
            --success: #38a169;
            --warn: #d69e2e;
            --danger: #e53e3e;
            --green-50: #c6f6d5;
            --yellow-50: #fefcbf;
            --red-50: #fed7d7;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, Noto Sans;
            background: var(--bg);
            color: var(--text)
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px
        }

        /* Header */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: saturate(180%) blur(8px);
            background: rgba(255, 255, 255, .8);
            border-bottom: 1px solid var(--line)
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .9rem 0
        }

        .title {
            display: flex;
            align-items: center;
            gap: .5rem
        }

        .title h1 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700
        }

        .crumb {
            color: var(--muted);
            font-size: .85rem
        }

        .crumb a {
            color: var(--primary);
            text-decoration: none
        }

        .crumb a:hover {
            text-decoration: underline
        }

        /* Layout */
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(17, 24, 39, .04);
            overflow: hidden
        }

        .card-h {
            padding: 14px 18px;
            border-bottom: 1px solid var(--line);
            background: linear-gradient(180deg, #fafcff, #fff);
            display: flex;
            align-items: center;
            gap: .5rem
        }

        .card-h h2 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700
        }

        .card-b {
            padding: 18px
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 14px
        }

        .label {
            font-size: .8rem;
            color: var(--muted);
            margin-bottom: 4px
        }

        .val {
            font-size: .98rem;
            color: var(--text)
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .28rem .7rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700
        }

        .b-wait {
            background: var(--yellow-50);
            color: var(--warn)
        }

        .b-ok {
            background: var(--green-50);
            color: var(--success)
        }

        .b-no {
            background: var(--red-50);
            color: var(--danger)
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: .5rem;
            overflow: auto;
            padding: 0 6px 6px
        }

        .tab {
            border: 1px solid var(--line);
            background: #fff;
            color: var(--muted);
            padding: .5rem .8rem;
            border-radius: 999px;
            font-size: .85rem;
            white-space: nowrap;
            text-decoration: none
        }

        .tab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary)
        }

        .section {
            scroll-margin-top: 90px
        }

        /* List */
        .list {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid var(--line)
        }

        .item:last-child {
            border-bottom: none
        }

        .muted {
            color: var(--muted);
            font-size: .85rem
        }

        /* Action bar */
        .actionbar {
            position: sticky;
            bottom: 0;
            backdrop-filter: saturate(180%) blur(8px);
            background: rgba(255, 255, 255, .9);
            border-top: 1px solid var(--line);
            padding: 12px 0
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border: none;
            border-radius: 10px;
            padding: .55rem 1rem;
            font-weight: 700;
            cursor: pointer
        }

        .btn.secondary {
            background: #edf2f7;
            color: #2d3748
        }

        .btn.primary {
            background: var(--primary);
            color: #fff
        }

        .btn.primary:hover {
            background: var(--primary-600)
        }

        .btn.danger {
            background: var(--danger);
            color: #fff
        }

        @media(min-width:880px) {
            .grid-2 {
                display: grid;
                grid-template-columns: 1.1fr .9fr;
                gap: 16px
            }
        }
    </style>
</head>

<body>

    <header class="topbar">
        <div class="container topbar-inner">
            <div class="title"><i class="fas fa-file-certificate" style="color:var(--primary)"></i>
                <h1>Detail SKPI</h1>
            </div>
            <div class="crumb">
                <a href="{{ route('prodi.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a> •
                <a href="{{ route('prodi.verifikasi') }}">Verifikasi</a> •
                <span>Detail</span>
            </div>
        </div>
    </header>

    <main class="container" style="padding:18px 0 80px">
        @php $mhs = optional($verif->mahasiswa); @endphp

        <div class="grid grid-2">
            <div class="grid">
                <div class="card">
                    <div class="card-h"><i class="fas fa-user-graduate"></i>
                        <h2>Profil Mahasiswa</h2>
                    </div>
                    <div class="card-b">
                        <div class="info-grid">
                            <div>
                                <div class="label">Nama Lengkap</div>
                                <div class="val">{{ $mhs->nama ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="label">NIM</div>
                                <div class="val">{{ $mhs->nim ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="label">Program Studi</div>
                                <div class="val">{{ optional($mhs->prodi)->nama_prodi ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="label">TTL</div>
                                <div class="val">{{ $mhs->tempat_lahir ?? '-' }},
                                    {{ optional($mhs->tanggal_lahir)->format('d M Y') ?? (optional(\Illuminate\Support\Carbon::parse($mhs->tanggal_lahir ?? null))->format('d M Y') ?? '-') }}
                                </div>
                            </div>
                            <div>
                                <div class="label">Tahun Masuk</div>
                                <div class="val">{{ $mhs->tahun_masuk ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-h"><i class="fas fa-clipboard-check"></i>
                        <h2>Pengajuan & Status</h2>
                    </div>
                    <div class="card-b">
                        <div class="info-grid">
                            <div>
                                <div class="label">Tanggal Pengajuan (Prodi)</div>
                                <div class="val">
                                    {{ optional($verif->tanggal_pengajuan)->translatedFormat('d M Y') ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="label">Status Verifikasi Prodi</div>
                                <div class="val">
                                    @php
                                        $map = [
                                            'diajukan' => ['b-wait', '<i class="fas fa-clock"></i> Menunggu'],
                                            'disetujui_prodi' => [
                                                'b-ok',
                                                '<i class="fas fa-check"></i> Disetujui Prodi',
                                            ],
                                            'ditolak_prodi' => ['b-no', '<i class="fas fa-times"></i> Ditolak Prodi'],
                                        ];
                                        [$cls, $lbl] = $map[$verif->status] ?? ['badge', '-'];
                                    @endphp
                                    <span class="badge {{ $cls }}">{!! $lbl !!}</span>
                                </div>
                            </div>
                            <div>
                                <div class="label">Status SKPI Global</div>
                                <div class="val">
                                    {{ $skpi ? \Illuminate\Support\Str::title(str_replace('_', ' ', $skpi->status)) : 'Belum dibuat' }}
                                </div>
                            </div>
                            <div>
                                <div class="label">Tanggal Pengajuan SKPI</div>
                                <div class="val">
                                    {{ optional(optional($skpi)->tanggal_pengajuan)->translatedFormat('d M Y') ?? '-' }}
                                </div>
                            </div>
                            @if (optional($skpi)->catatan)
                                <div style="grid-column:1/-1">
                                    <div class="label">Catatan SKPI</div>
                                    <div class="val">{{ $skpi->catatan }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-h"><i class="fas fa-list"></i>
                    <h2>Navigasi Kategori</h2>
                </div>
                <div class="card-b">
                    <div class="tabs">
                        <a href="#prestasi" class="tab active">Prestasi</a>
                        <a href="#organisasi" class="tab">Organisasi</a>
                        <a href="#karya" class="tab">Karya Ilmiah</a>
                        <a href="#sertifikasi" class="tab">Sertifikasi</a>
                        <a href="#pengabdian" class="tab">Pengabdian</a>
                        <a href="#penghargaan" class="tab">Penghargaan</a>
                    </div>
                    <div class="muted" style="margin-top:8px">Klik tab untuk melompat ke bagian.</div>
                </div>
            </div>
        </div>

        {{-- Sections --}}
        <section id="prestasi" class="section card">
            <div class="card-h"><i class="fas fa-trophy"></i>
                <h2>Prestasi</h2>
            </div>
            <div class="card-b">
                @php $items=$mhs->prestasi ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div><strong>{{ $it->nama_kegiatan }}</strong>
                                    <div class="muted">Tingkat: {{ $it->tingkat }} • Tahun: {{ $it->tahun }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data prestasi</div>
                @endif
            </div>
        </section>

        <section id="organisasi" class="section card">
            <div class="card-h"><i class="fas fa-users"></i>
                <h2>Organisasi</h2>
            </div>
            <div class="card-b">
                @php $items=$mhs->organisasi ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div><strong>{{ $it->nama_organisasi }}</strong>
                                    <div class="muted">Jabatan: {{ $it->jabatan }} • Periode: {{ $it->periode }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data organisasi</div>
                @endif
            </div>
        </section>

        <section id="karya" class="section card">
            <div class="card-h"><i class="fas fa-book"></i>
                <h2>Karya Ilmiah</h2>
            </div>
            <div class="card-b">
                @php $items=$mhs->karyaIlmiah ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div><strong>{{ $it->judul }}</strong>
                                    <div class="muted">Jenis: {{ $it->jenis ?? '-' }} • Tahun:
                                        {{ $it->tahun ?? '-' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data karya ilmiah</div>
                @endif
            </div>
        </section>

        <section id="sertifikasi" class="section card">
            <div class="card-h"><i class="fas fa-certificate"></i>
                <h2>Sertifikasi Kompetensi</h2>
            </div>
            <div class="card-b">
                @php $items=$mhs->sertifikasiKompetensi ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div><strong>{{ $it->nama_sertifikasi }}</strong>
                                    <div class="muted">Penyelenggara: {{ $it->penyelenggara ?? '-' }} • Tahun:
                                        {{ $it->tahun ?? '-' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data sertifikasi</div>
                @endif
            </div>
        </section>

        <section id="pengabdian" class="section card">
            <div class="card-h"><i class="fas fa-hands-helping"></i>
                <h2>Pengabdian Masyarakat</h2>
            </div>
            <div class="card-b">
                @php $items=$mhs->pengabdianMasyarakat ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div><strong>{{ $it->nama_kegiatan }}</strong>
                                    <div class="muted">Peran: {{ $it->peran ?? '-' }} • Tahun:
                                        {{ $it->tahun ?? '-' }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data pengabdian</div>
                @endif
            </div>
        </section>

        <section id="penghargaan" class="section card">
            <div class="card-h"><i class="fas fa-medal"></i>
                <h2>Penghargaan</h2>
            </div>
            <div class="card-b">
                @php $items = $v_penghargaan ?? collect(); @endphp
                @if ($items->count())
                    <ul class="list">
                        @foreach ($items as $it)
                            <li class="item">
                                <div>
                                    <strong>{{ $it->nama_penghargaan }}</strong>
                                    <div class="muted">
                                        Penyelenggara: {{ $it->penyelenggara ?? '-' }}
                                        • Tingkat: {{ $it->tingkat ?? '-' }}
                                        • Tahun: {{ $it->tahun ?? '-' }}
                                    </div>
                                    @if (!empty($it->deskripsi))
                                        <div class="muted">{{ $it->deskripsi }}</div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="muted">Belum ada data penghargaan</div>
                @endif
            </div>
        </section>


    </main>

    <footer class="actionbar">
        <div class="container">
            <div class="actions">
                <a href="{{ route('prodi.verifikasi') }}" class="btn secondary"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                @if ($verif->status === 'diajukan')
                    <button class="btn primary" onclick="approveVerif({{ $verif->id }})"><i
                            class="fas fa-check"></i> Setujui</button>
                    <button class="btn danger" onclick="rejectVerif({{ $verif->id }})"><i
                            class="fas fa-times"></i> Tolak</button>
                @endif
            </div>
        </div>
    </footer>

    <script>
        async function postJsonOrRedirect(url, payload = null) {
            const init = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            };
            if (payload !== null) {
                init.headers['Content-Type'] = 'application/json';
                init.body = JSON.stringify(payload);
            }
            const r = await fetch(url, init);
            const ct = r.headers.get('content-type') || '';
            if (ct.includes('application/json')) {
                const data = await r.json();
                if (!r.ok) throw data;
                return data;
            } else {
                const html = await r.text();
                if (r.ok) return {
                    success: true,
                    message: 'Berhasil diproses.'
                };
                throw {
                    message: 'Gagal memproses: ' + html.slice(0, 200)
                };
            }
        }

        async function approveVerif(verifId) {
            try {
                if (!confirm('Setujui pengajuan ini?')) return;
                const data = await postJsonOrRedirect(`{{ url('/prodi/skpi') }}/${verifId}/approve`);
                alert(data.message || 'SKPI berhasil diverifikasi!');
                window.location.href = '{{ route('prodi.verifikasi') }}';
            } catch (e) {
                alert((e && e.message) ? e.message : 'Terjadi kesalahan saat menyetujui.');
            }
        }

        async function rejectVerif(verifId) {
            try {
                const catatan = prompt('Masukkan alasan penolakan (minimal 10 karakter):');
                if (catatan === null) return;
                if (!catatan.trim() || catatan.trim().length < 10) {
                    alert('Alasan penolakan harus minimal 10 karakter');
                    return;
                }
                const data = await postJsonOrRedirect(`{{ url('/prodi/skpi') }}/${verifId}/reject`, {
                    catatan: catatan.trim()
                });
                alert(data.message || 'SKPI berhasil ditolak!');
                window.location.href = '{{ route('prodi.verifikasi') }}';
            } catch (e) {
                alert((e && e.message) ? e.message : 'Terjadi kesalahan saat menolak.');
            }
        }
    </script>

</body>

</html>

