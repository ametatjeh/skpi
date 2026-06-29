{{-- resources/views/fakultas/laporan/per-prodi.blade.php --}}
{{-- Partial: Breakdown statistik per program studi --}}

<div class="dashboard-card" style="margin-bottom:24px">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon"><i class="fas fa-building"></i></div>
            <h3>Statistik Per Program Studi</h3>
        </div>
    </div>
    <div class="card-body" style="padding:0">
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Program Studi</th>
                        <th>Total Pengajuan</th>
                        <th>Disetujui</th>
                        <th>Ditolak</th>
                        <th>Pending</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statsPerProdi ?? [] as $stat)
                        @php
                            $total = $stat['total'] ?? 0;
                            $approved = $stat['approved'] ?? 0;
                            $persen = $total > 0 ? round(($approved / $total) * 100) : 0;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $stat['nama_prodi'] ?? '-' }}</strong>
                            </td>
                            <td><strong>{{ $total }}</strong></td>
                            <td style="color:#15803d"><strong>{{ $approved }}</strong></td>
                            <td style="color:#dc2626"><strong>{{ $stat['rejected'] ?? 0 }}</strong></td>
                            <td style="color:#92400e"><strong>{{ $stat['pending'] ?? 0 }}</strong></td>
                            <td style="min-width:180px">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="flex:1;height:8px;background:#e5e7eb;border-radius:4px;overflow:hidden">
                                        <div style="height:100%;width:{{ $persen }}%;background:linear-gradient(90deg,#7c3aed,#a78bfa);border-radius:4px;transition:width 0.5s ease"></div>
                                    </div>
                                    <span style="font-size:12px;font-weight:700;color:#7c3aed;min-width:36px">{{ $persen }}%</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:#9ca3af">
                                <i class="fas fa-building" style="font-size:32px;opacity:0.3;display:block;margin-bottom:8px"></i>
                                Belum ada data per prodi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
