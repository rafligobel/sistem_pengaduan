<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-ADUAN — Sistem Pengaduan Inspektorat Kota Gorontalo</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body id="top">

    <header class="header" data-header>
        {{-- BACKDROP OVERLAY --}}
        <div class="overlay" data-overlay></div>

        {{-- SIDEBAR DRAWER (SEPERTI SIDEBAR DASHBOARD) --}}
        <aside class="sidebar-drawer" data-navbar>
            {{-- 1. HEADER SIDEBAR DENGAN LOGO RESMI KOTA GORONTALO & BRANDING SI-ADUAN --}}
            <div class="sidebar-header">
                <a href="{{ route('landing') }}" class="sidebar-brand">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota Gorontalo" class="sidebar-brand-logo">
                    <div class="sidebar-brand-info">
                        <span class="sidebar-brand-name">SI-ADUAN</span>
                        <span class="sidebar-brand-desc">Inspektorat Kota Gorontalo</span>
                    </div>
                </a>
                <button class="sidebar-close-btn" aria-label="Tutup Menu" data-nav-close-btn>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- 2. TOMBOL FITUR SIDEBAR (SESUAI DENGAN NAVBAR BERANDA) --}}
            <div class="sidebar-body">
                
                {{-- Section: Navigasi Halaman --}}
                <p class="sidebar-section-title">Navigasi Halaman</p>

                <a href="#home" class="sidebar-link active" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="#about" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Tentang Kami</span>
                </a>

                <a href="#gallery" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span>Galeri</span>
                </a>

                <a href="#news" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    <span>Berita</span>
                </a>

                <a href="#contact" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <span>Hubungi Kami</span>
                </a>

                {{-- Section: Autentikasi / Akun --}}
                <p class="sidebar-section-title">Akses Akun</p>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="sidebar-link sidebar-link-primary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M16.5 14.25l1.125 1.125" />
                            </svg>
                            <span class="font-bold">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="sidebar-link sidebar-link-primary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <span>Login</span>
                        </a>

                        <a href="{{ route('register') }}" class="sidebar-link sidebar-link-secondary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                            </svg>
                            <span>Daftar Sekarang</span>
                        </a>
                    @endauth
                @endif
            </div>

            {{-- 3. FOOTER USER PROFILE (SEPERTI SIDEBAR DASHBOARD) --}}
            @auth
                <div class="sidebar-footer">
                    <div class="sidebar-user-card">
                        <div class="sidebar-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="sidebar-user-details">
                            <p class="sidebar-user-name">{{ Auth::user()->name }}</p>
                            <p class="sidebar-user-role">{{ ucfirst(Auth::user()->roles->pluck('name')->first() ?? 'Masyarakat') }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sidebar-logout-btn" title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="sidebar-footer">
                    <div class="sidebar-footer-info">
                        <p class="sidebar-footer-title">SI-ADUAN Kota Gorontalo</p>
                        <p class="sidebar-footer-sub">Saluran Pengaduan Tipikor Resmi</p>
                    </div>
                </div>
            @endauth
        </aside>

        {{-- HEADER BAR: LOGO & NAMA APLIKASI DI SEBELAH KIRI, DERETAN NAVBAR DI SEBELAH KANAN --}}
        <div class="header-bottom">
            <div class="container navbar-container">
                {{-- 1. LOGO & NAMA APLIKASI (DI BAGIAN KIRI DERETAN NAVBAR) --}}
                <a href="{{ route('landing') }}" class="header-logo-link">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota Gorontalo" class="header-logo-img">
                    <div class="header-logo-text">
                        <span class="header-logo-title">SI-ADUAN</span>
                        <span class="header-logo-sub">Inspektorat Kota Gorontalo</span>
                    </div>
                </a>

                {{-- 2. DERETAN NAVBAR DESKTOP DI SEBELAH KANAN --}}
                <nav class="desktop-nav">
                    <ul class="navbar-list">
                        <li>
                            <a href="#home" class="navbar-link">Beranda</a>
                        </li>
                        <li>
                            <a href="#about" class="navbar-link">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#gallery" class="navbar-link">Galeri</a>
                        </li>
                        <li>
                            <a href="#news" class="navbar-link">Berita</a>
                        </li>
                        <li>
                            <a href="#contact" class="navbar-link">Hubungi Kami</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                </li>
                                <li><a href="{{ route('register') }}" class="btn btn-secondary">Daftar Sekarang</a></li>
                            @endauth
                        @endif
                    </ul>
                </nav>

                {{-- 3. TOMBOL MENU (HANYA MUNCUL DI LAYAR KECIL / MOBILE) --}}
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Buka Menu Sidebar" data-nav-open-btn>
                        <svg class="nav-open-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span class="nav-open-label">Menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <article>

            <section class="hero" id="home">
                <div class="container hero-container">
                    {{-- 1. BADGE RESMI / PILL TAG --}}
                    <div class="hero-badge-wrap">
                        <div class="hero-badge">
                            <span class="hero-badge-pulse">
                                <span class="hero-badge-ping"></span>
                                <span class="hero-badge-dot"></span>
                            </span>
                            <span class="hero-badge-text">Kanal Pengaduan Resmi — Inspektorat Kota Gorontalo</span>
                        </div>
                    </div>

                    {{-- 2. JUDUL UTAMA & SUB JUDUL --}}
                    <h1 class="hero-main-title">
                        <span class="hero-title-gradient">SI-ADUAN</span>
                    </h1>
                    <h2 class="hero-sub-title">Sistem Pengaduan Dugaan Tindak Pidana Korupsi</h2>

                    {{-- 3. DESKRIPSI SINGKAT DENGAN SKALA RESPONSIF --}}
                    <p class="hero-text">
                        Laporkan dugaan tindak pidana korupsi secara aman dan terstruktur melalui
                        metode 5W+1H sesuai Perwako Tahun 2025. Identitas pelapor dilindungi sepenuhnya oleh hukum.
                    </p>

                    {{-- 4. TOMBOL AKSI UTAMA (CTA) --}}
                    <div class="btn-group hero-btn-group">
                        @if (Route::has('login'))
                            @auth
                                @role('masyarakat')
                                    <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary hero-btn-main">
                                        <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Buat Laporan Baru</span>
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary hero-btn-outline">
                                        <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                        </svg>
                                        <span>Riwayat Laporan</span>
                                    </a>
                                @else
                                    <a href="{{ route('admin.complaints.index') }}" class="btn btn-primary hero-btn-main">
                                        <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                        </svg>
                                        <span>Daftar Laporan Pengaduan</span>
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary hero-btn-outline">
                                        <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M16.5 14.25l1.125 1.125" />
                                        </svg>
                                        <span>
                                            @if(Auth::user()->hasRole('admin'))
                                                Dashboard Admin
                                            @elseif(Auth::user()->hasRole('verifikator'))
                                                Dashboard Verifikator
                                            @elseif(Auth::user()->hasRole('pimpinan'))
                                                Dashboard Pimpinan
                                            @else
                                                Dashboard
                                            @endif
                                        </span>
                                    </a>
                                @endrole
                            @else
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary hero-btn-main">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span>Mulai Pengaduan</span>
                                </a>
                                <a href="{{ route('status.index') }}" class="btn btn-secondary hero-btn-outline">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <span>Cek Status Tiket</span>
                                </a>
                            @endauth
                        @endif
                    </div>

                    {{-- 5. KARTU HIGHLIGHT FITUR & KEAMANAN (TRUST BADGES) --}}
                    <div class="hero-highlights">
                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Kerahasiaan Terjamin</span>
                                <span class="hero-highlight-sub">Identitas pelapor dilindungi penuh</span>
                            </div>
                        </div>

                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Metode 5W + 1H</span>
                                <span class="hero-highlight-sub">Laporan terstruktur & akurat</span>
                            </div>
                        </div>

                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Respon Transparan</span>
                                <span class="hero-highlight-sub">Pantau proses tindak lanjut</span>
                            </div>
                        </div>
                    </div>

                    {{-- 6. INDIKATOR GULIR KE BAWAH (SCROLL DOWN) --}}
                    <a href="#about" class="hero-scroll-btn" aria-label="Gulir ke bagian Tentang Kami">
                        <span class="hero-scroll-mouse">
                            <span class="hero-scroll-dot"></span>
                        </span>
                        <span class="hero-scroll-text">Pelajari Lebih Lanjut</span>
                    </a>
                </div>
            </section>

            <section class="popular" id="about">
                <div class="container">
                    <h2 class="h2 section-title">Tentang SI-ADUAN</h2>

                    <p class="section-text">
                        SI-ADUAN adalah Sistem Informasi Pengaduan Dugaan Tindak Pidana Korupsi yang dikelola oleh
                        Inspektorat Kota Gorontalo. Melalui sistem ini, masyarakat dapat melaporkan berbagai
                        dugaan pelanggaran, penyimpangan, maupun penyalahgunaan wewenang yang terjadi
                        di lingkungan Pemerintah Kota Gorontalo secara aman dan terstruktur.
                    </p>

                    <h3 class="about-subheading">Mengapa Melapor Melalui SI-ADUAN?</h3>

                    <div class="popular-list">
                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/ho.png') }}" alt="Kerahasiaan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Kerahasiaan Terjamin</span>
                                </h3>
                                <p class="card-text">
                                    Identitas pelapor dijaga ketat dan dilindungi undang-undang.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/hihi.png') }}" alt="Cepat Transparan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Proses Cepat & Transparan</span>
                                </h3>
                                <p class="card-text">
                                    Setiap laporan diproses secara transparan dengan pembaruan status real-time.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/pemerintah.png') }}" alt="Pemerintahan Bersih"
                                    loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Pemerintahan Bersih</span>
                                </h3>
                                <p class="card-text">
                                    Partisipasi Anda membantu mewujudkan tata kelola pemerintahan yang bersih dan akuntabel.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="gallery" id="gallery">
                <div class="container">
                    <h2 class="h2 section-title">Galeri Foto</h2>
                    <p class="section-text">
                        Selamat datang di Galeri Foto Inspektorat Kota Gorontalo! Di sini, Anda dapat menjelajahi
                        momen-momen berharga yang mencerminkan dedikasi, inovasi, dan kebersamaan tim kami.
                    </p>

                    <div class="gallery-slider-container">
                        <ul class="gallery-slider">
                            @forelse($galleries as $gallery)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({{ json_encode($gallery) }})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" loading="lazy" decoding="async">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $gallery->title }}</h3>
                                            @if($gallery->description)
                                                <p class="gallery-desc">{{ $gallery->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @empty
                                {{-- Fallback data --}}
                                @php
                                    $fallbacks = [
                                        ['image' => 'images/gallery-1.jpg', 'title' => 'Kegiatan Inspektorat', 'desc' => 'Dokumentasi kegiatan rutin inspektorat kota Gorontalo.'],
                                        ['image' => 'images/gallery-3.jpg', 'title' => 'Rapat Koordinasi', 'desc' => 'Koordinasi bersama staf dan pimpinan.'],
                                        ['image' => 'images/gallery-2.jpg', 'title' => 'Kunjungan Kerja', 'desc' => 'Kunjungan kerja ke beberapa instansi terkait.'],
                                        ['image' => 'images/gallery-4.jpg', 'title' => 'Sosialisasi', 'desc' => 'Kegiatan sosialisasi kepada masyarakat.'],
                                        ['image' => 'images/gallery-5.jpg', 'title' => 'Pelatihan', 'desc' => 'Pelatihan peningkatan kapasitas pegawai.'],
                                    ];
                                @endphp
                                @foreach($fallbacks as $fb)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({'image_path': '{{ $fb['image'] }}', 'title': '{{ $fb['title'] }}', 'description': '{{ $fb['desc'] }}', 'is_local': true})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset($fb['image']) }}" alt="Gallery image" loading="lazy" decoding="async">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $fb['title'] }}</h3>
                                            <p class="gallery-desc">{{ $fb['desc'] }}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endforelse
                        </ul>
                    </div>
                </div>
            </section>

            <section class="news" id="news">
                <div class="container">
                    <h2 class="h2 section-title">Berita Terkini</h2>
                    <p class="section-text">
                        Ikuti perkembangan terbaru dan informasi penting seputar kegiatan Inspektorat Kota Gorontalo.
                    </p>

                    @if($news->count() > 0)
                        <div class="news-slider-container">
                            <ul class="news-slider">
                                @foreach($news as $item)
                                    <li class="news-card-item">
                                        <div class="popular-card">
                                            <figure class="card-img">
                                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                                            </figure>
                                            <div class="card-content">
                                                <div class="card-rating">
                                                    <ion-icon name="calendar-outline"></ion-icon>
                                                    <data>{{ $item->created_at->format('d M Y') }}</data>
                                                </div>
                                                <h3 class="h3 card-title">
                                                    <a href="javascript:void(0)" onclick="openNewsModal({{ json_encode($item) }})">{{ Str::limit($item->title, 50) }}</a>
                                                </h3>
                                                <p class="card-text">
                                                    {{ Str::limit(strip_tags($item->content), 80) }}
                                                </p>
                                                <button class="btn-detail" onclick="openNewsModal({{ json_encode($item) }})">
                                                    Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div style="text-align: center; padding: 60px 20px;">
                            <div style="margin-bottom: 20px; color: #cbd5e1;">
                                <ion-icon name="newspaper-outline" style="font-size: 64px;"></ion-icon>
                            </div>
                            <h3 class="h3" style="color: #64748b; margin-bottom: 10px;">Belum ada berita saat ini</h3>
                            <p style="color: #94a3b8;">Nantikan informasi kegiatan terbaru dari Inspektorat Kota Gorontalo.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- News Modal --}}
            <div id="news-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeNewsModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="modal-img" src="" alt="News Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            {{-- Gallery Modal --}}
            <div id="gallery-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeGalleryModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="gallery-modal-img" src="" alt="Gallery Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="gallery-modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="gallery-modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="gallery-modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            

            <script>
                function openNewsModal(newsItem) {
                    const modal = document.getElementById('news-modal');
                    const img = document.getElementById('modal-img');
                    const title = document.getElementById('modal-title');
                    const date = document.getElementById('modal-date');
                    const desc = document.getElementById('modal-desc');

                    // Set Content
                    img.src = "{{ asset('storage/') }}/" + newsItem.image_path;
                    title.innerText = newsItem.title;
                    
                    // Format Date (Simple JS date)
                    const d = new Date(newsItem.created_at);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    date.innerText = d.toLocaleDateString('id-ID', options);
                    
                    desc.innerText = newsItem.content; // Use innerText to treat as plain text if content is plain, or innerHTML if it contains safe HTML

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                }

                function closeNewsModal() {
                    const modal = document.getElementById('news-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                // Close on click outside
                document.getElementById('news-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeNewsModal();
                    }
                });

                /* Gallery Modal Functions */
                function openGalleryModal(item) {
                    const modal = document.getElementById('gallery-modal');
                    const img = document.getElementById('gallery-modal-img');
                    const title = document.getElementById('gallery-modal-title');
                    const desc = document.getElementById('gallery-modal-desc');
                    const date = document.getElementById('gallery-modal-date');

                    const basePath = item.is_local ? "{{ asset('') }}" : "{{ asset('storage/') }}/";
                    // If item.image_path (from DB) or item.image_path (from fallback, wait fallback use 'image')
                    // Let's standardise
                    let imageSrc = '';
                    if(item.is_local) {
                        imageSrc = basePath + item.image_path; // item.image_path passed as "images/..."
                    } else {
                        imageSrc = basePath + item.image_path;
                    }
                    
                    img.src = imageSrc;
                    title.innerText = item.title;
                    desc.innerText = item.description || '';
                    
                    // Add date if available (optional, but matching news structure)
                    if(item.created_at) {
                         const d = new Date(item.created_at);
                         const options = { year: 'numeric', month: 'long', day: 'numeric' };
                         date.innerText = d.toLocaleDateString('id-ID', options);
                         date.style.display = 'block';
                    } else {
                        date.style.display = 'none';
                    }

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }

                function closeGalleryModal() {
                    const modal = document.getElementById('gallery-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                document.getElementById('gallery-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeGalleryModal();
                    }
                });
            </script>

            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Hubungi Kami</p>
                        <h2 class="h2 section-title">Ada Pertanyaan atau Masukan?</h2>
                        <p class="section-text">
                            Tim Inspektorat Kota Gorontalo siap membantu Anda. Jangan ragu untuk menghubungi kami
                            jika memiliki pertanyaan, saran, atau membutuhkan bantuan terkait pelaporan.
                        </p>
                    </div>
                    <a href="#gg" class="btn btn-secondary">Hubungi Kami</a>
                </div>
            </section>

        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="{{ asset('images/test.png') }}" alt="Inspektorat logo" loading="lazy" decoding="async">
                    </a>
                    <p class="footer-text">
                        SI-ADUAN — Sistem Informasi Pengaduan Dugaan Tindak Pidana Korupsi
                        Inspektorat Kota Gorontalo.
                    </p>
                </div>

                <div class="footer-contact">
                    <h4 class="contact-title" id="gg">Hubungi Kami</h4>
                    <p class="contact-text">Kami siap membantu Anda.</p>
                    <ul>
                        <li class="contact-item">
                            <ion-icon name="call-outline"></ion-icon>
                            <a href="tel:+6282349656594" class="contact-link">+62823-49-6565-94</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>
                            <a href="mailto:inspektoratgtlo@gmail.com"
                                class="contact-link">inspektoratgtlo@gmail.com</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>
                            <address>Jl. Achmad Nadjamuddin No 11 Wumialo Kota Gorontalo, Gorontalo</address>
                        </li>
                    </ul>
                </div>

                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d558.6719892285665!2d123.05598984058676!3d0.5572244054739232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1768815766156!5m2!1sid!2sid"
                        width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">
                    © {{ date('Y') }} <a href="">Inspektorat Kota Gorontalo</a>. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script src="{{ asset('js/script1.js') }}"></script>

    <script>
        // Keyboard and scrollspy controls for sidebar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const navbar = document.querySelector('[data-navbar]');
                const overlay = document.querySelector('[data-overlay]');
                if (navbar && navbar.classList.contains('active')) {
                    navbar.classList.remove('active');
                    if (overlay) overlay.classList.remove('active');
                }
            }
        });

        // Scrollspy to update active state on sidebar and desktop navbar links
        const trackedSections = document.querySelectorAll('section[id]');
        const sidebarSectionLinks = document.querySelectorAll('.sidebar-link[data-nav-link]');
        const desktopNavLinks = document.querySelectorAll('.desktop-nav .navbar-link');

        window.addEventListener('scroll', function() {
            let currentSection = '';
            const scrollPos = window.pageYOffset;

            trackedSections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 120;
                const sectionId = section.getAttribute('id');

                if (scrollPos > sectionTop && scrollPos <= sectionTop + sectionHeight) {
                    currentSection = sectionId;
                }
            });

            if (currentSection) {
                sidebarSectionLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });

                desktopNavLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });
            }
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
