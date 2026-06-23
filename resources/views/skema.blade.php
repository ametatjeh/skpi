<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    {{-- SEO Meta Tags --}}
    <title>SKEMA - SKPI UNIDA | Universitas Iskandar Muda</title>
    <meta name="description" content="Skema Sertifikasi SKPI (Surat Keterangan Pendamping Ijazah) Universitas Iskandar Muda.">
    <meta name="keywords" content="SKPI, UNIDA, Skema, Universitas Iskandar Muda">
    <meta name="author" content="Universitas Iskandar Muda">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <link rel="canonical" href="{{ url('skema') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/skpi_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/skpi_logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f5f5f5;
            color: #111827;
        }

        a {
            text-decoration: none;
        }

        /* ======= NAVBAR BLUE ======= */
        .nav-bar {
            background: #0050a0;
            position: sticky;
            top: 0;
            z-index: 40;
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
        }

        .nav-menu>li:hover {
            background: #003f7a;
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

        /* ========= RESPONSIVE ========= */
        @media (max-width: 1024px) {
            .nav-inner {
                padding: 0 16px;
            }

            .nav-menu {
                display: none;
            }

            .hamburger {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR BLUE -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <div class="nav-brand">
                <i class="fas fa-graduation-cap" style="font-size: 28px; color: #fff;"></i>
                <span>SKPI UNIDA</span>
            </div>

            <!-- MENU DESKTOP -->
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('skema') }}">Skema</a></li>
                <li><a href="{{ url('capaian') }}">Achievement</a></li>
                <li><a href="http://127.0.0.1:8000/register-email">Registrasi</a></li>
                <li>
                    <span>
                        Login
                        <i class="fa-solid fa-chevron-down" style="font-size:10px;margin-left:4px;"></i>
                    </span>
                    <div class="dropdown">
                        <a href="{{ route('mahasiswa.login') }}">Mahasiswa</a>
                        <a href="{{ route('prodi.login') }}">Prodi</a>
                        <a href="{{ route('pusat.login') }}">Pusat Bahasa</a>
                        <a href="{{ route('fakultas.login') }}">Fakultas</a>
                        <a href="{{ route('admin.login') }}">Admin</a>
                    </div>
                </li>
            </ul>

            <!-- HAMBURGER BUTTON (MOBILE) -->
            <div class="hamburger" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- MOBILE NAV OVERLAY -->
    <div class="mobile-nav-backdrop" id="mobileBackdrop"></div>
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <span>Menu</span>
            <button id="mobileClose" style="background:none;border:none;color:#fff;font-size:20px;cursor:pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('skema') }}">Skema</a>
            <a href="{{ url('capaian') }}">Achievement</a>
            <a href="http://127.0.0.1:8000/register-email">Registrasi</a>
            <button class="mobile-dropdown-btn" id="mobileLoginBtn">
                Login <i class="fas fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content" id="mobileLoginContent">
                <a href="{{ route('mahasiswa.login') }}">Mahasiswa</a>
                <a href="{{ route('prodi.login') }}">Prodi</a>
                <a href="{{ route('pusat.login') }}">Pusat Bahasa</a>
                <a href="{{ route('fakultas.login') }}">Fakultas</a>
                <a href="{{ route('admin.login') }}">Admin</a>
            </div>
        </div>
    </div>

    <!-- CONTENT SECTION -->
    <section style="position: relative; min-height: calc(100vh - 200px); display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); padding: 40px 20px; font-family: 'Poppins', sans-serif; color: #ffffff; overflow: hidden;">
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: 0;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: 0;"></div>

        <style>
            .header-skema {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                padding: 18px 50px;
                margin-bottom: 50px;
                text-align: center;
                font-weight: 700;
                font-size: 1.4rem;
                letter-spacing: 2px;
                position: relative;
                z-index: 10;
            }

            .flow-container {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                gap: 24px;
                width: 100%;
                max-width: 1200px;
                overflow-x: auto;
                padding-bottom: 30px;
                position: relative;
                z-index: 10;
            }

            .flow-container::-webkit-scrollbar {
                height: 8px;
            }
            .flow-container::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 10px;
            }
            .flow-container::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 10px;
            }

            .step-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .box {
                background: rgba(255, 255, 255, 0.07);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
                border-radius: 16px;
                padding: 12px 16px;
                min-width: 160px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .box:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.25);
            }

            .box-title {
                text-align: center;
                font-weight: 700;
                margin-bottom: 12px;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #e2e8f0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 8px;
            }

            .box ul {
                margin: 0;
                padding-left: 20px;
                font-size: 0.95rem;
                color: #cbd5e1;
            }

            .box ul li {
                margin-bottom: 6px;
            }

            .arrow-right {
                display: flex;
                align-items: center;
                font-size: 28px;
                margin: 55px -10px 0 -10px;
                color: rgba(255, 255, 255, 0.5);
                text-shadow: 0 0 10px rgba(255,255,255,0.2);
            }

            .arrow-down {
                font-size: 24px;
                margin: 12px 0;
                color: rgba(255, 255, 255, 0.5);
            }

            .status-box {
                background: rgba(0, 0, 0, 0.2);
                border: 1px dashed rgba(255, 255, 255, 0.3);
            }
            
            .status-box ul {
                list-style-type: "- ";
                padding-left: 10px;
            }

            /* Table Styles */
            .table-container {
                width: 100%;
                max-width: 900px;
                margin-top: 50px;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                overflow: hidden;
                position: relative;
                z-index: 10;
            }

            .table-container table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                color: #e2e8f0;
            }

            .table-container th,
            .table-container td {
                padding: 16px 24px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .table-container th {
                background: rgba(255, 255, 255, 0.1);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #ffffff;
            }

            .table-container tr:last-child td {
                border-bottom: none;
            }

            .table-container tbody tr {
                transition: background 0.3s ease;
            }

            .table-container tbody tr:hover {
                background: rgba(255, 255, 255, 0.08);
            }
        </style>

        <div class="header-skema">
            ALUR PENERBITAN SKPI
        </div>

        <div class="flow-container">
            
            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Mahasiswa</div>
                    <ul>
                        <li>Input Data</li>
                        <li>Upload Dokumen</li>
                        <li>Submit</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Prodi</div>
                    <ul>
                        <li>Verifikasi</li>
                        <li>Buat Draft</li>
                        <li>Submit ke Fakultas</li>
                    </ul>
                </div>
                <div class="arrow-down">⬇</div>
                <div class="box status-box">
                    <div class="box-title">Status:</div>
                    <ul>
                        <li>Pending</li>
                        <li>Approved</li>
                        <li>Rejected</li>
                        <li>Revision</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Fakultas</div>
                    <ul>
                        <li>Review Draft SKPI</li>
                        <li>Approve/Reject</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Pusat Bahasa</div>
                    <ul>
                        <li>Verifikasi Terjemahan</li>
                        <li>Ringkasan ID/EN</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Final</div>
                    <ul>
                        <li>QR Code</li>
                        <li>PDF</li>
                        <li>Arsip</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Tabel Kategori -->
        <div class="header-skema" style="margin-top: 60px; margin-bottom: 30px;">
            PERAN DAN TANGGUNG JAWAB
        </div>
        <div class="table-container" style="margin-top: 0;">
            <table>
                <thead>
                    <tr>
                        <th>Peran</th>
                        <th>Deskripsi Tugas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Mahasiswa</strong></td>
                        <td>Input data kegiatan, upload dokumen pendukung, lihat status verifikasi</td>
                    </tr>
                    <tr>
                        <td><strong>Prodi</strong></td>
                        <td>Verifikasi kegiatan mahasiswa, buat draft SKPI, kelola CPL</td>
                    </tr>
                    <tr>
                        <td><strong>Fakultas</strong></td>
                        <td>Review draft SKPI dari prodi, verifikasi lanjutan, arsip</td>
                    </tr>
                    <tr>
                        <td><strong>Pusat Bahasa</strong></td>
                        <td>Verifikasi ringkasan bilingual (ID/EN), terjemahan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- FOOTER INFO -->
    <footer style="background: #0050a0; padding: 30px 0; border-top: none;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div class="logo-box">
                <img src="{{ asset('images/skpi_logo.png') }}" alt="SKPI Logo" style="height: 45px; filter: brightness(0) invert(1);">
                <div>
                    <div class="logo-text-main" style="color: #ffffff;">UNIDA Aceh</div>
                    <div class="logo-text-sub" style="color: #e2e8f0;">SKPI UNIDA Digital Certificate System</div>
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 28px;">
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-phone" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">CALL US</strong>
                        +62 123 456 789
                    </div>
                </div>
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-envelope" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">EMAIL US</strong>
                        skpi@unida-aceh.ac.id
                    </div>
                </div>
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-location-dot" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">LOCATE US</strong>
                        Kampus UNIDA, Indonesia
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const mobileNav = document.getElementById('mobileNav');
        const mobileClose = document.getElementById('mobileClose');
        const backdrop = document.getElementById('mobileBackdrop');

        function openMobileNav() {
            mobileNav.classList.add('open');
            backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileNav() {
            mobileNav.classList.remove('open');
            backdrop.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        if (navToggle) navToggle.addEventListener('click', openMobileNav);
        if (mobileClose) mobileClose.addEventListener('click', closeMobileNav);
        if (backdrop) backdrop.addEventListener('click', closeMobileNav);

        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const mobileLoginContent = document.getElementById('mobileLoginContent');
        if (mobileLoginBtn && mobileLoginContent) {
            mobileLoginBtn.addEventListener('click', function(e) {
                e.preventDefault();
                mobileLoginContent.classList.toggle('show');
                const icon = this.querySelector('i');
                if (mobileLoginContent.classList.contains('show')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        }
    </script>

</body>

</html>
