@extends('prodi.layouts.app')

@section('title', 'Verifikasi SKPI')

@section('content')
<style>
    /* ============ VERIFIKASI SKPI PREMIUM STYLES ============ */
    .verifikasi-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Header Section */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    
    .page-header-left h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .page-header-left p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }
    
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .stat-card.active {
        border: 2px solid #059669;
        background: #ecfdf5;
    }
    
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }
    
    .stat-card.all .stat-icon { background: #d1fae5; color: #059669; }
    .stat-card.pending .stat-icon { background: #fef3c7; color: #f59e0b; }
    .stat-card.approved .stat-icon { background: #dcfce7; color: #10b981; }
    .stat-card.rejected .stat-icon { background: #fee2e2; color: #ef4444; }
    .stat-card.revision .stat-icon { background: #f3e8ff; color: #7c3aed; }
    
    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* Filter Section */
    .filter-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
    }
    
    .filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    
    .filter-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .filter-title i {
        color: #059669;
    }
    
    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 16px;
        align-items: end;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .form-input {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fff;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .btn-filter {
        padding: 10px 20px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
    }
    
    .btn-reset {
        padding: 10px 16px;
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-reset:hover {
        background: #e5e7eb;
    }
    
    /* Alert Messages */
    .alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
        border: 1px solid #f87171;
    }
    
    .alert i {
        font-size: 18px;
    }
    
    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.7;
    }
    
    .alert-close:hover {
        opacity: 1;
    }
    
    /* Mahasiswa List */
    .mahasiswa-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    .mahasiswa-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: all 0.2s;
    }
    
    .mahasiswa-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    
    .mahasiswa-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .mahasiswa-header:hover {
        background: #ecfdf5;
    }
    
    .mahasiswa-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .mahasiswa-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
    }
    
    .mahasiswa-detail h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px 0;
    }
    
    .mahasiswa-detail p {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }
    
    .mahasiswa-badges {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .badge-count {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-count.pending {
        background: #fef3c7;
        color: #92400e;
    }
    
    .badge-count.approved {
        background: #dcfce7;
        color: #15803d;
    }
    
    .toggle-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        transition: all 0.2s;
    }
    
    .mahasiswa-header:hover .toggle-icon {
        background: #059669;
        color: #fff;
        border-color: #059669;
    }
    
    .toggle-icon.open {
        transform: rotate(180deg);
    }
    
    /* Achievement List */
    .achievement-list {
        display: none;
        padding: 0;
    }
    
    .achievement-list.open {
        display: block;
    }
    
    .achievement-item {
        display: grid;
        grid-template-columns: 1fr 120px 140px 100px 100px;
        gap: 16px;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s;
    }
    
    .achievement-item:last-child {
        border-bottom: none;
    }
    
    .achievement-item:hover {
        background: #f8fafc;
    }
    
    .achievement-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .achievement-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .achievement-icon.sertifikasi { background: #dcfce7; color: #15803d; }
    .achievement-icon.prestasi { background: #fef3c7; color: #92400e; }
    .achievement-icon.organisasi { background: #dbeafe; color: #1e40af; }
    .achievement-icon.pkm { background: #f3e8ff; color: #7c3aed; }
    .achievement-icon.karya { background: #fce7f3; color: #be185d; }
    .achievement-icon.penghargaan { background: #ffedd5; color: #ea580c; }
    
    .achievement-content h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px 0;
    }
    
    .achievement-content p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }
    
    .achievement-type {
        font-size: 12px;
        padding: 4px 10px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 6px;
        font-weight: 500;
        text-align: center;
    }
    
    .achievement-date {
        font-size: 13px;
        color: #6b7280;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-align: center;
    }
    
    .status-badge.pending { background: #fef3c7; color: #92400e; }
    .status-badge.approved { background: #dcfce7; color: #15803d; }
    .status-badge.rejected { background: #fee2e2; color: #b91c1c; }
    .status-badge.revision { background: #f3e8ff; color: #7c3aed; }
    
    /* Action Buttons */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
    }
    
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #e5e7eb;
        margin-bottom: 16px;
    }
    
    .empty-state h3 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        font-size: 14px;
        color: #9ca3af;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .filter-form {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filter-form {
            grid-template-columns: 1fr;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .achievement-item {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .achievement-info {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .mahasiswa-badges {
            flex-wrap: wrap;
        }
    }
</style>

<div class="verifikasi-container">
    {{-- Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1><i class="fas fa-check-double"></i> Verifikasi SKPI</h1>
            <p>Kelola pengajuan SKPI mahasiswa Program Studi Anda</p>
        </div>
    </div>
    
    {{-- Stats Cards --}}
    <div class="stats-grid">
        <a href="{{ route('prodi.verifikasi.index') }}" class="stat-card all {{ !request('status') ? 'active' : '' }}">
            <div class="stat-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="stat-value">{{ $stats['all'] ?? 0 }}</div>
            <div class="stat-label">Semua Pengajuan</div>
        </a>
        
        <a href="{{ route('prodi.verifikasi.index', ['status' => 'pending']) }}" class="stat-card pending {{ request('status') == 'pending' ? 'active' : '' }}">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ $stats['pending'] ?? 0 }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </a>
        
        <a href="{{ route('prodi.verifikasi.index', ['status' => 'approved']) }}" class="stat-card approved {{ request('status') == 'approved' ? 'active' : '' }}">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ $stats['approved'] ?? 0 }}</div>
            <div class="stat-label">Disetujui</div>
        </a>
        
        <a href="{{ route('prodi.verifikasi.index', ['status' => 'rejected']) }}" class="stat-card rejected {{ request('status') == 'rejected' ? 'active' : '' }}">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-value">{{ $stats['rejected'] ?? 0 }}</div>
            <div class="stat-label">Ditolak</div>
        </a>
        
        <a href="{{ route('prodi.verifikasi.index', ['status' => 'revision_required']) }}" class="stat-card revision {{ request('status') == 'revision_required' ? 'active' : '' }}">
            <div class="stat-icon">
                <i class="fas fa-redo"></i>
            </div>
            <div class="stat-value">{{ $stats['revision_required'] ?? 0 }}</div>
            <div class="stat-label">Perlu Revisi</div>
        </a>
    </div>
    
    {{-- Filter Section --}}
    <div class="filter-card">
        <div class="filter-header">
            <div class="filter-title">
                <i class="fas fa-filter"></i>
                Filter & Pencarian
            </div>
        </div>
        
        <form method="GET" action="{{ route('prodi.verifikasi.index') }}">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            
            <div class="filter-form">
                <div class="form-group">
                    <label class="form-label">Cari NIM atau Nama</label>
                    <input type="text" name="search" class="form-input" placeholder="Ketik NIM atau nama mahasiswa..." value="{{ request('search') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-input" value="{{ request('date_from') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-input" value="{{ request('date_to') }}">
                </div>
                
                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('prodi.verifikasi.index') }}" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif
    
    {{-- Mahasiswa List --}}
    @if($mahasiswaPengajuan->count() > 0)
        <div class="mahasiswa-list">
            @foreach($mahasiswaPengajuan as $mhs)
                @php
                    $pendingCount = $mhs->verifikasiSkpi->where('status', 'pending')->count();
                    $approvedCount = $mhs->verifikasiSkpi->where('status', 'approved')->count();
                    $totalVerifikasi = $mhs->verifikasiSkpi->count();
                @endphp
                
                <div class="mahasiswa-card">
                    <div class="mahasiswa-header" onclick="toggleAchievements('achievements-{{ $mhs->id }}', this)">
                        <div class="mahasiswa-info">
                            <div class="mahasiswa-avatar">
                                {{ strtoupper(substr($mhs->nama, 0, 2)) }}
                            </div>
                            <div class="mahasiswa-detail">
                                <h3>{{ $mhs->nama }}</h3>
                                <p><i class="fas fa-id-card"></i> {{ $mhs->nim }} • {{ $mhs->prodi->nama_prodi ?? 'Prodi' }}</p>
                            </div>
                        </div>
                        
                        <div class="mahasiswa-badges">
                            @if($pendingCount > 0)
                                <span class="badge-count pending">
                                    <i class="fas fa-clock"></i> {{ $pendingCount }} Menunggu
                                </span>
                            @endif
                            @if($approvedCount > 0)
                                <span class="badge-count approved">
                                    <i class="fas fa-check"></i> {{ $approvedCount }} Disetujui
                                </span>
                            @endif
                            
                            <div class="toggle-icon" id="toggle-icon-{{ $mhs->id }}">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="achievement-list" id="achievements-{{ $mhs->id }}">
                        @foreach($mhs->verifikasiSkpi as $verif)
                            @php
                                $typeClass = match($verif->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'sertifikasi',
                                    'App\Models\Prestasi' => 'prestasi',
                                    'App\Models\Organisasi' => 'organisasi',
                                    'App\Models\PengabdianMasyarakat' => 'pkm',
                                    'App\Models\KaryaIlmiah' => 'karya',
                                    'App\Models\Penghargaan' => 'penghargaan',
                                    default => 'sertifikasi'
                                };
                                $typeIcon = match($verif->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'fa-certificate',
                                    'App\Models\Prestasi' => 'fa-trophy',
                                    'App\Models\Organisasi' => 'fa-users',
                                    'App\Models\PengabdianMasyarakat' => 'fa-hands-helping',
                                    'App\Models\KaryaIlmiah' => 'fa-book',
                                    'App\Models\Penghargaan' => 'fa-award',
                                    default => 'fa-star'
                                };
                                $typeName = match($verif->verifiable_type) {
                                    'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
                                    'App\Models\Prestasi' => 'Prestasi',
                                    'App\Models\Organisasi' => 'Organisasi',
                                    'App\Models\PengabdianMasyarakat' => 'PKM',
                                    'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                                    'App\Models\Penghargaan' => 'Penghargaan',
                                    default => 'Achievement'
                                };
                                $statusClass = match($verif->status) {
                                    'pending' => 'pending',
                                    'approved' => 'approved',
                                    'rejected' => 'rejected',
                                    'revision_required' => 'revision',
                                    default => 'pending'
                                };
                                $statusLabel = match($verif->status) {
                                    'pending' => 'Menunggu',
                                    'approved' => 'Disetujui',
                                    'rejected' => 'Ditolak',
                                    'revision_required' => 'Revisi',
                                    default => ucfirst($verif->status)
                                };
                            @endphp
                            
                            <div class="achievement-item">
                                <div class="achievement-info">
                                    <div class="achievement-icon {{ $typeClass }}">
                                        <i class="fas {{ $typeIcon }}"></i>
                                    </div>
                                    <div class="achievement-content">
                                        <h4>{{ $verif->achievement_name ?? $verif->verifiable->nama ?? 'Achievement' }}</h4>
                                        <p>{{ $verif->catatan ?? 'Tidak ada catatan' }}</p>
                                    </div>
                                </div>
                                
                                <span class="achievement-type">{{ $typeName }}</span>
                                
                                <span class="achievement-date">
                                    <i class="fas fa-calendar"></i>
                                    {{ $verif->created_at->format('d M Y') }}
                                </span>
                                
                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                
                                <a href="{{ route('prodi.verifikasi.detail', $verif->id) }}" class="btn-action btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum Ada Pengajuan</h3>
            <p>Belum ada pengajuan SKPI dari mahasiswa Program Studi Anda.</p>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function toggleAchievements(id, headerElement) {
    const list = document.getElementById(id);
    const toggleIcon = headerElement.querySelector('.toggle-icon');
    
    if (list.classList.contains('open')) {
        list.classList.remove('open');
        toggleIcon.classList.remove('open');
    } else {
        list.classList.add('open');
        toggleIcon.classList.add('open');
    }
}

// Auto-expand cards with pending items
document.addEventListener('DOMContentLoaded', function() {
    const pendingBadges = document.querySelectorAll('.badge-count.pending');
    pendingBadges.forEach(badge => {
        const card = badge.closest('.mahasiswa-card');
        if (card) {
            const list = card.querySelector('.achievement-list');
            const toggleIcon = card.querySelector('.toggle-icon');
            if (list && toggleIcon) {
                list.classList.add('open');
                toggleIcon.classList.add('open');
            }
        }
    });
});
</script>
@endpush
