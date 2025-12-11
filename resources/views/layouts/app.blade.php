<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-M" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https-fonts.bunny.net" />
    <link href="https-fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- MODIFIKASI: Mengganti bg-gray-100 menjadi bg-slate-50 (lebih bersih/kebiruan) --}}
    <div class="min-h-screen bg-slate-50 dark:bg-slate-900">
        {{-- Kita muat navigasi yang sudah disempurnakan --}}
        @include('layouts.navigation')

        @if (isset($header))
            {{-- MODIFIKASI: Header transparan dengan backdrop blur --}}
            <header
                class="bg-white/80 backdrop-blur-md dark:bg-slate-800 shadow-sm border-b border-slate-200 dark:border-slate-700 sticky top-16 z-10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
