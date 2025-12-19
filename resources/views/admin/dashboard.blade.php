<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                Ringkasan Dashboard
            </h2>
            <p
                class="text-sm text-slate-700 font-medium mt-1 md:mt-0 bg-white px-3 py-1 rounded-full shadow-sm border border-slate-200">
                📅 Pembaruan: {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    {{-- Latar Belakang Halaman Terang --}}
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Section 1: Statistik Utama (Kartu Putih Bersih & Teks Gelap) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- CARD 1: TOTAL PENGADUAN --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-slate-200 hover:border-blue-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-600 uppercase tracking-wide">Total Masuk</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-900">
                                {{ $stats['complaints_total'] }}
                            </h3>
                        </div>
                        <div class="p-4 bg-blue-50 text-blue-700 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm font-medium text-slate-700">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-blue-600 mr-2"></span>
                        Semua laporan aktif
                    </div>
                </div>

                {{-- CARD 2: PENGGUNA TERDAFTAR --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-slate-200 hover:border-indigo-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-600 uppercase tracking-wide">Pengguna</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-900">
                                {{ $stats['users_count'] }}
                            </h3>
                        </div>
                        <div class="p-4 bg-indigo-50 text-indigo-700 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm font-medium text-slate-700">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-indigo-600 mr-2"></span>
                        Akun masyarakat
                    </div>
                </div>

                {{-- CARD 3: KATEGORI --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-slate-200 hover:border-purple-300 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-600 uppercase tracking-wide">Kategori</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-900">
                                {{ $stats['categories_count'] }}
                            </h3>
                        </div>
                        <div class="p-4 bg-purple-50 text-purple-700 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm font-medium text-slate-700">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-purple-600 mr-2"></span>
                        Jenis aduan
                    </div>
                </div>

                {{-- CARD 4: PENDING (Status Penting - Background Sedikit Kuning Agar Mencolok tapi Tetap Terang) --}}
                <div
                    class="bg-amber-50 rounded-xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-amber-100 rounded-bl-full opacity-50"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-bold text-amber-800 uppercase tracking-wide">Perlu Tindakan</p>
                            <h3 class="mt-2 text-4xl font-black text-slate-900">
                                {{ $stats['complaints_pending'] }}
                            </h3>
                        </div>
                        <div class="p-4 bg-white text-amber-600 rounded-lg shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm font-bold text-amber-800">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-amber-600 mr-2 animate-pulse"></span>
                        Status: Menunggu
                    </div>
                </div>

            </div>

            {{-- Section 2: Quick Actions & Banner --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Banner Utama (Warna Biru Tua Kontras untuk Header) --}}
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-8 text-slate-900 shadow-xl relative overflow-hidden">
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-10 -translate-y-10">
                        <svg class="w-72 h-72" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-3 text-slate-900">Pusat Pengaduan Masyarakat</h3>
                        <p class="text-slate-600 mb-8 text-base leading-relaxed max-w-lg">
                            Kelola laporan masuk dengan cepat dan efisien. Pastikan setiap aduan mendapatkan respon yang
                            tepat waktu.
                        </p>
                        <a href="{{ route('admin.complaints.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-lg transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Kelola Pengaduan Sekarang
                        </a>
                    </div>
                </div>

                {{-- Shortcut Menu (Putih Bersih) --}}
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6">
                    <h4
                        class="text-slate-900 font-extrabold text-lg mb-6 flex items-center border-b border-slate-100 pb-4">
                        <svg class="w-6 h-6 mr-2 text-slate-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Menu Cepat
                    </h4>
                    <div class="space-y-4">
                        <a href="{{ route('admin.users.index') }}"
                            class="group flex items-center justify-between p-4 rounded-xl bg-slate-50 hover:bg-blue-50 transition-colors border border-slate-200 hover:border-blue-200">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-blue-600 group-hover:border-blue-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="ml-4 text-base font-bold text-slate-700 group-hover:text-blue-800">Manajemen
                                    User</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                            class="group flex items-center justify-between p-4 rounded-xl bg-slate-50 hover:bg-purple-50 transition-colors border border-slate-200 hover:border-purple-200">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-purple-600 group-hover:border-purple-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="ml-4 text-base font-bold text-slate-700 group-hover:text-purple-800">Kategori
                                    Aduan</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-purple-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        {{-- NEW: Dokumentasi --}}
                        <a href="{{ route('admin.galleries.index') }}"
                            class="group flex items-center justify-between p-4 rounded-xl bg-slate-50 hover:bg-teal-50 transition-colors border border-slate-200 hover:border-teal-200">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-teal-600 group-hover:border-teal-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span
                                    class="ml-4 text-base font-bold text-slate-700 group-hover:text-teal-800">Dokumentasi</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-teal-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        {{-- NEW: System Config --}}
                        <a href="{{ route('admin.system.index') }}"
                            class="group flex items-center justify-between p-4 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors border border-slate-200 hover:border-slate-300">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-100 group-hover:text-slate-800 group-hover:border-slate-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span
                                    class="ml-4 text-base font-bold text-slate-700 group-hover:text-slate-900">Sistem & Konfigurasi</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-800" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Tabel Aktivitas Terbaru --}}
                <div class="lg:col-span-3 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h4 class="font-bold text-slate-800">Laporan Terbaru</h4>
                        <a href="{{ route('admin.complaints.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Pelapor</th>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestComplaints as $complaint)
                                    <tr class="bg-white border-b hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium text-slate-900">
                                            {{ $complaint->user->name ?? 'Anonim' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ Str::limit($complaint->title, 40) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $complaint->created_at->diffForHumans() }}
                                        </td>
                                         <td class="px-6 py-4">
                                             @if ($complaint->status == 'pending')
                                                <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded">Menunggu</span>
                                            @elseif($complaint->status == 'proses')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Diproses</span>
                                            @elseif($complaint->status == 'selesai')
                                                <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-slate-400 italic">Belum ada laporan masuk.</td>
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
