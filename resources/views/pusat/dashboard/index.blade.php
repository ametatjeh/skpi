@extends('pusat.layouts.app')
@section('title', 'Dashboard SKPI Pusat Bahasa')


@section('content')
    <div class="pusat-dashboard-header">
        <div class="pusat-title-main">Dashboard SKPI Pusat Bahasa</div>
        <div class="pusat-title-desc">Monitoring & review SKPI seluruh fakultas oleh pusat bahasa.</div>
    </div>

    <div class="pusat-summary-row">
        <div class="pusat-sum-card">
            <div class="pusat-sum-title"><i class="fas fa-inbox"></i> Draft Menunggu Verifikasi</div>
            <div class="pusat-sum-value">{{ $draftMenunggu ?? 0 }}</div>
        </div>
        <div class="pusat-sum-card green">
            <div class="pusat-sum-title"><i class="fas fa-check-circle"></i> Diterima (Approved)</div>
            <div class="pusat-sum-value">{{ $draftApproved ?? 0 }}</div>
        </div>
        <div class="pusat-sum-card red">
            <div class="pusat-sum-title"><i class="fas fa-times-circle"></i> Dikembalikan (Revisi)</div>
            <div class="pusat-sum-value">{{ $draftRevisi ?? 0 }}</div>
        </div>
        <div class="pusat-sum-card yellow">
            <div class="pusat-sum-title"><i class="fas fa-history"></i> Draft Final (Arsip)</div>
            <div class="pusat-sum-value">{{ $draftFinal ?? 0 }}</div>
        </div>
    </div>

    <div class="pusat-section-title">Draft SKPI Masuk (7 Terbaru)</div>
    <div class="pusat-draft-tbl-area">
        <table class="pusat-draft-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Prodi</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Status</th>
                    <th>Biling</th>
                    <th>Tgl Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($draftTerbaru as $i => $draft)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                        <td>{{ $draft->mahasiswa->nama ?? '-' }}</td>
                        <td>{{ $draft->mahasiswa->nim ?? '-' }}</td>
                        <td>
                            @if ($draft->status == 'final_issued')
                                <span class="pusat-badge-status pusat-badge-final">Final</span>
                            @elseif($draft->status == 'revisi_fakultas')
                                <span class="pusat-badge-status pusat-badge-revisi">Revisi Fakultas</span>
                            @else
                                <span class="pusat-badge-status pusat-badge-draft">{{ ucfirst($draft->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if (!empty($draft->ringkasan_en))
                                <span class="pusat-bilingual-dot green">EN</span>
                            @else
                                <span class="pusat-bilingual-dot red">-</span>
                            @endif
                        </td>
                        <td>{{ $draft->created_at ? $draft->created_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('pusat.verifikasi.show', $draft->id) }}" class="pusat-link-detail">Review</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; color:#9ca3af">Belum ada draft SKPI masuk pusat bahasa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
