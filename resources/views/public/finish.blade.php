<x-guest-layout>
    <div class="mb-4 text-center">
        {{-- Menambahkan ikon sukses untuk visual yang lebih baik --}}
        <svg class="mx-auto h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">Pengaduan Berhasil Terkirim</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Terima kasih, pengaduan Anda telah kami catat.
        </p>
    </div>

    <div class="text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Silakan simpan token berikut untuk mengecek status pengaduan Anda:
        </p>

        {{-- Styling untuk Token agar menonjol --}}
        <div class="my-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <code class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 tracking-widest">
                {{ $token }}
            </code>
        </div>

        <p class="text-xs text-gray-500 dark:text-gray-500">
            PENTING: Jangan berikan token ini kepada siapa pun.
        </p>
    </div>

    <div class="flex items-center justify-between mt-6">
        <a class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
            href="{{ route('landing') }}">
            &laquo; Ke Beranda
        </a>
        <x-primary-button onclick="location.href='{{ route('status.index') }}'">
            Cek Status Sekarang
        </x-primary-button>
    </div>
</x-guest-layout>
