@extends('fakultas.layouts.app')
@section('title', 'Monitoring Verifikasi')

@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }

    .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:18px; margin-bottom:24px; }
    .stat-card { background:#fff; border-radius:16px; padding:22px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); display:flex; align-items:center; gap:16px; transition:all 0.3s; position:relative; overflow:hidden; }
    .stat-card::before { content:''; position:absolute; top:0; left:0; width:4px; height:100%; border-radius:4px 0 0 4px; }
    .stat-card:hover { transform:translateY(-4px); box-shadow:0 8px 30px rgba(0,0,0,0.08); }
    .stat-card.purple::before { background:linear-gradient(180deg,#7c3aed,#a78bfa); }
    .stat-card.green::before { background:linear-gradient(180deg,#10b981,#34d399); }
    .stat-card.yellow::before { background:linear-gradient(180deg,#f59e0b,#fbbf24); }
    .stat-card.blue::before { background:linear-gradient(180deg,#3b82f6,#60a5fa); }
    .stat-icon { width:52px; height:52px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
    .stat-card.purple .stat-icon { background:linear-gradient(135deg,#f3e8ff,#ede9fe); color:#7c3aed; }
    .stat-card.green .stat-icon { background:linear-gradient(135deg,#dcfce7,#d1fae5); color:#10b981; }
    .stat-card.yellow .stat-icon { background:linear-gradient(135deg,#fef3c7,#fde68a); color:#f59e0b; }
    .stat-card.blue .stat-icon { background:linear-gradient(135deg,#dbeafe,#bfdbfe); color:#3b82f6; }
    .stat-label { font-size:12px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px; }
    .stat-value { font-size:28px; font-weight:800; color:#111827; line-height:1; }

    .dashboard-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; margin-bottom:24px; }
    .card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#faf5ff,#f3e8ff); }
    .card-header-left { display:flex; align-items:center; gap:12px; }
    .card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:16px; }
    .card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .modern-table { width:100%; border-collapse:collapse; }
    .modern-table thead th { padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
    .modern-table tbody td { padding:14px 20px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#374151; }
    .modern-table tbody tr:hover { background:#faf5ff; }

    @media (max-width:768px) { .stats-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-tachometer-alt" style="margin-right:10px"></i> Monitoring Verifikasi</h1>
        <p>Pantau kinerja dan SLA proses verifikasi SKPI fakultas</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card green">
            <div class="stat-icon"><i class="fas fa-check-double"></i></div>
            <div>
                <div class="stat-label">Total Diproses</div>
                <div class="stat-value">{{ $totalProcessed ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $totalPending ?? 0 }}</div>
            </div>
        </div>
        <div class="stat-card blue">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-label">Rata-rata Proses</div>
                <div class="stat-value">{{ $avgDays ?? 0 }} <small style="font-size:14px;font-weight:600">hari</small></div>
            </div>
        </div>
        <div class="stat-card purple">
            <div class="stat-icon"><i class="fas fa-trophy"></i></div>
            <div>
                <div class="stat-label">SKPI Final</div>
                <div class="stat-value">{{ $totalFinal ?? 0 }}</div>
            </div>
        </div>
    </div>

    @include('fakultas.laporan.per-prodi', ['statsPerProdi' => $statsPerProdi ?? []])
@endsection
