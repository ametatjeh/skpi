<style>
    :root {
        --sidebar-width: 260px;
        --sidebar-bg: #ffffff;
        --sidebar-border: #e5e7eb;
        --sidebar-text: #111827;
        --sidebar-muted: #6b7280;
        /* SKY BLUE THEME */
        --sidebar-brand: #0ea5e9;
        --sidebar-brand-dark: #0284c7;
        --sidebar-brand-light: #38bdf8;
        --sidebar-hover-bg: rgba(14, 165, 233, 0.08);
        --sidebar-active-bg: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        --sidebar-danger: #ef4444;
        --sidebar-bg-soft: #f0f9ff;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        border-right: 1px solid var(--sidebar-border);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03);
        z-index: 50;
        overflow-y: auto;
    }

    @media(max-width:768px) {
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 40;
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }

    /* ===== HEADER PREMIUM SKY BLUE ===== */
    .sidebar-header {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
        padding: 24px 20px;
        position: relative;
        overflow: hidden;
    }

    .sidebar-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .sidebar-header-content {
        display: flex;
        align-items: center;
        gap: 14px;
        position: relative;
        z-index: 1;
    }

    .sidebar-logo {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-title {
        font-weight: 800;
        font-size: 16px;
        color: #fff;
        letter-spacing: .02em;
    }

    .sidebar-subtitle {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
    }

    /* ===== BODY ===== */
    .sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px 16px;
    }

    .sidebar-body::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .nav-section-title {
        font-size: 10px;
        font-weight: 700;
        color: var(--sidebar-muted);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 12px 10px 8px;
        margin-top: 8px;
    }

    .nav-link {
        padding: 11px 14px;
        border-radius: 10px;
        text-decoration: none;
        color: var(--sidebar-text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 4px;
        transition: all 0.2s ease;
        position: relative;
    }

    .nav-link i {
        width: 20px;
        font-size: 15px;
        text-align: center;
        color: var(--sidebar-muted);
        transition: color 0.2s;
    }

    .nav-link:hover {
        background: rgba(14, 165, 233, 0.12);
        color: #0284c7;
        transform: translateX(4px);
    }

    .nav-link:hover i {
        color: #0284c7;
    }

    /* ===== ACTIVE STATE PREMIUM ===== */
    .nav-active {
        background: var(--sidebar-active-bg);
        color: #fff !important;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.35);
    }

    .nav-active i {
        color: #fff !important;
    }

    .nav-active:hover {
        background: var(--sidebar-active-bg);
        color: #fff !important;
        transform: translateX(0);
    }

    .nav-active:hover i {
        color: #fff !important;
    }

    .sidebar-separator {
        margin: 16px 10px;
        border: 0;
        border-top: 1px solid var(--sidebar-border);
    }

    /* ===== FOOTER PREMIUM ===== */
    .sidebar-footer {
        padding: 18px 16px;
        border-top: 1px solid var(--sidebar-border);
        background: var(--sidebar-bg-soft);
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        padding: 14px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .sidebar-user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .sidebar-user-info {
        flex: 1;
        min-width: 0;
    }

    .sidebar-user-name {
        font-weight: 700;
        font-size: 13px;
        color: var(--sidebar-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-user-meta {
        font-size: 11px;
        color: var(--sidebar-muted);
    }

    .sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .sidebar-btn {
        padding: 10px 14px;
        border-radius: 10px;
        border: none;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .sidebar-btn-profile {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.35);
    }

    .sidebar-btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.45);
    }

    .sidebar-btn-logout {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .sidebar-btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
    }
</style>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-header-content">
            <div class="sidebar-logo">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <div class="sidebar-title">SKPI UMPAR</div>
                <div class="sidebar-subtitle">Portal Mahasiswa</div>
            </div>
        </div>
    </div>

    <div class="sidebar-body">
        <nav style="display:flex;flex-direction:column;">
            <div class="nav-section-title">Menu Utama</div>
            
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'nav-active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            
            <div class="nav-section-title">Achievement</div>
            
            <a href="{{ route('mahasiswa.sertifikasi.list') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.sertifikasi.*') ? 'nav-active' : '' }}">
                <i class="fas fa-certificate"></i> Sertifikasi
            </a>
            <a href="{{ route('mahasiswa.prestasi.list') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.prestasi.*') ? 'nav-active' : '' }}">
                <i class="fas fa-trophy"></i> Prestasi
            </a>
            <a href="{{ route('mahasiswa.organisasi.list') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.organisasi.*') ? 'nav-active' : '' }}">
                <i class="fas fa-users"></i> Organisasi
            </a>
            <a href="{{ route('mahasiswa.pkm.list') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.pkm.*') ? 'nav-active' : '' }}">
                <i class="fas fa-handshake"></i> PKM
            </a>

            <div class="nav-section-title">SKPI</div>

            <a href="{{ route('mahasiswa.verifikasi.index') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.verifikasi.*') ? 'nav-active' : '' }}">
                <i class="fas fa-check-circle"></i> Status Verifikasi
            </a>
            <a href="{{ route('mahasiswa.approval.index') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.approval.*') ? 'nav-active' : '' }}">
                <i class="fas fa-history"></i> Riwayat Approval
            </a>
            <a href="{{ route('mahasiswa.download.index') }}"
                class="nav-link {{ request()->routeIs('mahasiswa.download.*') ? 'nav-active' : '' }}">
                <i class="fas fa-download"></i> Download SKPI
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}{{ strtoupper(substr(auth()->user()->name ?? 'H', 1, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Mahasiswa' }}</div>
                <div class="sidebar-user-meta">{{ auth()->user()->mahasiswa->nim ?? '-' }}</div>
            </div>
        </div>

        <div class="sidebar-actions">
            <a href="{{ route('mahasiswa.profile') }}" class="sidebar-btn sidebar-btn-profile">
                <i class="fas fa-user"></i> Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-btn sidebar-btn-logout" style="width: 100%;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>
