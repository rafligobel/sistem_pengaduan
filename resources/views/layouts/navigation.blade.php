<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    @role('admin|petugas|kepala_instansi')
        <x-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')">
            {{ __('Data Pengaduan') }}
        </x-nav-link>
    @endrole
</div>

<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        @role('admin|petugas|kepala_instansi')
            <x-responsive-nav-link :href="route('admin.complaints.index')" :active="request()->routeIs('admin.complaints.*')">
                {{ __('Data Pengaduan') }}
            </x-responsive-nav-link>
        @endrole
    </div>
</div>
