{{-- resources/views/fakultas/laporan/monitoring-waktu.blade.php --}}
{{-- Partial: SLA Monitoring Chart --}}

<div class="dashboard-card" style="margin-bottom:24px">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon"><i class="fas fa-clock"></i></div>
            <h3>Monitoring Waktu Proses</h3>
        </div>
    </div>
    <div class="card-body" style="padding:24px">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px">
            <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);padding:20px;border-radius:14px;border:1px solid #bbf7d0">
                <div style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;margin-bottom:6px">Rata-rata Proses</div>
                <div style="font-size:28px;font-weight:800;color:#15803d">{{ $avgDays ?? 3 }} hari</div>
                <div style="font-size:12px;color:#16a34a;margin-top:4px"><i class="fas fa-arrow-down"></i> Dalam target SLA</div>
            </div>
            <div style="background:linear-gradient(135deg,#fef3c7,#fde68a);padding:20px;border-radius:14px;border:1px solid #fbbf24">
                <div style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;margin-bottom:6px">Terlama</div>
                <div style="font-size:28px;font-weight:800;color:#92400e">{{ $maxDays ?? 14 }} hari</div>
                <div style="font-size:12px;color:#a16207;margin-top:4px"><i class="fas fa-exclamation-triangle"></i> Perlu perhatian</div>
            </div>
            <div style="background:linear-gradient(135deg,#f3e8ff,#ede9fe);padding:20px;border-radius:14px;border:1px solid #c4b5fd">
                <div style="font-size:12px;font-weight:600;color:#6b7280;text-transform:uppercase;margin-bottom:6px">Total Diproses</div>
                <div style="font-size:28px;font-weight:800;color:#7c3aed">{{ $totalProcessed ?? 0 }}</div>
                <div style="font-size:12px;color:#7c3aed;margin-top:4px"><i class="fas fa-check"></i> Bulan ini</div>
            </div>
        </div>
        <canvas id="slaChart" height="200"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('slaChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($slaLabels ?? ['Jan','Feb','Mar','Apr','Mei','Jun']) !!},
                    datasets: [{
                        label: 'Rata-rata Hari Proses',
                        data: {!! json_encode($slaData ?? [3,2,4,3,5,2]) !!},
                        backgroundColor: 'rgba(124, 58, 237, 0.2)',
                        borderColor: '#7c3aed',
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Hari' } }
                    }
                }
            });
        }
    });
</script>
@endpush
