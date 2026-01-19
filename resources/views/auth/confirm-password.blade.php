<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Konfirmasi Password</h2>
        <p class="text-xs text-slate-500 mt-1">
            {{ __('Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-2">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs" />

            <x-text-input id="password" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
