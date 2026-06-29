{{-- resources/views/fakultas/laporan/verifikasi-fakultas.blade.php --}}
{{-- Partial: Rekap verifikasi di level fakultas dengan pie chart --}}

<div class="dashboard-card" style="margin-bottom:24px">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon"><i class="fas fa-chart-pie"></i></div>
            <h3>Rekap Verifikasi Fakultas</h3>
        </div>
    </div>
    <div class="card-body" style="padding:24px">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:center">
            <div>
                <canvas id="verifikasiPieChart" height="250"></canvas>
            </div>
            <div>
                <div style="display:flex;flex-direction:column;gap:14px">
                    <div style="display:flex;align-items:center;gap:12px;padding:14px;background:#f0fdf4;border-radius:12px;border:1px solid #bbf7d0">
                        <div style="width:12px;height:12px;border-radius:50%;background:#22c55e"></div>
                        <div style="flex:1">
                            <div style="font-size:12px;color:#6b7280;font-weight:600">Disetujui</div>
                            <div style="font-size:22px;font-weight:800;color:#15803d">{{ $stat['total_final'] ?? $totalApproved ?? 0 }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;padding:14px;background:#fef2f2;border-radius:12px;border:1px solid #fecaca">
                        <div style="width:12px;height:12px;border-radius:50%;background:#ef4444"></div>
                        <div style="flex:1">
                            <div style="font-size:12px;color:#6b7280;font-weight:600">Ditolak</div>
                            <div style="font-size:22px;font-weight:800;color:#dc2626">{{ $stat['total_revisi'] ?? $totalRejected ?? 0 }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;padding:14px;background:#fef3c7;border-radius:12px;border:1px solid #fbbf24">
                        <div style="width:12px;height:12px;border-radius:50%;background:#f59e0b"></div>
                        <div style="flex:1">
                            <div style="font-size:12px;color:#6b7280;font-weight:600">Pending</div>
                            <div style="font-size:22px;font-weight:800;color:#92400e">{{ $stat['total_pending'] ?? $totalPending ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('verifikasiPieChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Disetujui', 'Ditolak', 'Pending'],
                    datasets: [{
                        data: [
                            {{ $stat['total_final'] ?? $totalApproved ?? 0 }},
                            {{ $stat['total_revisi'] ?? $totalRejected ?? 0 }},
                            {{ $stat['total_pending'] ?? $totalPending ?? 0 }}
                        ],
                        backgroundColor: ['#22c55e', '#ef4444', '#f59e0b'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '65%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    });
</script>
@endpush
