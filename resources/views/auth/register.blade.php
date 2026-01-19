<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Buat Akun</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan mendaftar untuk membuat pengaduan</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-2">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="name" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center border-t border-gray-200 pt-3">
            <p class="text-xs text-slate-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                    Masuk Disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
