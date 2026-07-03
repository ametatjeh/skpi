<!-- resources/views/admin/components/sidebar.blade.php -->

<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-header">
        <div class="admin-sidebar-logo">
            <i class="fas fa-graduation-cap"></i>
            SKPI
        </div>
        <div class="admin-sidebar-title">Admin Panel</div>
    </div>

    <nav class="admin-sidebar-menu">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="admin-menu-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <!-- Mahasiswa Section -->
        <div class="admin-menu-section">
            <i class="fas fa-users"></i>
            MAHASISWA
        </div>

        <a href="{{ route('admin.total-mahasiswa.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.total-mahasiswa*') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i>
            <span>Data Mahasiswa</span>
        </a>

        <a href="{{ route('admin.total-prodi.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.total-prodi*') ? 'active' : '' }}">
            <i class="fas fa-university"></i>
            <span>Data Prodi</span>
        </a>

        <a href="{{ route('admin.total-fakultas.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.total-fakultas*') ? 'active' : '' }}">
            <i class="fas fa-landmark"></i>
            <span>Data Fakultas</span>
        </a>

        <a href="{{ route('admin.progress.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.progress*') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i>
            <span>Progress SKPI</span>
        </a>

        <!-- Kegiatan Section -->
        <div class="admin-menu-section">
            <i class="fas fa-clipboard-list"></i>
            KEGIATAN
        </div>

        <a href="{{ route('admin.prestasi.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.prestasi*') ? 'active' : '' }}">
            <i class="fas fa-trophy"></i>
            <span>Prestasi</span>
        </a>

        <a href="{{ route('admin.sertifikasi.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.sertifikasi*') ? 'active' : '' }}">
            <i class="fas fa-certificate"></i>
            <span>Sertifikasi</span>
        </a>

        <a href="{{ route('admin.organisasi.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.organisasi*') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i>
            <span>Organisasi</span>
        </a>

        <a href="{{ route('admin.pkm.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.pkm*') ? 'active' : '' }}">
            <i class="fas fa-book"></i>
            <span>PKM</span>
        </a>

        <a href="{{ route('admin.dokumen.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.dokumen*') ? 'active' : '' }}">
            <i class="fas fa-folder-open"></i>
            <span>Dokumen Pendukung</span>
        </a>

        <!-- Verifikasi Section -->
        <div class="admin-menu-section">
            <i class="fas fa-check-circle"></i>
            VERIFIKASI
        </div>

        <a href="{{ route('admin.verifikasi.prodi') }}"
            class="admin-menu-item {{ request()->routeIs('admin.verifikasi.prodi*') ? 'active' : '' }}">
            <i class="fas fa-clock"></i>
            <span>Menunggu Prodi</span>
        </a>

        <a href="{{ route('admin.verifikasi.fakultas') }}"
            class="admin-menu-item {{ request()->routeIs('admin.verifikasi.fakultas*') ? 'active' : '' }}">
            <i class="fas fa-building"></i>
            <span>Menunggu Fakultas</span>
        </a>

        <a href="{{ route('admin.verifikasi.semua') }}"
            class="admin-menu-item {{ request()->routeIs('admin.verifikasi.semua*') ? 'active' : '' }}">
            <i class="fas fa-list-check"></i>
            <span>Semua Verifikasi</span>
        </a>

        <!-- SKPI -->
        <div class="admin-menu-section">
            <i class="fas fa-file-alt"></i>
            SKPI
        </div>

        <a href="{{ route('admin.skpi.draft') }}"
            class="admin-menu-item {{ request()->routeIs('admin.skpi.draft*') ? 'active' : '' }}">
            <i class="fas fa-file-edit"></i>
            <span>Draft SKPI</span>
        </a>

        <a href="{{ route('admin.skpi.final') }}"
            class="admin-menu-item {{ request()->routeIs('admin.skpi.final*') ? 'active' : '' }}">
            <i class="fas fa-file-pdf"></i>
            <span>SKPI Final</span>
        </a>

        <!-- Pengaturan -->
        <div class="admin-menu-section">
            <i class="fas fa-cog"></i>
            PENGATURAN
        </div>

        <a href="{{ route('admin.template-skpi.edit') }}"
            class="admin-menu-item {{ request()->routeIs('admin.template-skpi.*') ? 'active' : '' }}">
            <i class="fas fa-file-code"></i>
            <span>Template SKPI</span>
        </a>

        <a href="{{ route('admin.prodi.skpi.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.prodi.skpi.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i>
            <span>SKPI per Prodi</span>
        </a>

        <a href="{{ route('admin.qr.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.qr.*') ? 'active' : '' }}">
            <i class="fas fa-qrcode"></i>
            <span>Pengaturan QR Code</span>
        </a>

        <a href="{{ route('admin.blanko.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.blanko.*') ? 'active' : '' }}">
            <i class="fas fa-copy"></i>
            <span>Stok Blanko</span>
        </a>

        <!-- User -->
        <div class="admin-menu-section">
            <i class="fas fa-user-shield"></i>
            USER
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i>
            <span>Manajemen User</span>
        </a>

        <!-- Laporan -->
        <div class="admin-menu-section">
            <i class="fas fa-chart-bar"></i>
            LAPORAN
        </div>

        <a href="{{ route('admin.laporan.index') }}"
            class="admin-menu-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i>
            <span>Laporan & Statistik</span>
        </a>

    </nav>


