<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WBS Inspektorat') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 fixed w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center min-w-0">
                            <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3 group min-w-0">
                                <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo" class="h-8 w-auto transition-transform group-hover:scale-105 shrink-0">
                                <div class="min-w-0">
                                    <h1 class="text-xs sm:text-base font-bold text-slate-800 leading-none truncate">Whistle Blowing System</h1>
                                    <p class="hidden sm:block text-[10px] text-slate-500 font-medium truncate">Inspektorat Kota Gorontalo</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ url('/') }}" class="text-xs font-medium text-slate-500 hover:text-blue-600 transition-colors hidden sm:block">
                            Beranda
                        </a>
                        
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-3 py-1.5 sm:px-4 sm:py-2 border border-transparent text-[10px] sm:text-xs font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-md shadow-blue-200">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-3 py-1.5 sm:px-4 sm:py-2 border border-slate-200 text-[10px] sm:text-xs font-bold rounded-lg text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                                    Masuk
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow flex flex-col pt-20 sm:pt-24 pb-24 sm:pb-28">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 w-full z-40 fixed bottom-0">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <p class="text-xs text-slate-500">
                            &copy; {{ date('Y') }} <span class="font-bold text-slate-700">Inspektorat Kota Gorontalo</span>. All rights reserved.
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="text-xs text-slate-400 hover:text-blue-600 transition-colors">
                            <span class="sr-only">Privacy Policy</span>
                            Kebijakan Privasi
                        </a>
                        <a href="#" class="text-xs text-slate-400 hover:text-blue-600 transition-colors">
                            <span class="sr-only">Terms of Service</span>
                            Syarat & Ketentuan
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
