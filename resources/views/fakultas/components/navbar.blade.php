<!-- resources/views/fakultas/components/navbar.blade.php - PURPLE THEME -->

<style>
    /* NAVBAR top + main content offset sidebar */
    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
    }

    .fakultas-main {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .fakultas-navbar {
        height: 64px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%);
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 30;
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.15);
    }

    .fakultas-navbar-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .fakultas-navbar-title i {
        font-size: 18px;
        opacity: 0.9;
    }

    .fakultas-navbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .fakultas-navbar-search {
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

    .fakultas-navbar-search:focus-within {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
    }

    .fakultas-navbar-search i {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
    }

    .fakultas-navbar-search input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 13px;
        color: #fff;
        min-width: 160px;
    }

    .fakultas-navbar-search input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .fakultas-navbar-icon-btn {
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

    .fakultas-navbar-icon-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .fakultas-navbar-icon-btn i {
        font-size: 17px;
    }

    .fakultas-notification-badge {
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

    .fakultas-navbar-profile {
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

    .fakultas-navbar-profile:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .fakultas-profile-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
    }

    .fakultas-profile-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .fakultas-profile-name {
        font-size: 13px;
        font-weight: 600;
        color: #fff;
    }

    .fakultas-profile-role {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.8);
    }

    .fakultas-navbar-profile i {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Hamburger */
    .fakultas-btn-hamburger {
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

    .fakultas-btn-hamburger:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .fakultas-btn-hamburger i {
        font-size: 16px;
    }

    /* CONTENT wrapper */
    .fakultas-page-content {
        flex: 1;
        padding: 24px 32px;
        background: #f8fafc;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .fakultas-main {
            margin-left: 0;
        }

        .fakultas-navbar {
            padding: 0 16px;
            height: 58px;
        }

        .fakultas-navbar-right {
            display: none;
        }

        .fakultas-btn-hamburger {
            display: inline-flex;
        }

        .fakultas-page-content {
            padding: 20px 16px;
        }
    }
</style>

<nav class="fakultas-navbar">
    <div class="fakultas-navbar-title">
        <i class="fas fa-@yield('page_icon', 'university')"></i>
        @yield('page_title', 'Dashboard Fakultas')
    </div>

    <div class="fakultas-navbar-right">
        <div class="fakultas-navbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari mahasiswa...">
        </div>

        @php
            $unreadCountFak = \App\Models\Notifikasi::where('user_id', auth()->id())
                ->where('is_read', false)
                ->count();
        @endphp

        <button type="button" class="fakultas-navbar-icon-btn" onclick="toggleNotificationsFakultas()">
            <i class="fas fa-bell"></i>
            @if ($unreadCountFak > 0)
                <span class="fakultas-notification-badge">{{ $unreadCountFak }}</span>
            @endif
        </button>

        <button type="button" class="fakultas-navbar-profile" onclick="toggleProfileFakultas()">
            <div class="fakultas-profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'FK', 0, 2)) }}</div>
            <div class="fakultas-profile-info">
                <div class="fakultas-profile-name">{{ auth()->user()->name ?? 'Operator' }}</div>
                <div class="fakultas-profile-role">Fakultas</div>
            </div>
            <i class="fas fa-chevron-down"></i>
        </button>

        <form id="logout-form-fakultas" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    <button id="btnToggleSidebarFakultas" class="fakultas-btn-hamburger" type="button">
        <i class="fas fa-bars"></i>
    </button>
</nav>

@push('scripts')
    <script>
        const btnToggleSidebarFakultas = document.getElementById('btnToggleSidebarFakultas');
        const fakultasSidebar = document.getElementById('fakultasSidebar');

        if (btnToggleSidebarFakultas && fakultasSidebar) {
            btnToggleSidebarFakultas.addEventListener('click', () => {
                fakultasSidebar.classList.toggle('active');
            });
        }

        function toggleProfileFakultas() {
            const confirmed = confirm('Apakah Anda yakin ingin logout?');
            if (confirmed) {
                document.getElementById('logout-form-fakultas').submit();
            }
        }

        function toggleNotificationsFakultas() {
            alert('Notifikasi Fakultas.');
        }
    </script>
@endpush
