<style>
/* ======= TOP SOCIAL BAR ======= */
        .top-social {
            background: #0d47a1;
            color: #fff;
            font-size: 13px;
            padding: 6px 0;
        }

        .top-social-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: flex-end;
            gap: 14px;
        }

        .top-social-inner a {
            color: #fff;
            transition: color .2s;
        }

        .top-social-inner a:hover {
            color: #bbdefb;
        }

        /* ======= HEADER INFO BAR ======= */
        .header-info {
            background: #fff;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-info-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-box i {
            font-size: 2.4rem;
            color: #0d47a1;
        }

        .logo-text-main {
            font-weight: 800;
            font-size: 1.35rem;
            color: #0d47a1;
            line-height: 1.1;
        }

        .logo-text-sub {
            font-size: 0.8rem;
            color: #555;
        }

        .info-columns {
            display: flex;
            gap: 28px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
            color: #555;
        }

        .info-item i {
            font-size: 1.1rem;
            color: #0d47a1;
        }

        .info-item strong {
            display: block;
            font-size: 0.8rem;
            color: #111;
        }

        /* ======= NAVBAR BLUE ======= */
        .nav-bar a, .nav-menu a, .dropdown a, .mobile-nav a {
            text-decoration: none !important;
        }

        .nav-bar {
            background: #0050a0;
            position: sticky;
            top: 0;
            z-index: 40;
            width: 100%;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 52px;
        }

        .nav-brand {
            color: #fff;
            font-weight: 700;
            display: flex;
            gap: 10px;
            align-items: center;
            text-decoration: none !important;
        }

        .nav-brand img {
            height: 45px;
        }

        .nav-menu {
            display: flex;
            gap: 0;
            list-style: none;
        }

        .nav-menu>li {
            position: relative;
        }

        .nav-menu>li>a,
        .nav-menu>li>span {
            display: block;
            padding: 12px 18px;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
            text-decoration: none !important;
        }

        .nav-menu>li:hover {
            background: #003f7a;
        }

        .nav-menu>li>a.active,
        .nav-menu>li>span.active {
            position: relative;
            color: #fff;
        }

        .nav-menu>li>a.active::after,
        .nav-menu>li>span.active::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 10px;
            right: 10px;
            height: 1px;
            background: #a855f7;
        }

        .nav-menu li .dropdown {
            position: absolute;
            left: 0;
            top: 100%;
            background: #fff;
            color: #333;
            min-width: 200px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
            display: none;
            z-index: 60;
        }

        .nav-menu li:hover .dropdown {
            display: block;
        }

        .dropdown a {
            display: block;
            padding: 10px 16px;
            font-size: 13px;
            color: #333;
        }

        .dropdown a:hover {
            background: #f5f5f5;
            color: #0d47a1;
        }

        .dropdown a.active {
            color: #a855f7;
            font-weight: 700;
            background: #f3e8ff;
            border-left: 3px solid #a855f7;
        }

        /* ========= HAMBURGER & MOBILE NAV ========= */
        .hamburger {
            display: none;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .mobile-nav-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            display: none;
            z-index: 70;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #0050a0;
            transform: translateY(-100%);
            transition: transform .25s ease-out;
            z-index: 80;
        }

        .mobile-nav-header {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff;
        }

        .mobile-nav-links a {
            display: block;
            padding: 12px 18px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
        }

        .mobile-dropdown-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background: none;
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
            padding: 12px 18px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            font-family: inherit;
            cursor: pointer;
        }

        .mobile-nav-links a.active,
        .mobile-dropdown-btn.active {
            position: relative;
            color: #fff;
        }

        .mobile-nav-links a.active::after,
        .mobile-dropdown-btn.active::after {
            content: '';
            position: absolute;
            bottom: 6px;
            left: 10px;
            width: 65px;
            height: 1px;
            background: #a855f7;
        }

        .mobile-dropdown-content {
            display: none;
            background: rgba(0, 0, 0, 0.1);
        }

        .mobile-dropdown-content.show {
            display: block;
        }

        .mobile-dropdown-content a {
            padding-left: 36px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-weight: 400;
        }

        .mobile-nav.open {
            transform: translateY(0);
        }

        .mobile-nav-backdrop.show {
            display: block;
        }

        
/* ========= RESPONSIVE ========= */
        @media (max-width: 1024px) {
            .info-columns {
                display: none;
            }

            .nav-inner {
                padding: 0 16px;
            }

            .nav-menu {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hero-inner {
                grid-template-columns: minmax(0, 1fr);
                padding: 32px 16px 40px;
            }

            .hero-cards-col {
                justify-content: flex-start;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .hero-inner {
                padding: 28px 16px 36px;
            }

            .cards {
                max-width: 100%;
            }
        }
</style>
    