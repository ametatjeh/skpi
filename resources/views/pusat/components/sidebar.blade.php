<!-- resources/views/pusat/components/sidebar.blade.php -->

<style>
    :root {
        --pusat-sidebar-width: 260px;
        --pusat-sidebar-bg: #ffffff;
        --pusat-sidebar-border: #e5e7eb;
        --pusat-sidebar-text: #111827;
        --pusat-sidebar-muted: #6b7280;
        /* CYAN THEME */
        --pusat-sidebar-brand: #0891b2;
        --pusat-sidebar-brand-light: #06b6d4;
        --pusat-sidebar-brand-lighter: #22d3ee;
        --pusat-sidebar-hover-bg: rgba(8, 145, 178, 0.06);
        --pusat-sidebar-active-bg: rgba(8, 145, 178, 0.12);
        --pusat-sidebar-danger: #ef4444;
        --pusat-sidebar-bg-soft: #f0fdfa;
    }

    /* SIDEBAR FIXED 100vh */
    .pusat-sidebar {
        width: var(--pusat-sidebar-width);
        height: 100vh;
        background: var(--pusat-sidebar-bg);
        border-right: 1px solid var(--pusat-sidebar-border);
        overflow-y: auto;
        overflow-x: hidden;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 40;
        display: flex;
        flex-direction: column;
    }

    .pusat-sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 18px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border-bottom: none;
    }

    .pusat-sidebar-logo {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
    }

    .pusat-sidebar-title {
        font-weight: 800;
        font-size: 15px;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .pusat-sidebar-subtitle {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
    }

    .pusat-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 16px 16px 16px;
    }

    .pusat-sidebar-section-label {
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 12px 10px 8px;
    }

    .pusat-sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .pusat-nav-link {
        padding: 11px 12px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--pusat-sidebar-text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all .2s;
    }

    .pusat-nav-link i {
        width: 20px;
        font-size: 15px;
        text-align: center;
        color: #6b7280;
    }

    .pusat-nav-link:hover {
        background: var(--pusat-sidebar-hover-bg);
        color: var(--pusat-sidebar-brand);
    }
    
    .pusat-nav-link:hover i {
        color: var(--pusat-sidebar-brand);
    }

    .pusat-nav-active {
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.1) 0%, rgba(6, 182, 212, 0.15) 100%);
        color: var(--pusat-sidebar-brand);
        font-weight: 600;
    }
    
    .pusat-nav-active i {
        color: var(--pusat-sidebar-brand);
    }

    .pusat-nav-badge {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        padding: 3px 8px;
        color: white;
        font-size: 11px;
        font-weight: 700;
        border-radius: 20px;
        margin-left: auto;
    }

    .pusat-sidebar-footer {
        padding: 16px;
        border-top: 1px solid var(--pusat-sidebar-border);
        background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%);
    }

    .pusat-sidebar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        padding: 12px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .pusat-sidebar-user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
    }

    .pusat-sidebar-user-name {
        font-weight: 600;
        font-size: 14px;
        color: #111827;
    }

    .pusat-badge-role {
        font-size: 11px;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        padding: 3px 8px;
        border-radius: 6px;
        font-weight: 600;
    }

    .pusat-sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .pusat-sidebar-btn {
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
        transition: all .2s;
        text-decoration: none;
    }

    .pusat-sidebar-btn-profile {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
    }

    .pusat-sidebar-btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(8, 145, 178, 0.45);
    }

    .pusat-sidebar-btn-logout {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        width: 100%;
    }

    .pusat-sidebar-btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
    }

    /* MOBILE: offcanvas */
    @media (max-width: 768px) {
        .pusat-sidebar {
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .pusat-sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<aside class="pusat-sidebar" id="pusatSidebar">
    <div class="pusat-sidebar-header">
        <div class="pusat-sidebar-logo">
            <i class="fas fa-language"></i>
        </div>
        <div>
            <div class="pusat-sidebar-title">SKPI UMPAR</div>
            <div class="pusat-sidebar-subtitle">Pusat Bahasa</div>
        </div>
    </div>

    <div class="pusat-sidebar-body">
        <div class="pusat-sidebar-section-label">Menu Utama</div>
        <nav class="pusat-sidebar-nav">
            <a href="{{ route('pusat.dashboard') }}"
                class="pusat-nav-link {{ request()->routeIs('pusat.dashboard*') ? 'pusat-nav-active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <a href="{{ route('pusat.verifikasi.index') }}"
                class="pusat-nav-link {{ request()->routeIs('pusat.verifikasi*') ? 'pusat-nav-active' : '' }}">
                <i class="fas fa-spell-check"></i> Verifikasi Draft
                @php
                    $badgeCount = \App\Models\DraftSkpi::where('status', 'di_pusat_bahasa')->count();
                @endphp
                @if ($badgeCount > 0)
                    <span class="pusat-nav-badge">{{ $badgeCount }}</span>
                @endif
            </a>

            <a href="{{ route('pusat.arsip') }}"
                class="pusat-nav-link {{ request()->routeIs('pusat.arsip*') ? 'pusat-nav-active' : '' }}">
                <i class="fas fa-archive"></i> Arsip SKPI
            </a>

            <a href="{{ route('pusat.laporan') }}"
                class="pusat-nav-link {{ request()->routeIs('pusat.laporan*') ? 'pusat-nav-active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan & Statistik
            </a>
        </nav>
    </div>

    <div class="pusat-sidebar-footer">
        <div class="pusat-sidebar-user">
            <div class="pusat-sidebar-user-avatar">
                {{ strtoupper(substr(Auth::guard('pusat_bahasa')->user()->name ?? 'PB', 0, 2)) }}
            </div>
            <div>
                <div class="pusat-sidebar-user-name">{{ Auth::guard('pusat_bahasa')->user()->name ?? 'Operator' }}</div>
                <div>
                    <span class="pusat-badge-role">Pusat Bahasa</span>
                </div>
            </div>
        </div>

        <div class="pusat-sidebar-actions">
            <a href="{{ route('pusat.pengaturan') }}" class="pusat-sidebar-btn pusat-sidebar-btn-profile">
                <i class="fas fa-cog"></i> Pengaturan
            </a>

            <form method="POST" action="{{ route('pusat.logout') }}">
                @csrf
                <button type="submit" class="pusat-sidebar-btn pusat-sidebar-btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>
