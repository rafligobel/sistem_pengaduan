<x-app-layout>
    {{-- Header Slot: Menyatu dengan Navigasi Dashboard --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Dashboard Pengaduan') }}
            </h2>
            {{-- Breadcrumb simpel --}}
            <div class="text-sm text-slate-500">
                Dashboard / Laporan Saya
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Greeting Section --}}
            <div class="mb-6 px-2">
                <p class="text-slate-600 dark:text-slate-400">
                    Selamat datang, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>! Berikut adalah
                    riwayat pengaduan yang telah Anda kirimkan.
                </p>
            </div>

            {{-- Main Card --}}
            <div
                class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-slate-200 dark:border-slate-700">

                {{-- Card Header & Tombol Aksi --}}
                <div
                    class="p-6 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Laporan Saya</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola dan pantau status tiket Anda.</p>
                    </div>

                    {{-- Tombol "Buat Laporan" yang lebih rapi --}}
                    <a href="{{ route('complaint.public.step1.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>

                {{-- Table Content --}}
                <div class="p-6">
                    @if (Auth::user()->complaints && Auth::user()->complaints->count() > 0)
                        <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-700">
                            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                                <thead
                                    class="bg-slate-50 dark:bg-slate-700 text-slate-800 dark:text-slate-200 uppercase text-xs font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">ID Tiket</th>
                                        <th class="px-6 py-4">Judul Laporan</th>
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-slate-200 dark:divide-slate-700 bg-white dark:bg-slate-800">
                                    @foreach (Auth::user()->complaints as $complaint)
                                        <tr
                                            class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition duration-150">
                                            <td class="px-6 py-4 font-mono font-bold text-blue-600">
                                                #{{ $complaint->ticket_id }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                                {{ Str::limit($complaint->title, 40) }}
                                            </td>
                                            <td class="px-6 py-4 text-slate-500">
                                                {{ $complaint->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($complaint->status == 'pending')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                        ⏳ Menunggu
                                                    </span>
                                                @elseif($complaint->status == 'proses')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        ⚙️ Proses
                                                    </span>
                                                @elseif($complaint->status == 'selesai')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        ✅ Selesai
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                        ❌ Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <a href="{{ route('complaint.public.finish', $complaint->ticket_id) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-semibold text-xs uppercase tracking-wide border border-blue-200 hover:border-blue-400 px-3 py-1 rounded-md transition">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-12 px-4">
                            <div
                                class="bg-slate-50 dark:bg-slate-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200 dark:border-slate-600">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900 dark:text-white">Belum ada laporan</h3>
                            <p class="text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto mb-6">Anda belum pernah
                                mengirimkan pengaduan. Laporan Anda akan muncul di sini.</p>

                            <a href="{{ route('complaint.public.step1.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 transition">
                                Mulai Buat Laporan
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}"
                    class="text-slate-400 hover:text-slate-600 text-sm font-medium transition flex items-center justify-center gap-1">
                    <span>&larr;</span> Kembali ke Halaman Utama
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
