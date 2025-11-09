<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Cek Status Pengaduan</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Masukkan token unik yang Anda terima saat membuat pengaduan.
        </p>
    </div>

    {{-- Menampilkan error jika token tidak ditemukan --}}
    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form untuk cek status --}}
    <form method="POST" action="{{ route('status.check') }}">
        @csrf

        <div>
            <x-input-label for="token" value="Token Pengaduan Anda" />
            <x-text-input id="token" class="block mt-1 w-full" type="text" name="token" :value="old('token')"
                placeholder="CONTOH: A1B2C3D4E5" required autofocus />
            <x-input-error :messages="$errors->get('token')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Cek Status
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
