<!-- resources/views/prodi/components/sidebar.blade.php - CYAN THEME -->

<style>
    :root {
        --prodi-sidebar-width: 260px;
        --prodi-sidebar-bg: #ffffff;
        --prodi-sidebar-border: #e5e7eb;
        --prodi-sidebar-text: #111827;
        --prodi-sidebar-muted: #6b7280;
        /* CYAN THEME */
        --prodi-sidebar-brand: #0891b2;
        --prodi-sidebar-brand-dark: #0e7490;
        --prodi-sidebar-brand-light: #06b6d4;
        --prodi-sidebar-hover-bg: rgba(8, 145, 178, 0.08);
        --prodi-sidebar-active-bg: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        --prodi-sidebar-danger: #ef4444;
        --prodi-sidebar-bg-soft: #f0fdfa;
    }

    /* SIDEBAR FIXED 100vh */
    .prodi-sidebar {
        width: var(--prodi-sidebar-width);
        height: 100vh;
        background: var(--prodi-sidebar-bg);
        border-right: 1px solid var(--prodi-sidebar-border);
        overflow-y: auto;
        overflow-x: hidden;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 40;
        display: flex;
        flex-direction: column;
    }

    .prodi-sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 18px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-bottom: none;
    }

    .prodi-sidebar-logo {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        backdrop-filter: blur(4px);
    }

    .prodi-sidebar-title {
        font-weight: 800;
        font-size: 15px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .prodi-sidebar-subtitle {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.85);
    }

    .prodi-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 18px 14px 16px;
    }

    .prodi-sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .prodi-nav-link {
        padding: 11px 14px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--prodi-sidebar-text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .prodi-nav-link i {
        width: 20px;
        font-size: 15px;
        color: var(--prodi-sidebar-muted);
        transition: color 0.2s;
    }

    .prodi-nav-link:hover {
        background: var(--prodi-sidebar-hover-bg);
        color: var(--prodi-sidebar-brand);
        transform: translateX(4px);
    }

    .prodi-nav-link:hover i {
        color: var(--prodi-sidebar-brand);
    }

    .prodi-nav-active {
        background: var(--prodi-sidebar-active-bg) !important;
        color: #fff !important;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }

    .prodi-nav-active i {
        color: #fff !important;
    }

    .prodi-nav-badge {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        padding: 3px 8px;
        color: white;
        font-size: 11px;
        font-weight: 700;
        border-radius: 20px;
        margin-left: auto;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
    }

    .prodi-sidebar-footer {
        padding: 16px;
        border-top: 1px solid var(--prodi-sidebar-border);
        background: var(--prodi-sidebar-bg-soft);
    }

    .prodi-sidebar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        padding: 12px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #cffafe;
    }

    .prodi-sidebar-user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .prodi-sidebar-user-name {
        font-weight: 600;
        font-size: 13px;
        color: #111827;
    }

    .prodi-badge-role {
        font-size: 10px;
        font-weight: 700;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    .prodi-sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .prodi-sidebar-btn {
        padding: 10px 12px;
        border-radius: 10px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .prodi-sidebar-btn-profile {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }

    .prodi-sidebar-btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(8, 145, 178, 0.45);
    }

    .prodi-sidebar-btn-logout {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        width: 100%;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .prodi-sidebar-btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
    }

    /* MOBILE: offcanvas */
    @media (max-width: 768px) {
        .prodi-sidebar {
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .prodi-sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<aside class="prodi-sidebar" id="prodiSidebar">
    <div class="prodi-sidebar-header">
        <div class="prodi-sidebar-logo">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div>
            <div class="prodi-sidebar-title">SKPI UNIDA</div>
            <div class="prodi-sidebar-subtitle">Dashboard Prodi</div>
        </div>
    </div>

    <div class="prodi-sidebar-body">
        <nav class="prodi-sidebar-nav">
            <a href="{{ route('prodi.dashboard') }}"
                class="prodi-nav-link {{ request()->routeIs('prodi.dashboard*') ? 'prodi-nav-active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>

            <a href="{{ route('prodi.verifikasi.index') }}"
                class="prodi-nav-link {{ request()->routeIs('prodi.verifikasi*') ? 'prodi-nav-active' : '' }}">
                <i class="fas fa-tasks"></i> Verifikasi Draft SKPI
                @php
                    $pendingCount = \App\Models\VerifikasiSkpi::whereHas('mahasiswa', function ($q) {
                        $q->where('prodi_id', auth('prodi')->user()->prodi_id);
                    })->where('status', 'diajukan')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="prodi-nav-badge">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('prodi.draft-skpi.index') }}"
                class="prodi-nav-link {{ request()->routeIs('prodi.draft-skpi*') ? 'prodi-nav-active' : '' }}">
                <i class="fas fa-file-alt"></i> Draft SKPI
            </a>

            <a href="{{ route('prodi.cpl.index') }}"
                class="prodi-nav-link {{ request()->routeIs('prodi.cpl*') ? 'prodi-nav-active' : '' }}">
                <i class="fas fa-book"></i> Kelola CPL
            </a>

            <a href="{{ route('prodi.laporan.verifikasi') }}"
                class="prodi-nav-link {{ request()->routeIs('prodi.laporan*') ? 'prodi-nav-active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan & Statistik
            </a>
        </nav>
    </div>

    <div class="prodi-sidebar-footer">
        <div class="prodi-sidebar-user">
            <div class="prodi-sidebar-user-avatar">
                {{ strtoupper(substr(auth('prodi')->user()->name ?? 'P', 0, 1)) }}
            </div>
            <div>
                <div class="prodi-sidebar-user-name">{{ auth('prodi')->user()->name ?? 'Prodi' }}</div>
                <div>
                    <span class="prodi-badge-role">Prodi</span>
                </div>
            </div>
        </div>

        <div class="prodi-sidebar-actions">
            <a href="{{ route('prodi.pengaturan.index') }}" class="prodi-sidebar-btn prodi-sidebar-btn-profile">
                <i class="fas fa-cog"></i> Pengaturan
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="prodi-sidebar-btn prodi-sidebar-btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>

