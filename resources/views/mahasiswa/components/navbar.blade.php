<style>
    .mahasiswa-navbar {
        height: 64px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 30;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
    }

    .mahasiswa-navbar-left {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
    }

    .mahasiswa-btn-hamburger {
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

    .mahasiswa-btn-hamburger:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .mahasiswa-btn-hamburger i {
        font-size: 16px;
    }

    .mahasiswa-navbar-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: .02em;
    }

    .mahasiswa-navbar-title-icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .mahasiswa-navbar-date {
        margin-left: auto;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 10px;
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media(max-width:768px) {
        .mahasiswa-btn-hamburger {
            display: inline-flex;
        }

        .mahasiswa-navbar-title-icon {
            display: none;
        }

        .mahasiswa-navbar-title {
            font-size: 14px;
        }

        .mahasiswa-navbar-date {
            display: none;
        }
    }
</style>

<nav class="mahasiswa-navbar">
    <div class="mahasiswa-navbar-left">
        <div class="mahasiswa-navbar-title">
            <div class="mahasiswa-navbar-title-icon">
                <i class="fas fa-@yield('page_icon', 'home')"></i>
            </div>
            <span>@yield('page_title', 'Dashboard')</span>
        </div>

        <div class="mahasiswa-navbar-date">
            <i class="fas fa-calendar-alt"></i>
            {{ now()->translatedFormat('d M Y') }}
        </div>
    </div>

    <button id="btnToggleSidebar" class="mahasiswa-btn-hamburger">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<script>
    const btnToggleSidebar = document.getElementById('btnToggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (btnToggleSidebar && sidebar) {
        btnToggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }
</script>
