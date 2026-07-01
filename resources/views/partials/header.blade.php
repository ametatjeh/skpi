<!-- NAVBAR BLUE -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-brand" style="text-decoration: none; color: #fff; display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('images/logo_unida-removebg-preview.png') }}" alt="Logo UNIDA" style="height: 32px;">
                <div style="display: flex; flex-direction: column; justify-content: center; line-height: 1.2;">
                    <span style="font-size: 18px; font-weight: 800; letter-spacing: 1px;">SKPI UNIDA</span>
                    <span style="font-size: 11px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: #e2e8f0;">DIGITAL CERTIFICATE SYSTEM</span>
                </div>
            </a>

            <!-- MENU DESKTOP -->
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('skema') }}" class="{{ request()->is('skema*') ? 'active' : '' }}">Skema</a></li>
                <li><a href="{{ url('capaian') }}" class="{{ request()->is('capaian*') ? 'active' : '' }}">Achievement</a></li>
                <li><a href="{{ url('/register-email') }}" class="{{ request()->is('register-email*') ? 'active' : '' }}">DAFTAR</a></li>

                <li class="nav-login-li">
                    <span class="nav-login-btn {{ request()->routeIs('*.login') ? 'active' : '' }}">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login
                        <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
                    </span>
                    <div class="dropdown">
                        <a href="{{ route('mahasiswa.login') }}" class="{{ request()->routeIs('mahasiswa.login') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-graduate"></i> Mahasiswa
                        </a>
                        <a href="{{ route('prodi.login') }}" class="{{ request()->routeIs('prodi.login') ? 'active' : '' }}">
                            <i class="fa-solid fa-layer-group"></i> Prodi
                        </a>
                        <a href="{{ route('pusat.login') }}" class="{{ request()->routeIs('pusat.login') ? 'active' : '' }}">
                            <i class="fa-solid fa-language"></i> Pusat Bahasa
                        </a>
                        <a href="{{ route('fakultas.login') }}" class="{{ request()->routeIs('fakultas.login') ? 'active' : '' }}">
                            <i class="fa-solid fa-university"></i> Fakultas
                        </a>
                        <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.login') ? 'active' : '' }}">
                            <i class="fa-solid fa-shield-halved"></i> Akademik
                        </a>
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
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('skema') }}" class="{{ request()->is('skema*') ? 'active' : '' }}">Skema</a>
            <a href="{{ url('capaian') }}" class="{{ request()->is('capaian*') ? 'active' : '' }}">Achievement</a>
            <a href="{{ url('/register-email') }}" class="{{ request()->is('register-email*') ? 'active' : '' }}">DAFTAR</a>
            <button class="mobile-dropdown-btn {{ request()->routeIs('*.login') ? 'active' : '' }}" id="mobileLoginBtn" style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-right-to-bracket"></i> Login <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
            </button>
            <div class="mobile-dropdown-content" id="mobileLoginContent">
                <a href="{{ route('mahasiswa.login') }}" class="{{ request()->routeIs('mahasiswa.login') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate"></i> Mahasiswa
                </a>
                <a href="{{ route('prodi.login') }}" class="{{ request()->routeIs('prodi.login') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Prodi
                </a>
                <a href="{{ route('pusat.login') }}" class="{{ request()->routeIs('pusat.login') ? 'active' : '' }}">
                    <i class="fa-solid fa-language"></i> Pusat Bahasa
                </a>
                <a href="{{ route('fakultas.login') }}" class="{{ request()->routeIs('fakultas.login') ? 'active' : '' }}">
                    <i class="fa-solid fa-university"></i> Fakultas
                </a>
                <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.login') ? 'active' : '' }}">
                    <i class="fa-solid fa-shield-halved"></i> Akademik
                </a>
            </div>
        </div>
    </div>

    