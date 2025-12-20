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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-50 overflow-hidden">
        {{-- Sidebar Navigation --}}
        @include('layouts.navigation')

        {{-- Main Content Area --}}
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden md:pl-64 transition-all duration-300">
            @if (isset($header))
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-300 z-30 sticky top-0">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <div class="w-full">
                        {{ $header }}
                    </div>
                        {{-- Mobile Hamburger Trigger (Visible only on mobile inside header if we want, but usually sidebar handles its own mobile toggle or we add a specific bar. 
                             For simplicity, we'll let the user toggle via a button we'll ensure exists in the mobile view or header) --}}
                         <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-slate-600 md:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
