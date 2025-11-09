<x-guest-layout>
    <div class="p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaduan Berhasil Terkirim!</h2>
        <p class="mt-4 text-gray-600 dark:text-gray-300">
            Terima kasih telah mengirimkan laporan Anda.
        </p>

        <p class="mt-6 text-gray-600 dark:text-gray-300">
            Harap simpan dan catat **Token Unik** di bawah ini untuk mengecek status pengaduan Anda:
        </p>

        <div class="mt-4 p-4 bg-indigo-100 dark:bg-gray-900 rounded-lg">
            <code class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 tracking-widest">
                {{ $token }}
            </code>
        </div>

        <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
            Anda dapat mengecek status pengaduan Anda kapan saja melalui tombol "Cek Status Pengaduan" di halaman utama.
        </p>

        <div class="mt-8">
            <a href="{{ route('status.show', $token) }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                Lihat Status Sekarang
            </a>
            <a href="{{ route('landing') }}"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</x-guest-layout>
