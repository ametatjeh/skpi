{{-- 
    Partial: Recent Activities 
    Variabel: $aktivitasTerbaru (dari DashboardProdiController)
    Include: @include('prodi.dashboard.recent-activities', ['aktivitasTerbaru' => $aktivitasTerbaru])
--}}

<div class="dashboard-card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24); color: #fff;">
                <i class="fas fa-clock"></i>
            </div>
            <h3>Aktivitas Terbaru</h3>
        </div>
    </div>
    <div class="card-body">
        @if(isset($aktivitasTerbaru) && $aktivitasTerbaru->count() > 0)
            <div class="activity-list">
                @foreach($aktivitasTerbaru as $aktivitas)
                    <div class="activity-item">
                        <div class="activity-icon {{ $aktivitas->action == 'approve' ? 'green' : ($aktivitas->action == 'reject' ? 'red' : 'blue') }}">
                            @if($aktivitas->action == 'approve')
                                <i class="fas fa-check"></i>
                            @elseif($aktivitas->action == 'reject')
                                <i class="fas fa-times"></i>
                            @else
                                <i class="fas fa-edit"></i>
                            @endif
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">
                                <strong>{{ $aktivitas->approver->name ?? 'Verifikator' }}</strong>
                                @if($aktivitas->action == 'approve')
                                    menyetujui
                                @elseif($aktivitas->action == 'reject')
                                    menolak
                                @else
                                    memproses
                                @endif
                                pengajuan 
                                <strong>{{ $aktivitas->verifikasiSkpi->mahasiswa->nama ?? '-' }}</strong>
                            </div>
                            <div class="activity-time">
                                <i class="fas fa-clock"></i>
                                {{ $aktivitas->created_at ? $aktivitas->created_at->diffForHumans() : '-' }}
                            </div>
                            @if($aktivitas->catatan)
                                <div class="activity-note">
                                    <i class="fas fa-comment"></i>
                                    {{ Str::limit($aktivitas->catatan, 80) }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state-small">
                <i class="fas fa-inbox"></i>
                <p>Belum ada aktivitas terbaru</p>
            </div>
        @endif
    </div>
</div>

<style>
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .activity-item {
        display: flex;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #f1f5f9;
        align-items: flex-start;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .activity-icon.green {
        background: #dcfce7;
        color: #15803d;
    }

    .activity-icon.red {
        background: #fee2e2;
        color: #b91c1c;
    }

    .activity-icon.blue {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-text {
        font-size: 13px;
        color: #374151;
        line-height: 1.5;
    }

    .activity-text strong {
        color: #1f2937;
    }

    .activity-time {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .activity-note {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
        padding: 6px 10px;
        background: #f8fafc;
        border-radius: 6px;
        border-left: 3px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        gap: 6px;
    }

    .empty-state-small {
        text-align: center;
        padding: 30px 16px;
        color: #9ca3af;
    }

    .empty-state-small i {
        font-size: 32px;
        margin-bottom: 8px;
        display: block;
        color: #d1d5db;
    }

    .empty-state-small p {
        font-size: 13px;
        margin: 0;
    }
</style>
