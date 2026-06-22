<!-- resources/views/prodi/components/navbar.blade.php - CYAN THEME -->

<style>
    /* NAVBAR top + main content offset sidebar */
    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
    }

    .prodi-main {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .prodi-navbar {
        height: 64px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 30;
        box-shadow: 0 4px 20px rgba(8, 145, 178, 0.15);
    }

    .prodi-navbar-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .prodi-navbar-title i {
        font-size: 18px;
        opacity: 0.9;
    }

    .prodi-navbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .prodi-navbar-search {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(4px);
        transition: all 0.2s;
    }

    .prodi-navbar-search:focus-within {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
    }

    .prodi-navbar-search i {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
    }

    .prodi-navbar-search input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 13px;
        color: #fff;
        min-width: 160px;
    }

    .prodi-navbar-search input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .prodi-navbar-icon-btn {
        position: relative;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px;
        border-radius: 12px;
        cursor: pointer;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        backdrop-filter: blur(4px);
    }

    .prodi-navbar-icon-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .prodi-navbar-icon-btn i {
        font-size: 17px;
    }

    .prodi-notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.5);
    }

    .prodi-navbar-profile {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 8px 14px 8px 8px;
        border-radius: 14px;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        cursor: pointer;
        color: #fff;
        transition: all 0.2s;
        backdrop-filter: blur(4px);
    }

    .prodi-navbar-profile:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .prodi-profile-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: #0891b2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
    }

    .prodi-profile-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .prodi-profile-name {
        font-size: 13px;
        font-weight: 600;
        color: #fff;
    }

    .prodi-profile-role {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.8);
    }

    .prodi-navbar-profile i {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Hamburger */
    .prodi-btn-hamburger {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 10px 12px;
        display: none;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
        transition: all 0.2s;
    }

    .prodi-btn-hamburger:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .prodi-btn-hamburger i {
        font-size: 16px;
    }

    /* CONTENT wrapper */
    .prodi-page-content {
        flex: 1;
        padding: 24px 32px;
        background: #f8fafc;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .prodi-main {
            margin-left: 0;
        }

        .prodi-navbar {
            padding: 0 16px;
            height: 58px;
        }

        .prodi-navbar-right {
            display: none;
        }

        .prodi-btn-hamburger {
            display: inline-flex;
        }

        .prodi-page-content {
            padding: 20px 16px;
        }
    }
</style>

<nav class="prodi-navbar">
    <div class="prodi-navbar-title">
        <i class="fas fa-@yield('page_icon', 'graduation-cap')"></i>
        @yield('page_title', 'Dashboard Prodi')
    </div>

    <div class="prodi-navbar-right">
        <div class="prodi-navbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari mahasiswa...">
        </div>

        @php
            $unreadCountProdi = \App\Models\Notifikasi::where('user_id', auth('prodi')->id())
                ->where('is_read', false)
                ->count();
        @endphp

        <button type="button" class="prodi-navbar-icon-btn" onclick="toggleNotificationsProdi()">
            <i class="fas fa-bell"></i>
            @if ($unreadCountProdi > 0)
                <span class="prodi-notification-badge">{{ $unreadCountProdi }}</span>
            @endif
        </button>

        <button type="button" class="prodi-navbar-profile" onclick="toggleProfileProdi()">
            <div class="prodi-profile-avatar">{{ strtoupper(substr(auth('prodi')->user()->name ?? 'PR', 0, 2)) }}</div>
            <div class="prodi-profile-info">
                <div class="prodi-profile-name">{{ auth('prodi')->user()->name ?? 'Operator' }}</div>
                <div class="prodi-profile-role">Program Studi</div>
            </div>
            <i class="fas fa-chevron-down"></i>
        </button>

        <form id="logout-form-prodi" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    <button id="btnToggleSidebarProdi" class="prodi-btn-hamburger" type="button">
        <i class="fas fa-bars"></i>
    </button>
</nav>

@push('scripts')
    <script>
        const btnToggleSidebarProdi = document.getElementById('btnToggleSidebarProdi');
        const prodiSidebar = document.getElementById('prodiSidebar');

        if (btnToggleSidebarProdi && prodiSidebar) {
            btnToggleSidebarProdi.addEventListener('click', () => {
                prodiSidebar.classList.toggle('active');
            });
        }

        function toggleProfileProdi() {
            const confirmed = confirm('Apakah Anda yakin ingin logout?');
            if (confirmed) {
                document.getElementById('logout-form-prodi').submit();
            }
        }

        function toggleNotificationsProdi() {
            alert('Notifikasi Prodi.');
        }
    </script>
@endpush

