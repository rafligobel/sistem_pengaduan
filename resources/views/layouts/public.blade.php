<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whistle Blowing System - Inspektorat Kota Gorontalo</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap-grid.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* Custom style untuk form agar serasi dengan tema */
        .form-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-submit {
            background: var(--majorelle-blue);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: var(--ocean-blue);
        }

        .step-indicator {
            margin-bottom: 30px;
            color: var(--majorelle-blue);
            font-weight: 700;
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
                        <li><a href="{{ url('/') }}" class="navbar-link">Home</a></li>
                        <li><a href="{{ route('complaint.check') }}" class="navbar-link">Cek Status</a></li>
                        @auth
                            <li><a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <article>
            @yield('content')
        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo"><img src="{{ asset('images/test.png') }}"
                            alt="Inspektorat logo"></a>
                    <p class="footer-text">Website Resmi dari Inspektorat Kota Gorontalo.</p>
                </div>
                <div class="footer-contact">
                    <h4 class="contact-title">Contact Us</h4>
                    <ul>
                        <li class="contact-item"><ion-icon name="call-outline"></ion-icon><a href="tel:+6282349656594"
                                class="contact-link">+62823-49-6565-94</a></li>
                        <li class="contact-item"><ion-icon name="location-outline"></ion-icon>
                            <address>Jl. Achmad Nadjamuddin No 11 Wumialo Kota Gorontalo</address>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">© {{ date('Y') }} Inspektorat Kota Gorontalo. All rights reserved</p>
            </div>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top><ion-icon name="chevron-up-outline"></ion-icon></a>
    <script src="{{ asset('js/script1.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
