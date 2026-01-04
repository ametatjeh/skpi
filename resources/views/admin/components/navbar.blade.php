<!-- resources/views/admin/components/navbar.blade.php -->

<header class="admin-navbar">
    <div class="admin-navbar-left">
        <span class="admin-navbar-title">
            <i class="fas fa-graduation-cap"></i>
            SKPI Admin
        </span>
    </div>

    <div class="admin-navbar-right">

        <div class="admin-navbar-user-box">
            <div class="admin-avatar">
                {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="admin-navbar-user">
                {{ auth('admin')->user()->name ?? 'Admin' }}
            </span>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="admin-navbar-logout-form">
            @csrf
            <button type="submit" class="admin-navbar-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>

    </div>

    <button id="btnToggleSidebarAdmin" class="admin-btn-hamburger" type="button">
        <i class="fas fa-bars"></i>
    </button>
</header>

<style>
    /* ========================================
       MAIN CONTAINER - OFFSET SIDEBAR
       ======================================== */

    .admin-main {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .admin-page-content {
        flex: 1;
        padding: 24px 32px;
        background: #f8fafc;
        overflow-y: auto;
    }

    /* ========================================
       NAVBAR - TEMA HIJAU & PUTIH
       ======================================== */

    .admin-navbar {
        height: 60px;
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 0 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* ========================================
       LEFT SIDE
       ======================================== */

    .admin-navbar-title {
        font-weight: 700;
        font-size: 18px;
        color: #10b981;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-navbar-title i {
        font-size: 20px;
        color: #10b981;
    }

    /* ========================================
       RIGHT AREA
       ======================================== */

    .admin-navbar-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* ========================================
       USER BOX - HOVER HIJAU MUDA
       ======================================== */

    .admin-navbar-user-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8fafc;
        padding: 8px 14px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .admin-navbar-user-box:hover {
        background: #d1fae5;
        border-color: #10b981;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
    }

    /* ========================================
       AVATAR CIRCLE - HIJAU
       ======================================== */

    .admin-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
    }

    .admin-navbar-user {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }

    /* ========================================
       LOGOUT BUTTON - MERAH DENGAN ICON
       ======================================== */

    .admin-navbar-logout-form {
        margin: 0;
    }

    .admin-navbar-btn {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        color: #fff;
        padding: 9px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }

    .admin-navbar-btn i {
        font-size: 14px;
    }

    .admin-navbar-btn:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .admin-navbar-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
    }

    /* ========================================
       HAMBURGER BUTTON
       ======================================== */

    .admin-btn-hamburger {
        background: #10b981;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 7px 10px;
        display: none;
        cursor: pointer;
        align-items: center;
        justify-content: center;
    }

    .admin-btn-hamburger i {
        font-size: 15px;
    }

    /* ========================================
       RESPONSIVE
       ======================================== */

    @media (max-width: 768px) {
        .admin-main {
            margin-left: 0;
        }

        .admin-navbar {
            padding: 0 16px;
            height: 56px;
        }

        .admin-navbar-title {
            font-size: 16px;
        }

        .admin-navbar-title i {
            font-size: 18px;
        }

        .admin-navbar-right {
            display: none;
        }

        .admin-btn-hamburger {
            display: inline-flex;
        }

        .admin-page-content {
            padding: 20px 16px;
        }
    }
</style>

@push('scripts')
    <script>
        const btnToggleSidebarAdmin = document.getElementById('btnToggleSidebarAdmin');
        const adminSidebar = document.getElementById('adminSidebar');

        if (btnToggleSidebarAdmin && adminSidebar) {
            btnToggleSidebarAdmin.addEventListener('click', () => {
                adminSidebar.classList.toggle('active');
            });
        }
    </script>
@endpush

