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
    <style>
        body {
            zoom: 0.8;
        }
        
        /* Gallery Slider Styles */
        .gallery-slider-container {
            width: 100%;
            overflow: hidden;
            padding: 20px 0;
        }

        .gallery-slider {
            display: grid;
            grid-template-rows: repeat(2, 280px);
            grid-auto-flow: column;
            grid-auto-columns: 280px;
            gap: 20px;
            overflow-x: auto;
            padding: 10px 20px 30px 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .gallery-slider::-webkit-scrollbar {
            display: none;
        }

        .gallery-item-wrapper {
            scroll-snap-align: center;
            height: 100%;
            width: 100%;
        }

        .gallery-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            aspect-ratio: 1 / 1;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensure it fills wrapper */
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .gallery-banner {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .gallery-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-card:hover .gallery-banner img {
            transform: scale(1.1);
        }

        .gallery-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 25px 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 50%, transparent 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            z-index: 1;
        }

        .gallery-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            font-family: var(--ff-montserrat);
        }

        .gallery-desc {
            font-size: 0.9rem;
            color: #e2e8f0;
            font-weight: 400;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0.9;
        }
    </style>
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
                            <a href="#news" class="navbar-link" data-nav-link>Berita</a>
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
                                        class="btn btn-secondary font-medium text-blue-600 hover:text-blue-500 hover:underline">
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
                                    Setiap laporan yang masuk dijaga dengan kerahasiaan yang tinggi.
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
                                    Kami mengedepankan proses yang cepat dan transparan.
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
                                    Dengan anda melaporkan, pemerintahan bersih.
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
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
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
                                        ['image' => 'images/1.jpg', 'title' => 'Kegiatan Inspektorat', 'desc' => 'Dokumentasi kegiatan rutin inspektorat kota Gorontalo.'],
                                        ['image' => 'images/3.jpg', 'title' => 'Rapat Koordinasi', 'desc' => 'Koordinasi bersama staf dan pimpinan.'],
                                        ['image' => 'images/2.jpg', 'title' => 'Kunjungan Kerja', 'desc' => 'Kunjungan kerja ke beberapa instansi terkait.'],
                                        ['image' => 'images/4.jpg', 'title' => 'Sosialisasi', 'desc' => 'Kegiatan sosialisasi kepada masyarakat.'],
                                        ['image' => 'images/5.jpg', 'title' => 'Pelatihan', 'desc' => 'Pelatihan peningkatan kapasitas pegawai.'],
                                    ];
                                @endphp
                                @foreach($fallbacks as $fb)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({'image_path': '{{ $fb['image'] }}', 'title': '{{ $fb['title'] }}', 'description': '{{ $fb['desc'] }}', 'is_local': true})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset($fb['image']) }}" alt="Gallery image">
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

            <style>
                /* Modal Styles (Only minimal modal styles kept here if not in main CSS) */
                /* Actually let's move modal styles to main CSS too for cleanliness, but for this step I'll keep them or remove strictly if present in main CSS.
                   The user didn't ask to move modal styles but it's cleaner. 
                   Wait, I am replacing the big style block. I should preserve the modal styles unless I move them.
                   I didn't move modal styles to style.css yet.
                   I will keep the modal styles here for now or add them to the ReplacementContent.
                */
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    z-index: 1000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                    backdrop-filter: blur(5px);
                }
                .modal-content {
                    background: white;
                    padding: 25px;
                    border-radius: 15px;
                    max-width: 600px;
                    width: 100%;
                    max-height: 90vh;
                    overflow-y: auto;
                    position: relative;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                    animation: modalSlideIn 0.3s ease-out;
                }
                .modal-close-btn {
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    background: #f1f1f1;
                    border: none;
                    border-radius: 50%;
                    width: 32px;
                    height: 32px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 20px;
                    color: #333;
                    transition: background 0.2s;
                }
                .modal-close-btn:hover {
                    background: #e1e1e1;
                }
                @keyframes modalSlideIn {
                    from { transform: translateY(20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
            </style>

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
