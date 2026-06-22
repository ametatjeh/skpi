<!-- resources/views/fakultas/components/sidebar.blade.php - PURPLE THEME -->

<style>
    :root {
        --fak-sidebar-width: 260px;
        --fak-sidebar-bg: #ffffff;
        --fak-sidebar-border: #e5e7eb;
        --fak-sidebar-text: #111827;
        --fak-sidebar-muted: #6b7280;
        /* PURPLE THEME */
        --fak-sidebar-brand: #7c3aed;
        --fak-sidebar-brand-dark: #6d28d9;
        --fak-sidebar-brand-light: #a78bfa;
        --fak-sidebar-hover-bg: rgba(124, 58, 237, 0.08);
        --fak-sidebar-active-bg: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        --fak-sidebar-danger: #ef4444;
        --fak-sidebar-bg-soft: #faf5ff;
    }

    /* SIDEBAR FIXED 100vh */
    .fakultas-sidebar {
        width: var(--fak-sidebar-width);
        height: 100vh;
        background: var(--fak-sidebar-bg);
        border-right: 1px solid var(--fak-sidebar-border);
        overflow-y: auto;
        overflow-x: hidden;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 40;
        display: flex;
        flex-direction: column;
    }

    .fakultas-sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 18px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-bottom: none;
    }

    .fakultas-sidebar-logo {
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

    .fakultas-sidebar-title {
        font-weight: 800;
        font-size: 15px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .fakultas-sidebar-subtitle {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.85);
    }

    .fakultas-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 18px 14px 16px;
    }

    .fakultas-sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .fakultas-nav-link {
        padding: 11px 14px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--fak-sidebar-text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .fakultas-nav-link i {
        width: 20px;
        font-size: 15px;
        color: var(--fak-sidebar-muted);
        transition: color 0.2s;
    }

    .fakultas-nav-link:hover {
        background: var(--fak-sidebar-hover-bg);
        color: var(--fak-sidebar-brand);
        transform: translateX(4px);
    }

    .fakultas-nav-link:hover i {
        color: var(--fak-sidebar-brand);
    }

    .fakultas-nav-active {
        background: var(--fak-sidebar-active-bg) !important;
        color: #fff !important;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }

    .fakultas-nav-active i {
        color: #fff !important;
    }

    .fakultas-nav-badge {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        padding: 3px 8px;
        color: white;
        font-size: 11px;
        font-weight: 700;
        border-radius: 20px;
        margin-left: auto;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
    }

    .fakultas-sidebar-footer {
        padding: 16px;
        border-top: 1px solid var(--fak-sidebar-border);
        background: var(--fak-sidebar-bg-soft);
    }

    .fakultas-sidebar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        padding: 12px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f3e8ff;
    }

    .fakultas-sidebar-user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .fakultas-sidebar-user-name {
        font-weight: 600;
        font-size: 13px;
        color: #111827;
    }

    .fakultas-badge-role {
        font-size: 10px;
        font-weight: 700;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    .fakultas-sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .fakultas-sidebar-btn {
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

    .fakultas-sidebar-btn-profile {
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
    }

    .fakultas-sidebar-btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.45);
    }

    .fakultas-sidebar-btn-logout {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        width: 100%;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .fakultas-sidebar-btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
    }

    /* MOBILE: offcanvas */
    @media (max-width: 768px) {
        .fakultas-sidebar {
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .fakultas-sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<aside class="fakultas-sidebar" id="fakultasSidebar">
    <div class="fakultas-sidebar-header">
        <div class="fakultas-sidebar-logo">
            <i class="fas fa-university"></i>
        </div>
        <div>
            <div class="fakultas-sidebar-title">SKPI UNIDA</div>
            <div class="fakultas-sidebar-subtitle">Dashboard Fakultas</div>
        </div>
    </div>

    <div class="fakultas-sidebar-body">
        <nav class="fakultas-sidebar-nav">
            <a href="{{ route('fakultas.dashboard') }}"
                class="fakultas-nav-link {{ request()->routeIs('fakultas.dashboard*') ? 'fakultas-nav-active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>

            <a href="{{ route('fakultas.verifikasi.index') }}"
                class="fakultas-nav-link {{ request()->routeIs('fakultas.verifikasi*') ? 'fakultas-nav-active' : '' }}">
                <i class="fas fa-tasks"></i> Verifikasi Draft SKPI
                @php
                    $pendingCount = \App\Models\DraftSkpi::where('status', 'valid_fakultas')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="fakultas-nav-badge">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('fakultas.arsip.index') }}"
                class="fakultas-nav-link {{ request()->routeIs('fakultas.arsip*') ? 'fakultas-nav-active' : '' }}">
                <i class="fas fa-archive"></i> Arsip SKPI
            </a>

            <a href="{{ route('fakultas.laporan.index') }}"
                class="fakultas-nav-link {{ request()->routeIs('fakultas.laporan*') ? 'fakultas-nav-active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan & Statistik
            </a>
        </nav>
    </div>

    <div class="fakultas-sidebar-footer">
        <div class="fakultas-sidebar-user">
            <div class="fakultas-sidebar-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'F', 0, 1)) }}
            </div>
            <div>
                <div class="fakultas-sidebar-user-name">{{ auth()->user()->name ?? 'Fakultas' }}</div>
                <div>
                    <span class="fakultas-badge-role">Fakultas</span>
                </div>
            </div>
        </div>

        <div class="fakultas-sidebar-actions">
            <a href="{{ route('fakultas.profile.edit') }}" class="fakultas-sidebar-btn fakultas-sidebar-btn-profile">
                <i class="fas fa-cog"></i> Pengaturan
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="fakultas-sidebar-btn fakultas-sidebar-btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>
