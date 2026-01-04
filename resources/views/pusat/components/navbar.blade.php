<!-- resources/views/pusat/components/navbar.blade.php -->

<style>
    /* NAVBAR top + main content offset sidebar */
    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
    }

    .pusat-main {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .pusat-navbar {
        height: 64px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 30;
        box-shadow: 0 4px 12px rgba(8, 145, 178, 0.15);
    }

    .pusat-navbar-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .pusat-navbar-title i {
        font-size: 18px;
        opacity: 0.9;
    }

    .pusat-navbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pusat-navbar-search {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(4px);
    }

    .pusat-navbar-search i {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }

    .pusat-navbar-search input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #ffffff;
        min-width: 180px;
    }
    
    .pusat-navbar-search input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .pusat-navbar-icon-btn {
        position: relative;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px;
        border-radius: 12px;
        cursor: pointer;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .pusat-navbar-icon-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .pusat-navbar-icon-btn i {
        font-size: 16px;
    }

    .pusat-notification-badge {
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
        border: 2px solid #0891b2;
    }

    .pusat-navbar-profile {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 8px 14px 8px 8px;
        border-radius: 12px;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        cursor: pointer;
        color: #ffffff;
        transition: all 0.2s;
    }
    
    .pusat-navbar-profile:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .pusat-profile-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .pusat-profile-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .pusat-profile-name {
        font-size: 13px;
        font-weight: 600;
        color: #ffffff;
    }

    .pusat-profile-role {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.7);
    }

    .pusat-navbar-profile i {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.7);
    }

    /* Hamburger */
    .pusat-btn-hamburger {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 10px 12px;
        display: none;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .pusat-btn-hamburger:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .pusat-btn-hamburger i {
        font-size: 16px;
    }

    /* CONTENT wrapper */
    .pusat-page-content {
        flex: 1;
        padding: 24px 32px;
        background: #f8fafc;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .pusat-main {
            margin-left: 0;
        }

        .pusat-navbar {
            padding: 0 16px;
            height: 60px;
        }

        .pusat-navbar-right {
            display: none;
        }

        .pusat-btn-hamburger {
            display: inline-flex;
        }

        .pusat-page-content {
            padding: 20px 16px;
        }
    }
</style>

<nav class="pusat-navbar">
    <div class="pusat-navbar-title">
        <i class="fas fa-language"></i>
        @yield('page_title', 'Dashboard Pusat Bahasa')
    </div>

    <div class="pusat-navbar-right">
        <div class="pusat-navbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari mahasiswa...">
        </div>

        @php
            $unreadCount = 0;
            try {
                $unreadCount = \App\Models\Notifikasi::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();
            } catch (\Exception $e) {
                $unreadCount = 0;
            }
        @endphp

        <button type="button" class="pusat-navbar-icon-btn" onclick="toggleNotificationsPusat()">
            <i class="fas fa-bell"></i>
            @if ($unreadCount > 0)
                <span class="pusat-notification-badge">{{ $unreadCount }}</span>
            @endif
        </button>

        <button type="button" class="pusat-navbar-profile" onclick="toggleProfilePusat()">
            <div class="pusat-profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'PB', 0, 2)) }}</div>
            <div class="pusat-profile-info">
                <div class="pusat-profile-name">{{ auth()->user()->name ?? 'Operator' }}</div>
                <div class="pusat-profile-role">Pusat Bahasa</div>
            </div>
            <i class="fas fa-chevron-down"></i>
        </button>

        <form id="logout-form-pusat" action="{{ route('pusat.logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    <button id="btnToggleSidebarPusat" class="pusat-btn-hamburger" type="button">
        <i class="fas fa-bars"></i>
    </button>
</nav>

@push('scripts')
    <script>
        const btnToggleSidebarPusat = document.getElementById('btnToggleSidebarPusat');
        const pusatSidebar = document.getElementById('pusatSidebar');

        if (btnToggleSidebarPusat && pusatSidebar) {
            btnToggleSidebarPusat.addEventListener('click', () => {
                pusatSidebar.classList.toggle('active');
            });
        }

        function toggleProfilePusat() {
            const confirmed = confirm('Apakah Anda yakin ingin logout?');
            if (confirmed) {
                document.getElementById('logout-form-pusat').submit();
            }
        }

        function toggleNotificationsPusat() {
            alert('Notifikasi Pusat Bahasa.');
        }
    </script>
@endpush
