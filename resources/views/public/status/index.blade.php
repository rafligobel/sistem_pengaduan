<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold">Cek Status Pengaduan</h2>
        <p class="text-sm text-gray-600">Masukkan token unik yang Anda dapatkan saat melapor.</p>
    </div>

    <form method="POST" action="{{ route('status.check') }}">
        @csrf

        <div>
            <x-input-label for="token" value="Token Pengaduan Anda" />
            <x-text-input id="token" class="block mt-1 w-full uppercase" type="text" name="token"
                :value="old('token')" required autofocus placeholder="CONTOH: A1B2C3D4E5" />
            <x-input-error :messages="$errors->get('token')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Cek Status
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
