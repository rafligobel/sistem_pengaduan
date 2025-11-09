<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Pengaduan Instansi')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    {{-- Ganti dengan logo instansi Anda --}}
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt="Logo Instansi">
                    <span class="font-bold ml-2 text-xl">Nama Instansi</span>
                </div>

                <div class="flex items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-12">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white mt-12">
        <div class="container mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Nama Instansi. All rights reserved.
        </div>
    </footer>

</body>

</html>
