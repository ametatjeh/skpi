@extends('layouts.app')

@section('content')
    <div class="wrap">
        <header class="head">
            <div class="head__left">
                <h1 class="head__title">Laporan SKPI - Prodi</h1>
                <p class="head__subtitle">Ringkasan pengajuan, verifikasi, dan status akhir</p>
            </div>
            <form method="GET" action="{{ route('prodi.laporan') }}" class="filters">
                <select name="bulan" class="field">
                    <option value="">Semua Bulan</option>
                    @for ($b = 1; $b <= 12; $b++)
                        <option value="{{ $b }}" {{ (int) request('bulan') === $b ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
                <select name="tahun" class="field">
                    <option value="">Semua Tahun</option>
                    @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                        <option value="{{ $t }}" {{ (int) request('tahun') === $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endfor
                </select>
                <button class="btn btn--primary">Terapkan</button>
                <a href="{{ route('prodi.laporan') }}" class="btn btn--ghost">Reset</a>
            </form>
        </header>

        <section class="stats">
            <article class="card stat">
                <span class="stat__label">Total SKPI</span>
                <span class="stat__value">{{ number_format($stats['total_skpi']) }}</span>
            </article>
            <article class="card stat">
                <span class="stat__label">Diajukan</span>
                <span class="stat__value">{{ number_format($stats['skpi_diajukan']) }}</span>
            </article>
            <article class="card stat">
                <span class="stat__label">Diverifikasi Prodi</span>
                <span class="stat__value">{{ number_format($stats['skpi_diverifikasi']) }}</span>
            </article>
            <article class="card stat">
                <span class="stat__label">Ditolak Prodi</span>
                <span class="stat__value">{{ number_format($stats['skpi_ditolak']) }}</span>
            </article>
            <article class="card stat">
                <span class="stat__label">Disahkan</span>
                <span class="stat__value">{{ number_format($stats['skpi_disahkan']) }}</span>
            </article>
        </section>

        <section class="card">
            <header class="card__head">
                <h2 class="card__title">Tren Pengajuan</h2>
            </header>
            <div class="card__body">
                @if (count($tren))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Jumlah Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tren as $r)
                                <tr>
                                    <td>{{ $r['label'] }}</td>
                                    <td>{{ $r['jumlah'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="muted">Tidak ada data tren pada periode ini.</p>
                @endif
            </div>
        </section>

        <section class="card">
            <header class="card__head">
                <h2 class="card__title">Pengajuan Terbaru</h2>
            </header>
            <div class="card__body">
                @if ($terbaru->count())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terbaru as $v)
                                <tr>
                                    <td>{{ optional($v->mahasiswa)->nim ?? '-' }}</td>
                                    <td>{{ optional($v->mahasiswa)->nama ?? '-' }}</td>
                                    <td>{{ optional($v->tanggal_pengajuan)->translatedFormat('d M Y') ?? '-' }}</td>
                                    <td>
                                        @php
                                            $map = [
                                                'diajukan' => 'badge badge--pending',
                                                'disetujui_prodi' => 'badge badge--ok',
                                                'ditolak_prodi' => 'badge badge--danger',
                                            ];
                                            $cls = $map[$v->status] ?? 'badge';
                                        @endphp
                                        <span
                                            class="{{ $cls }}">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $v->status)) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="muted">Belum ada pengajuan pada periode ini.</p>
                @endif
            </div>
        </section>
    </div>
@endsection

