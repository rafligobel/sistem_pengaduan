<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    Dashboard Administrator
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pusat kendali operasional dan manajemen sistem pengaduan.</p>
            </div>
            <p class="text-xs text-slate-700 font-medium bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                📅 Pembaruan: {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Section 1: Statistik Utama 4 Status & Pengguna --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                {{-- CARD 1: TOTAL PENGADUAN --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:border-slate-300 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Aduan</p>
                            <h3 class="mt-1 text-2xl font-black text-slate-900">
                                {{ $stats['complaints_total'] }}
                            </h3>
                        </div>
                        <div class="p-2.5 bg-slate-100 text-slate-700 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-slate-500">Semua laporan terdaftar</p>
                </div>

                {{-- CARD 2: MENUNGGU --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-amber-200 hover:border-amber-300 transition bg-amber-50/40">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-amber-800 uppercase tracking-wider">Menunggu</p>
                            <h3 class="mt-1 text-2xl font-black text-amber-900">
                                {{ $stats['complaints_menunggu'] }}
                            </h3>
                        </div>
                        <div class="p-2.5 bg-amber-100 text-amber-700 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-amber-700 font-semibold flex items-center gap-1">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Perlu telaah admin
                    </p>
                </div>

                {{-- CARD 3: DIPROSES --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-blue-200 hover:border-blue-300 transition bg-blue-50/40">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-blue-800 uppercase tracking-wider">Diproses</p>
                            <h3 class="mt-1 text-2xl font-black text-blue-900">
                                {{ $stats['complaints_diproses'] }}
                            </h3>
                        </div>
                        <div class="p-2.5 bg-blue-100 text-blue-700 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-blue-700 font-semibold">Diteruskan ke Verifikator</p>
                </div>

                {{-- CARD 4: TERVERIFIKASI --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-emerald-200 hover:border-emerald-300 transition bg-emerald-50/40">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider">Terverifikasi</p>
                            <h3 class="mt-1 text-2xl font-black text-emerald-900">
                                {{ $stats['complaints_terverifikasi'] }}
                            </h3>
                        </div>
                        <div class="p-2.5 bg-emerald-100 text-emerald-700 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-emerald-700 font-semibold">Lolos verifikasi</p>
                </div>

                {{-- CARD 5: DITOLAK --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-red-200 hover:border-red-300 transition bg-red-50/40 col-span-2 sm:col-span-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-red-800 uppercase tracking-wider">Ditolak</p>
                            <h3 class="mt-1 text-2xl font-black text-red-900">
                                {{ $stats['complaints_ditolak'] }}
                            </h3>
                        </div>
                        <div class="p-2.5 bg-red-100 text-red-700 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-red-700 font-semibold">Tidak memenuhi syarat</p>
                </div>

            </div>

            {{-- Section 2: Banner & Shortcut Menu --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Banner Utama --}}
                <div class="lg:col-span-2 bg-gradient-to-r from-blue-900 to-indigo-900 text-white rounded-xl p-6 shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-800/80 text-[11px] font-semibold text-blue-200 mb-3 border border-blue-700">
                            <span>Alur Kerja Administrator</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Penerimaan & Penerusan Pengaduan</h3>
                        <p class="text-blue-100 text-xs leading-relaxed max-w-xl">
                            Sebagai Admin, tugas utama Anda adalah menerima laporan masyarakat, menelaah kelengkapan data awal, dan memilih tindakan: <strong>Tolak</strong> atau <strong>Proses</strong> (meneruskan ke Verifikator), serta memberikan tanggapan tindak lanjut.
                        </p>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="{{ route('admin.complaints.index', ['status' => 'menunggu']) }}"
                           class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-slate-950 font-bold text-xs rounded-lg transition shadow">
                            ⏳ Telaah Laporan Menunggu ({{ $stats['complaints_menunggu'] }})
                        </a>
                        <a href="{{ route('admin.complaints.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs rounded-lg transition border border-white/20">
                            Semua Pengaduan Masuk &rarr;
                        </a>
                    </div>
                </div>

                {{-- Menu Cepat --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <h4 class="text-slate-900 font-bold text-sm mb-3 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Kelola Sistem & Master Data
                    </h4>

                    <div class="space-y-2">
                        <a href="{{ route('admin.users.index') }}"
                           class="group flex items-center justify-between p-2.5 rounded-lg bg-slate-50 hover:bg-blue-50 transition border border-slate-100 hover:border-blue-200">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-200 group-hover:text-blue-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-blue-800">Manajemen Pengguna</span>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-400 group-hover:text-blue-600">&rarr;</span>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           class="group flex items-center justify-between p-2.5 rounded-lg bg-slate-50 hover:bg-purple-50 transition border border-slate-100 hover:border-purple-200">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-200 group-hover:text-purple-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-purple-800">Kategori Aduan ({{ $stats['categories_count'] }})</span>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-400 group-hover:text-purple-600">&rarr;</span>
                        </a>

                        <a href="{{ route('admin.news.index') }}"
                           class="group flex items-center justify-between p-2.5 rounded-lg bg-slate-50 hover:bg-emerald-50 transition border border-slate-100 hover:border-emerald-200">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-200 group-hover:text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-800">Kelola Berita</span>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-400 group-hover:text-emerald-600">&rarr;</span>
                        </a>

                        <a href="{{ route('admin.galleries.index') }}"
                           class="group flex items-center justify-between p-2.5 rounded-lg bg-slate-50 hover:bg-teal-50 transition border border-slate-100 hover:border-teal-200">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-md bg-white flex items-center justify-center text-slate-600 shadow-sm border border-slate-200 group-hover:text-teal-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700 group-hover:text-teal-800">Dokumentasi Kegiatan</span>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-400 group-hover:text-teal-600">&rarr;</span>
                        </a>
                    </div>
                </div>

                {{-- Tabel Aktivitas Terbaru --}}
                <div class="lg:col-span-3 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Pengaduan Terbaru Masuk</h4>
                            <p class="text-[11px] text-slate-500">Daftar laporan masyarakat paling akhir yang perlu dipantau.</p>
                        </div>
                        <a href="{{ route('admin.complaints.index') }}" class="text-xs font-bold text-blue-600 hover:underline">
                            Lihat Semua Pengaduan &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Tiket</th>
                                    <th scope="col" class="px-5 py-3">Pelapor</th>
                                    <th scope="col" class="px-5 py-3">Ringkasan Uraian</th>
                                    <th scope="col" class="px-5 py-3">Kategori</th>
                                    <th scope="col" class="px-5 py-3">Waktu</th>
                                    <th scope="col" class="px-5 py-3">Status</th>
                                    <th scope="col" class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestComplaints as $complaint)
                                    <tr class="bg-white border-b hover:bg-slate-50 transition">
                                        <td class="px-5 py-3 font-mono font-bold text-blue-600 text-xs">
                                            #{{ $complaint->token }}
                                        </td>
                                        <td class="px-5 py-3 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $complaint->user->name ?? 'Anonim' }}
                                        </td>
                                        <td class="px-5 py-3 text-slate-800">
                                            {{ Str::limit($complaint->what, 40) }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <span class="bg-slate-100 text-slate-700 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                                {{ $complaint->category->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">
                                            {{ $complaint->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            @if ($complaint->status == 'menunggu' || $complaint->status == 'pending')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                    ⏳ Menunggu
                                                </span>
                                            @elseif($complaint->status == 'diproses' || $complaint->status == 'proses')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                    ⚙️ Diproses
                                                </span>
                                            @elseif($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    ✅ Terverifikasi
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-100 text-red-800 border border-red-200">
                                                    ❌ Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-right whitespace-nowrap">
                                            <div class="inline-flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded text-xs font-bold transition">
                                                    Buka
                                                </a>
                                                @if ($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                                                    <a href="{{ route('complaints.pdf', $complaint->id) }}" target="_blank" title="Unduh PDF Resmi"
                                                       class="inline-flex items-center px-2 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded text-xs font-bold transition">
                                                        <svg class="w-3.5 h-3.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        PDF
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-5 py-6 text-center text-slate-400 text-xs italic">Belum ada laporan masuk.</td>
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
