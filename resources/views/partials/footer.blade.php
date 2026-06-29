<!-- FOOTER INFO -->
    <footer style="background: #0050a0; padding: 15px 0; border-top: none; margin-top: auto; width: 100%;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div class="logo-box">
                <img src="{{ asset('images/logo_unida-removebg-preview.png') }}" alt="SKPI Logo" style="height: 40px;">
                <div>
                    <div class="logo-text-main" style="color: #ffffff;">UNIDA ACEH</div>
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

    