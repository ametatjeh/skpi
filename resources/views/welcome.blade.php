<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- SEO Meta Tags --}}
    <title>SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah | Universitas Iskandar Muda</title>
    <meta name="description" content="Sistem Informasi SKPI (Surat Keterangan Pendamping Ijazah) Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa secara digital.">
    <meta name="keywords" content="SKPI, UNIDA, Universitas Iskandar Muda, Surat Keterangan Pendamping Ijazah, Diploma Supplement, Prestasi Mahasiswa, Sertifikasi Kompetensi, Sistem Akademik">
    <meta name="author" content="Universitas Iskandar Muda">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah">
    <meta property="og:description" content="Sistem Informasi SKPI Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa secara digital.">
    <meta property="og:image" content="{{ asset('favicon.ico') }}">
    <meta property="og:site_name" content="SKPI UNIDA">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah">
    <meta name="twitter:description" content="Sistem Informasi SKPI Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa.">
    <meta name="twitter:image" content="{{ asset('favicon.ico') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v=2">

    {{-- Structured Data / JSON-LD --}}
    @verbatim
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "EducationalOrganization",
            "name": "Universitas Iskandar Muda",
            "alternateName": "UNIDA",
            "url": "https://skpi.unida-aceh.ac.id",
            "logo": "/images/skpi_logo.png",
            "description": "Sistem Informasi SKPI (Surat Keterangan Pendamping Ijazah) untuk mengelola prestasi dan sertifikasi mahasiswa.",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Parepare",
                "addressRegion": "Sulawesi Selatan",
                "addressCountry": "ID"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "availableLanguage": "Indonesian"
            }
        }
    </script>
    @endverbatim

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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        @include('partials.styles')
        /* ======= HERO ======= */
        .hero {
            position: relative;
            flex: 1;
            min-height: calc(100vh - 200px);
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .hero-inner {
            max-width: 1200px;
            width: 100%;
            padding: 40px 20px 40px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.9fr);
            gap: 32px;
            align-items: center;
        }

        .hero-text {
            max-width: 640px;
        }

        .hero-sub {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero-title {
            font-size: 3.4rem;
            font-weight: 900;
            line-height: 1.1;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .hero-btn {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 26px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #0050a0;
            color: #fff;
            border-radius: 2px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .35);
            transition: .2s;
        }

        .hero-btn:hover {
            background: #0d47a1;
            transform: translateY(-2px);
        }

        /* ======= CARDS DI SAMPING KANAN ======= */
        .hero-cards-col {
            display: flex;
            justify-content: flex-start;
            /* cards nempel kiri area kanan */
        }

        .cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            max-width: 320px;
        }

        .card {
            background: rgba(2, 6, 23, 0.92);
            color: #fff;
            padding: 14px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #0050a0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-icon i {
            font-size: 18px;
        }

        .card-text h4 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .card-text span {
            font-size: 11px;
        }

        </style>
</head>

<body>

    @include('partials.header')
    <!-- HERO + CARDS KANAN -->
    <section class="hero">
        <!-- Particles container -->
        <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 1;"></div>
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: 0;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: 0;"></div>

        <div class="hero-inner" style="position: relative; z-index: 10;">
            <!-- Hero text dipindahkan ke register-email -->
            {{--
            <div class="hero-cards-col">
                <div class="cards">
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-text">
                            <h4>Standar DIKTI</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <div class="card-text">
                            <h4>International</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <div class="card-text">
                            <h4>Cloud Base</h4>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    @include('partials.footer')
    <!-- Particles JS -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        if (document.getElementById('particles-js')) {
            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": 60,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": true,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
        }
    </script>
</body>

</html>