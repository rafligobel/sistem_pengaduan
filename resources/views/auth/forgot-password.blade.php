<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Lupa Password</h2>
        <p class="text-xs text-slate-500 mt-1">{{ __('Jangan khawatir. Masukkan email anda dan kami akan mengirimkan link reset password.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-3">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700 font-semibold text-xs" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-1">
            <x-primary-button class="w-full justify-center py-2 bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:-translate-y-0.5 transition duration-200 text-sm">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center border-t border-gray-200 pt-3">
            <a href="{{ route('login') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline transition duration-150">
                Kembali ke Halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>
