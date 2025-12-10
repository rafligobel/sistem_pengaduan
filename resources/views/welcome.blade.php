<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whistle Blowing System - Inspektorat Kota Gorontalo</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body id="top">

    <header class="header" data-header>
        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">
                <a href="#" class="text">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota" style="height: 50px;">
                </a>
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <nav class="navbar" data-navbar>
                    <div class="navbar-top">
                        <a href="#" class="logo">
                            <img src="{{ asset('images/logo-blue.svg') }}" alt="Inspektorat logo">
                        </a>
                        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="navbar-list">
                        <li>
                            <a href="#home" class="navbar-link" data-nav-link>Home</a>
                        </li>
                        <li>
                            <a href="#about" class="navbar-link" data-nav-link>Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#gallery" class="navbar-link" data-nav-link>Galeri</a>
                        </li>
                        <li>
                            <a href="#contact" class="navbar-link" data-nav-link>Hubungi Kami</a>
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
                                <li><a href="{{ route('register') }}"
                                        class="btn btn-secondary font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                                        Daftar Sekarang
                                    </a></li>
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <article>

            <section class="hero" id="home">
                <div class="container">
                    <h1 class="h2 hero-title">Whistle Blowing System</h1>
                    <h1 class="h3 hero-title">Inspektorat Kota Gorontalo</h1>

                    <p class="hero-text">
                        Website Resmi dari Inspektorat Kota Gorontalo untuk pengaduan dan keluhan masyarakat khususnya
                        yang berada di daerah kota Gorontalo
                    </p>

                    <div class="btn-group">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary">Buat Laporan
                                    Baru</a>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Riwayat Laporan</a>
                            @else
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary">Mulai
                                    Pengaduan</a>
                                <a href="{{ route('status.index') }}" class="btn btn-secondary">Cek Status Tiket</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </section>

            <section class="popular" id="about">
                <div class="container">
                    <h2 class="h2 section-title">Tentang Kami</h2>

                    <p class="section-text">
                        Selamat datang di Whistle Blowing System Inspektorat Kota Gorontalo. Website resmi ini kami
                        hadirkan untuk memfasilitasi pengaduan dan keluhan masyarakat yang berada di wilayah Kota
                        Gorontalo. Melalui sistem ini, masyarakat dapat melaporkan berbagai tindakan pelanggaran,
                        penyimpangan, maupun penyalahgunaan wewenang yang terjadi di lingkungan pemerintahan.
                    </p>

                    <h2 class="h3 section-title">Mengapa Melaporkan di Whistle Blowing System Kami?</h2>

                    <ul class="popular-list">
                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="{{ asset('images/ho.png') }}" alt="Kerahasiaan" loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <h3 class="h3 card-title">
                                        <span>Kerahasiaan Terjamin</span>
                                    </h3>
                                    <p class="card-text">
                                        Setiap laporan yang masuk dijaga dengan kerahasiaan yang tinggi.
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="{{ asset('images/hihi.png') }}" alt="Cepat Transparan" loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <h3 class="h3 card-title">
                                        <span>Proses Cepat & Transparan</span>
                                    </h3>
                                    <p class="card-text">
                                        Kami mengedepankan proses yang cepat dan transparan.
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li>
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
                                        Dengan anda melaporkan, pemerintahan bersih.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="gallery" id="gallery">
                <div class="container">
                    <h2 class="h2 section-title">Galeri Foto</h2>
                    <p class="section-text">
                        Selamat datang di Galeri Foto Inspektorat Kota Gorontalo! Di sini, Anda dapat menjelajahi
                        momen-momen berharga yang mencerminkan dedikasi, inovasi, dan kebersamaan tim kami.
                    </p>

                    <ul class="gallery-list">
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('images/1.jpg') }}" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('images/3.jpg') }}" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('images/2.jpg') }}" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('images/4.jpg') }}" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="{{ asset('images/5.jpg') }}" alt="Gallery image">
                            </figure>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Call To Action</p>
                        <h2 class="h2 section-title">Kami ingin Mendengar dari Anda !</h2>
                        <p class="section-text">
                            Kami siap membantu Anda! Jika Anda memiliki pertanyaan, saran, atau umpan balik, jangan ragu
                            untuk menghubungi kami.
                        </p>
                    </div>
                    <a href="#gg" class="btn btn-secondary">Contact Us !</a>
                </div>
            </section>

        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="{{ asset('images/test.png') }}" alt="Inspektorat logo">
                    </a>
                    <p class="footer-text">
                        Website Resmi dari Inspektorat Kota Gorontalo untuk pengaduan dan keluhan masyarakat khususnya
                        yang berada di daerah kota Gorontalo
                    </p>
                </div>

                <div class="footer-contact">
                    <h4 class="contact-title" id="gg">Contact Us</h4>
                    <p class="contact-text">Feel free to contact and reach us !!</p>
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
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.620779262984!2d123.0607833!3d0.5529833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792ad7c3905007%3A0x69654050207373!2sInspektorat%20Kota%20Gorontalo!5e0!3m2!1sid!2sid!4v1664807077732!5m2!1sid!2sid"
                        width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">
                    © {{ date('Y') }} <a href="">Inspektorat Kota Gorontalo</a>. All rights reserved
                </p>
            </div>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script src="{{ asset('js/script1.js') }}"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
