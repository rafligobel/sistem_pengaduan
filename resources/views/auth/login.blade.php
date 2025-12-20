<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-slate-900">Selamat Datang</h2>
        <p class="text-sm text-slate-500 mt-2">Silakan masuk untuk melanjutkan pengaduan</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                    </svg>
                </div>
                <x-text-input id="email"
                    class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                    </svg>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer"
                    name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline transition duration-150 ease-in-out"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t border-gray-200 pt-6">
            <p class="text-sm text-slate-600">
                Belum punya akun pengaduan?
                <a href="{{ route('register') }}"
                    class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                    Daftar Disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
