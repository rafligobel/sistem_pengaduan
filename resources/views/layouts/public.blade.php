<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whistle Blowing System - Inspektorat</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        header.header {
            z-index: 9999;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #0d2481 !important;
            color: white !important;
        }

        .btn-secondary {
            background-color: #f0f0f0 !important;
            color: #333 !important;
        }

        .btn-danger-custom {
            background-color: #dc3545 !important;
            color: white !important;
        }
    </style>
</head>

<body id="top">

    <header class="header" data-header>
        <div class="overlay" data-overlay></div>
        <div class="header-top">
            <div class="container">
                <a href="{{ route('landing') }}" class="text">
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
                        <a href="{{ route('landing') }}" class="logo">
                            <img src="{{ asset('images/logo-blue.svg') }}" alt="Inspektorat logo">
                        </a>
                        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>

                    <ul class="navbar-list">
                        <li><a href="{{ route('landing') }}" class="navbar-link">Home</a></li>
                        <li><a href="{{ route('landing') }}#about" class="navbar-link">Tentang Kami</a></li>
                        <li><a href="{{ route('landing') }}#contact" class="navbar-link">Hubungi Kami</a></li>

                        @auth
                            <li>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary"
                                    style="padding: 8px 20px; border-radius: 20px; margin-right: 5px;">Dashboard</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger-custom"
                                        style="padding: 8px 20px; border-radius: 20px; cursor: pointer;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-secondary"
                                    style="padding: 10px 20px; border-radius: 20px;">Login</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <article>
            {{ $slot }}
        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="{{ asset('images/test.png') }}" alt="Inspektorat logo">
                    </a>
                    <p class="footer-text">Whistle Blowing System Inspektorat Kota Gorontalo.</p>
                </div>
                <div class="footer-contact">
                    <h4 class="contact-title">Contact Us</h4>
                    <ul>
                        <li class="contact-item"><ion-icon name="call-outline"></ion-icon> +62823-49-6565-94</li>
                        <li class="contact-item"><ion-icon name="mail-outline"></ion-icon> inspektoratgtlo@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">&copy; {{ date('Y') }} Inspektorat Kota Gorontalo.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/script1.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