</aside>


<style>
    /* ========================================
       SIDEBAR - FIXED & TEMA HIJAU
       ======================================== */

    .admin-sidebar-logout-btn {
        width: 100%;
        padding: 10px;
        background: #fee2e2;
        color: #ef4444;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .admin-sidebar-logout-btn:hover {
        background: #ef4444;
        color: white;
        border-color: #dc2626;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
    }

    .admin-sidebar {
        width: 260px;
        background: #ffffff;
        color: #334155;
        display: flex;
        flex-direction: column;
        height: 100vh;
        border-right: 1px solid #e2e8f0;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);

        /* ✅ FIXED POSITION */
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        overflow: hidden;
    }

    /* ========================================
       HEADER
       ======================================== */

    .admin-sidebar-header {
        padding: 25px 20px 20px;
        border-bottom: 1px solid #e2e8f0;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        flex-shrink: 0;
    }

    .admin-sidebar-logo {
        font-size: 26px;
        font-weight: 700;
        color: #10b981;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
    }

    .admin-sidebar-logo i {
        font-size: 28px;
        color: #10b981;
    }

    .admin-sidebar-title {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        letter-spacing: 0.5px;
        margin-left: 38px;
    }

    /* ========================================
       SCROLLABLE MENU
       ======================================== */

    .admin-sidebar-menu {
        overflow-y: auto;
        overflow-x: hidden;
        padding: 15px 0 20px;
        flex: 1;
        background: #ffffff;
    }

    /* Custom Scrollbar */
    .admin-sidebar-menu::-webkit-scrollbar {
        width: 5px;
    }

    .admin-sidebar-menu::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .admin-sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .admin-sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    /* ========================================
       MENU SECTION LABEL
       ======================================== */

    .admin-menu-section {
        padding: 18px 20px 8px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-menu-section i {
        font-size: 12px;
        opacity: 0.7;
    }

    .admin-menu-section:first-of-type {
        padding-top: 5px;
    }

    /* ========================================
       MENU ITEM - HOVER HIJAU MUDA
       ======================================== */

    .admin-menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 7.8px 20px;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        position: relative;
        margin: 1.5px 8px;
        border-radius: 8px;
    }

    .admin-menu-item i {
        font-size: 16px;
        width: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* HOVER - HIJAU MUDA */
    .admin-menu-item:hover {
        background: linear-gradient(90deg, #d1fae5, #a7f3d0);
        color: #065f46;
        transform: translateX(3px);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
    }

    .admin-menu-item:hover i {
        transform: scale(1.1);
        color: #10b981;
    }

    /* ACTIVE - HIJAU BOLD */
    .admin-menu-item.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        border-left-color: #047857;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .admin-menu-item.active i {
        color: #ffffff;
        transform: scale(1.05);
    }

    /* ========================================
       FOOTER - FIXED AT BOTTOM
       ======================================== */

    .admin-sidebar-footer {
        padding: 15px 15px;
        border-top: 1px solid #e2e8f0;
        background: #f8fafc;
        flex-shrink: 0;
    }

    .admin-footer-user {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        background: #ffffff;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .admin-footer-user:hover {
        background: #d1fae5;
        border-color: #10b981;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
    }

    .admin-sidebar-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
    }

    .admin-sidebar-user-info {
        flex: 1;
    }

    .admin-sidebar-user-name {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .admin-sidebar-user-role {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
    }

    /* ========================================
       RESPONSIVE - OFFCANVAS PATTERN
       ======================================== */

    @media (max-width: 768px) {
        .admin-sidebar {
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .admin-sidebar.active {
            transform: translateX(0);
        }
    }

    /* ========================================
       SMOOTH ANIMATIONS
       ======================================== */

    @keyframes slideIn {
        from {
            transform: translateX(-10px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .admin-menu-item {
        animation: slideIn 0.3s ease;
    }
</style>

