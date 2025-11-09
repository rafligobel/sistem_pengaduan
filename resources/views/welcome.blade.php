{{-- Menggunakan layout publik baru kita --}}
<x-public-layout>

    {{-- Hero Section (Bagian Utama Landing Page) --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
        <div class="p-12 sm:p-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                Sistem Pengaduan Masyarakat
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Laporkan masalah, keluhan, atau aspirasi Anda dengan mudah, aman, dan transparan. Kami siap menanggapi.
            </p>

            {{-- Tombol Call to Action (CTA) --}}
            <div class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('complaint.public.step1.create') }}">
                    <x-primary-button class="w-full sm:w-auto !py-3 !px-8 !text-base">
                        <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12.572l-4.5-4.5" />
                        </svg>
                        Buat Laporan Sekarang
                    </x-primary-button>
                </a>
                <a href="{{ route('status.index') }}">
                    <x-secondary-button class="w-full sm:w-auto !py-3 !px-8 !text-base">
                        Cek Status Laporan Anda
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>

</x-public-layout>
