<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WBS Inspektorat') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-black-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div
                class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="z-10 flex flex-col items-center mb-6">
            <a href="/" class="transition transform hover:scale-105">
                <x-application-logo class="w-24 h-24 fill-current text-blue-600 drop-shadow-md" />
            </a>
            <h1 class="mt-4 text-2xl font-bold text-slate-800 tracking-tight">Whistle Blowing System</h1>
            <p class="text-sm text-slate-500 font-medium">Inspektorat Kota Gorontalo</p>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/80 backdrop-blur-xl border border-white/20 shadow-2xl overflow-hidden sm:rounded-2xl z-10 transition-all duration-300 hover:shadow-blue-500/10">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-xs text-slate-400 z-10">
            &copy; {{ date('Y') }} Inspektorat Kota Gorontalo. All rights reserved.
        </div>
    </div>
</body>

</html>
