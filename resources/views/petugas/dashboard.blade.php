<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Area Kerja Inspektur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Greeting --}}
            <div class="mb-6 px-2">
                <p class="text-slate-600 dark:text-slate-400">
                    Selamat bertugas, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>. Silakan
                    periksa laporan masuk di bawah ini.
                </p>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Pending --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-amber-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Perlu Verifikasi</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['pending'] }}
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Proses --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-blue-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Sedang Diproses</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['process'] }}
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                </div>

                {{-- Selesai --}}
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center justify-between hover:border-emerald-400 transition cursor-default">
                    <div>
                        <div class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">
                            Selesai</div>
                        <div class="text-3xl font-bold text-slate-800 dark:text-white mt-1">{{ $stats['finished'] }}
                        </div>
                    </div>
                    <div
                        class="p-3 rounded-full bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Action Banner --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-lg p-6 sm:p-10 text-slate-900 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2 text-slate-900">Tindak Lanjuti Laporan</h3>
                        <p class="text-slate-600 max-w-xl leading-relaxed">
                            Ada laporan masyarakat yang menunggu verifikasi atau tindak lanjut. Segera proses untuk
                            menjaga kepuasan pelayanan publik.
                        </p>
                    </div>
                    <a href="{{ route('admin.complaints.index') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center whitespace-nowrap">
                        Buka Daftar Pengaduan
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                {{-- Decorative background elements --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-slate-50 opacity-50 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-blue-50 opacity-50 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</x-app-layout>
