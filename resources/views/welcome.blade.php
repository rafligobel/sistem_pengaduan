<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan Masyarakat</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="p-6 text-right">
            @auth
                <a href="{{ route('admin.complaints.index') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard
                    Admin</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <x-application-logo class="w-20 h-20" />
            </div>

            <div class="mt-8 text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Sistem Informasi Pengaduan
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    Sampaikan laporan Anda langsung kepada kami.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="{{ route('complaint.public.step1.create') }}"
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Lakukan Pengaduan</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Klik di sini untuk memulai proses pelaporan baru. Kami akan memandu Anda langkah demi
                            langkah.
                        </p>
                    </div>
                </a>

                <a href="{{ route('status.index') }}"
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Cek Status Pengaduan</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Sudah membuat laporan? Masukkan token unik Anda untuk melihat status dan tanggapan dari
                            kami.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
