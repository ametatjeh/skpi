{{-- resources/views/fakultas/laporan/skpi-terbit.blade.php --}}
{{-- Partial: List SKPI yang sudah final/terbit --}}

<div class="dashboard-card" style="margin-bottom:24px">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon" style="background:linear-gradient(135deg,#059669,#10b981)"><i class="fas fa-certificate"></i></div>
            <h3>SKPI Terbit</h3>
        </div>
        <span style="padding:6px 14px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);color:#15803d;border-radius:20px;font-size:12px;font-weight:700">
            {{ count($listFinal ?? []) }} SKPI
        </span>
    </div>
    <div class="card-body" style="padding:0">
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Nomor SKPI</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listFinal ?? [] as $draft)
                        <tr>
                            <td><strong>{{ $draft->mahasiswa->nama ?? '-' }}</strong></td>
                            <td>{{ $draft->mahasiswa->nim ?? '-' }}</td>
                            <td>{{ $draft->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                            <td>
                                <span style="padding:4px 10px;background:#f3e8ff;color:#7c3aed;border-radius:6px;font-size:12px;font-weight:600">
                                    {{ $draft->nomor_skpi ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $draft->updated_at ? $draft->updated_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('fakultas.arsip.show', $draft->id) }}" style="padding:6px 12px;background:linear-gradient(135deg,#7c3aed,#8b5cf6);color:#fff;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('fakultas.arsip.download.pdf', $draft->id) }}" style="padding:6px 12px;background:#059669;color:#fff;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px;margin-left:4px">
                                    <i class="fas fa-download"></i> PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:#9ca3af">
                                <i class="fas fa-certificate" style="font-size:32px;opacity:0.3;display:block;margin-bottom:8px"></i>
                                Belum ada SKPI terbit
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
