<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SI-ADUAN — Sistem Pengaduan Dugaan Tindak Pidana Korupsi Inspektorat Kota Gorontalo. Laporkan secara aman dan terstruktur dengan metode 5W+1H.">

    <title>{{ config('app.name', 'SI-ADUAN') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-slate-50">
    <div class="min-h-screen flex flex-col relative overflow-hidden">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <main class="flex-grow z-10 w-full relative">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="z-10 relative border-t border-slate-200 bg-white/50 backdrop-blur-sm">
            <div class="max-w-2xl mx-auto px-4 py-4 text-center">
                <p class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} SI-ADUAN &mdash; Inspektorat Kota Gorontalo. Hak cipta dilindungi.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>
