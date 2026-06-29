{{-- 
    Partial: Dashboard Statistics Cards
    Variabel: $totalPengajuan, $pengajuanBaru, $disetujui, $ditolak (dari DashboardProdiController)
    Include: @include('prodi.dashboard.statistics')
--}}

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon cyan">
            <i class="fas fa-inbox"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalPengajuan ?? 0 }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </div>
        <div class="stat-trend">
            @if(isset($pengajuanBulanIni) && $pengajuanBulanIni > 0)
                <span class="trend-badge up">
                    <i class="fas fa-arrow-up"></i> {{ $pengajuanBulanIni }} bulan ini
                </span>
            @endif
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon amber">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $pengajuanBaru ?? 0 }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
        @if(isset($melebihiSla) && $melebihiSla > 0)
            <div class="stat-trend">
                <span class="trend-badge warning">
                    <i class="fas fa-exclamation-triangle"></i> {{ $melebihiSla }} melebihi SLA
                </span>
            </div>
        @endif
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $disetujui ?? 0 }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        @if(isset($disetujuiBulanIni) && $disetujuiBulanIni > 0)
            <div class="stat-trend">
                <span class="trend-badge up">
                    <i class="fas fa-arrow-up"></i> {{ $disetujuiBulanIni }} bulan ini
                </span>
            </div>
        @endif
    </div>

    <div class="stat-card">
        <div class="stat-icon red">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $ditolak ?? 0 }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-icon.cyan {
        background: linear-gradient(135deg, #0891b2, #22d3ee);
        color: #fff;
    }

    .stat-icon.amber {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #fff;
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: #fff;
    }

    .stat-icon.red {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: #fff;
    }

    .stat-info {
        flex: 1;
        min-width: 0;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #1f2937;
        line-height: 1;
    }

    .stat-label {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
        margin-top: 4px;
    }

    .stat-trend {
        position: absolute;
        top: 12px;
        right: 14px;
    }

    .trend-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .trend-badge.up {
        background: #dcfce7;
        color: #15803d;
    }

    .trend-badge.warning {
        background: #fef3c7;
        color: #92400e;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
