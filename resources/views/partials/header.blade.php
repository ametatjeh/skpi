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
                <!-- <li><a href="#about">About us</a></li> -->
                <li><a href="{{ url('/register-email') }}">DAFTAR</a></li>
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
                        <a href="{{ route('admin.login') }}">Akademik</a>
                    </div>
                </li>
                <!-- <li><a href="#contact">Contact us</a></li> -->
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
            <a href="{{ url('/register-email') }}">DAFTAR</a>
            <button class="mobile-dropdown-btn" id="mobileLoginBtn">
                Login <i class="fas fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content" id="mobileLoginContent">
                <a href="{{ route('mahasiswa.login') }}">Mahasiswa</a>
                <a href="{{ route('prodi.login') }}">Prodi</a>
                <a href="{{ route('pusat.login') }}">Pusat Bahasa</a>
                <a href="{{ route('fakultas.login') }}">Fakultas</a>
                <a href="{{ route('admin.login') }}">Akademik</a>
            </div>
        </div>
    </div>

    