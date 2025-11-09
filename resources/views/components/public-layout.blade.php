<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        {{-- Navigasi Publik --}}
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('landing') }}">
                                <x-application-logo
                                    class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                            <span class="ms-3 font-semibold text-lg text-gray-800 dark:text-gray-200">
                                {{ config('app.name', 'Laravel') }}
                            </span>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                        <a href="{{ route('complaint.public.step1.create') }}">
                            <x-primary-button>Buat Laporan</x-primary-button>
                        </a>
                        <a href="{{ route('status.index') }}">
                            <x-secondary-button>Cek Status</x-secondary-button>
                        </a>

                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Login
                                Admin</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>

        {{-- Footer Sederhana --}}
        <footer class="py-6 mt-12 bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>
