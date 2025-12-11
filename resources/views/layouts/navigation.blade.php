{{-- MODIFIKASI: Navigasi Sticky dengan efek Glassmorphism (Slate Theme Unified) --}}
<nav x-data="{ open: false }"
    class="sticky top-0 z-50 bg-white/80 backdrop-blur-md dark:bg-slate-800/90 border-b border-slate-200 dark:border-slate-700 shadow-sm transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo Aplikasi --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-slate-800 dark:text-slate-200" />
                    </a>
                </div>

                {{-- MENU DESKTOP --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- 1. DASHBOARD (Semua Role) --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M14.25 16.5l1.125-1.125m0 0L16.5 14.25m1.125 1.125l-1.125 1.125M16.5 14.25l1.125 1.125" />
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- 2. MENU KHUSUS MASYARAKAT --}}
                    @role('masyarakat')
                        <x-nav-link :href="route('complaint.public.step1.create')" :active="request()->routeIs('complaint.public.*')">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('Buat Pengaduan') }}
                        </x-nav-link>
                    @endrole

                    {{-- 3. MENU KHUSUS ADMIN & PETUGAS (Inspektur) --}}
                    @hasanyrole('admin|petugas')
                        <x-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                            {{ __('Pengaduan Masuk') }}
                        </x-nav-link>
                    @endhasanyrole

                    {{-- 4. MENU KHUSUS ADMIN SAJA --}}
                    @role('admin')
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.5 1.5 0 002.122 0l4.318-4.318a1.5 1.5 0 000-2.122L11.16 3.66A1.5 1.5 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                            {{ __('Kategori') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.935c.355-.129.668-.316.926-.533a9.353 9.353 0 00-4.49-8.455c-.39-.223-.593-.665-.593-1.116v-2.807a3.374 3.374 0 00-3.374-3.374h-2.25c-1.86 0-3.374 1.514-3.374 3.374v2.807c0 .451-.203.893-.593 1.116a9.353 9.353 0 00-4.49 8.455c.258.217.571.404.926.533a9.337 9.337 0 004.121.935 9.38 9.38 0 002.625-.372z" />
                            </svg>
                            {{ __('Manajemen User') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            {{-- Settings Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 dark:text-slate-400 bg-white/50 dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex flex-col items-end">
                                <span>{{ Auth::user()->name }}</span>
                                <span class="text-xs text-slate-400 font-normal">
                                    {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                                </span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm border-b border-slate-200 dark:border-slate-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @role('masyarakat')
                <x-responsive-nav-link :href="route('complaint.public.step1.create')" :active="request()->routeIs('complaint.public.*')">
                    {{ __('Buat Pengaduan') }}
                </x-responsive-nav-link>
            @endrole

            @hasanyrole('admin|petugas')
                <x-responsive-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')">
                    {{ __('Pengaduan Masuk') }}
                </x-responsive-nav-link>
            @endhasanyrole

            @role('admin')
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                    {{ __('Kategori') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Manajemen User') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <div class="pt-4 pb-1 border-t border-slate-200 dark:border-slate-600">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800 dark:text-slate-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
