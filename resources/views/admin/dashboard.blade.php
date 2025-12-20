<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                Ringkasan Dashboard
            </h2>
            <p
                class="text-sm text-slate-700 font-medium bg-white px-3 py-1 rounded-full shadow-sm border border-slate-200">
                📅 Pembaruan: {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    {{-- Latar Belakang Halaman Terang (Compact Adjusted) --}}
    <div class="py-5 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Section 1: Statistik Utama (Kartu Putih Bersih & Teks Gelap) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- CARD 1: TOTAL PENGADUAN --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-blue-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total Masuk</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['complaints_total'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                        Semua laporan aktif
                    </div>
                </div>

                {{-- CARD 2: PENGGUNA TERDAFTAR --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-indigo-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Pengguna</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['users_count'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                        Akun masyarakat
                    </div>
                </div>

                {{-- CARD 3: KATEGORI --}}
                <div class="bg-white rounded-lg p-5 shadow-sm border border-slate-200 hover:border-purple-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Kategori</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['categories_count'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-medium text-slate-600">
                        <span class="inline-block w-2 h-2 rounded-full bg-purple-500 mr-2"></span>
                        Jenis aduan
                    </div>
                </div>

                {{-- CARD 4: PENDING --}}
                <div class="bg-amber-50 rounded-lg p-5 shadow-sm border border-amber-200 hover:border-amber-300 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-20 h-20 bg-amber-100 rounded-bl-full opacity-50"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-xs font-bold text-amber-800 uppercase tracking-wide">Pending</p>
                            <h3 class="mt-1 text-3xl font-black text-slate-900">
                                {{ $stats['complaints_pending'] }}
                            </h3>
                        </div>
                        <div class="p-3 bg-white text-amber-600 rounded-lg shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs font-bold text-amber-800">
                        <span class="inline-block w-2 h-2 rounded-full bg-amber-600 mr-2 animate-pulse"></span>
                        Perlu Tindakan
                    </div>
                </div>

            </div>

            {{-- Section 2: Quick Actions & Banner --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Banner Utama (Warna Biru Tua Kontras untuk Header) --}}
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-lg p-6 text-slate-900 shadow-sm relative overflow-hidden">
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-10 -translate-y-10">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-2 text-slate-900">Pusat Pengaduan Masyarakat</h3>
                        <p class="text-slate-600 mb-5 text-sm leading-relaxed max-w-lg">
                            Kelola laporan masuk dengan cepat dan efisien. Pastikan setiap aduan mendapatkan respon yang
                            tepat waktu.
                        </p>
                        <a href="{{ route('admin.complaints.index') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Kelola Pengaduan Sekarang
                        </a>
                    </div>
                </div>

                {{-- Shortcut Menu (Putih Bersih) --}}
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                         <h4 class="text-slate-900 font-bold text-base flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                            Menu Cepat
                        </h4>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-blue-50 transition-colors border border-slate-200 hover:border-blue-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-blue-600 group-hover:border-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-blue-800">Manajemen User</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-purple-50 transition-colors border border-slate-200 hover:border-purple-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-purple-600 group-hover:border-purple-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-purple-800">Kategori Aduan</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.galleries.index') }}"
                            class="group flex items-center justify-between p-3 rounded-lg bg-slate-50 hover:bg-teal-50 transition-colors border border-slate-200 hover:border-teal-200">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-teal-600 group-hover:border-teal-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover:text-teal-800">Dokumentasi</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Tabel Aktivitas Terbaru --}}
                <div class="lg:col-span-3 bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="px-5 py-3 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h4 class="font-bold text-slate-800 text-sm">Laporan Terbaru</h4>
                        <a href="{{ route('admin.complaints.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Pelapor</th>
                                    <th scope="col" class="px-5 py-3">Judul</th>
                                    <th scope="col" class="px-5 py-3">Tanggal</th>
                                    <th scope="col" class="px-5 py-3">Status</th>
                                    <th scope="col" class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestComplaints as $complaint)
                                    <tr class="bg-white border-b hover:bg-slate-50">
                                        <td class="px-5 py-3 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $complaint->user->name ?? 'Anonim' }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            {{ Str::limit($complaint->title, 35) }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            {{ $complaint->created_at->diffForHumans() }}
                                        </td>
                                         <td class="px-5 py-3 whitespace-nowrap">
                                             @if ($complaint->status == 'pending')
                                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded">Pending</span>
                                            @elseif($complaint->status == 'proses')
                                                <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded">Proses</span>
                                            @elseif($complaint->status == 'selesai')
                                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Selesai</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-[10px] font-bold px-2 py-0.5 rounded">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-right whitespace-nowrap">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-4 text-center text-slate-400 text-xs italic">Belum ada laporan masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
