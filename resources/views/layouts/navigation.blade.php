{{-- SIDEBAR COMPONENT --}}
{{-- 1. MOBILE BACKDROP OVERLAY --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 z-40 md:hidden" style="display: none;"></div>

{{-- MOBILE BACKDROP --}}
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm md:hidden">
</div>

{{-- 2. SIDEBAR CONTAINER --}}
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 flex flex-col shadow-xl md:shadow-none">
    
    {{-- LOGO AREA --}}
    <div class="h-16 flex items-center justify-center border-b border-slate-300 px-6 bg-slate-50/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="block h-8 w-auto fill-current text-blue-600" />
            <span class="font-bold text-xl tracking-tight text-slate-800">SI-ADUAN</span>
        </a>
    </div>

    {{-- MENU LINKS AREA --}}
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        
        {{-- HOME --}}
        <x-responsive-nav-link :href="route('landing')" :active="request()->routeIs('landing')" class="rounded-lg mb-1">
            <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            {{ __('Beranda') }}
        </x-responsive-nav-link>

        {{-- DASHBOARD --}}
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg mb-1">
            <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M16.5 14.25l1.125 1.125" />
            </svg>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Menu Utama</p>

        {{-- MASYARAKAT: BUAT PENGADUAN --}}
        @role('masyarakat')
            <x-responsive-nav-link :href="route('complaint.public.step1.create')" :active="request()->routeIs('complaint.public.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                {{ __('Buat Pengaduan') }}
            </x-responsive-nav-link>
        @endrole

        {{-- INTERNAL: PENGADUAN MASUK --}}
        @hasanyrole('admin|petugas|walikota')
            <x-responsive-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                {{ __('Pengaduan Masuk') }}
            </x-responsive-nav-link>
        @endhasanyrole

        {{-- ADMIN MENU --}}
        @role('admin')
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Administrasi</p>
            
            <x-responsive-nav-link :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                {{ __('Berita') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                {{ __('Dokumentasi') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.5 1.5 0 002.122 0l4.318-4.318a1.5 1.5 0 000-2.122L11.16 3.66A1.5 1.5 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                {{ __('Kategori') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.935c.355-.129.668-.316.926-.533a9.353 9.353 0 00-4.49-8.455c-.39-.223-.593-.665-.593-1.116v-2.807a3.374 3.374 0 00-3.374-3.374h-2.25c-1.86 0-3.374 1.514-3.374 3.374v2.807c0 .451-.203.893-.593 1.116a9.353 9.353 0 00-4.49 8.455c.258.217.571.404.926.533a9.337 9.337 0 004.121.935 9.38 9.38 0 002.625-.372z" />
                </svg>
                {{ __('Manajemen Pengguna') }}
            </x-responsive-nav-link>

             <x-responsive-nav-link :href="route('admin.system.index')" :active="request()->routeIs('admin.system.*')" class="rounded-lg mb-1">
                <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ __('Sistem') }}
            </x-responsive-nav-link>
        @endrole
    </div>

    {{-- USER PROFILE BOTTOM --}}
    <div class="border-t border-slate-300 bg-slate-50/50 p-4">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg border border-blue-200">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800 truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-slate-500 truncate">
                     {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                </p>
            </div>
            
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Keluar">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
        <div class="mt-3">
             <a href="{{ route('profile.edit') }}" class="block text-center w-full py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-md hover:bg-slate-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                Edit Profil
             </a>
        </div>
    </div>
</aside>
