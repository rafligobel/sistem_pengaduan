<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Area Kerja Tim Khusus
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Verifikasi dan tindak lanjut laporan pengaduan yang diteruskan oleh Administrator.
                </p>
            </div>
            <p class="text-xs text-slate-700 font-medium bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                Petugas: <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Greeting & Alert --}}
            <div class="bg-gradient-to-r from-blue-900 to-indigo-900 text-white rounded-xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-800 text-blue-200 border border-blue-700 mb-2">
                        Tim Khusus Verifikator APIP
                    </span>
                    <h3 class="text-xl font-bold">Selamat bertugas, {{ Auth::user()->name }}</h3>
                    <p class="text-blue-100 text-xs mt-1 leading-relaxed max-w-xl">
                        Tugas Anda adalah memverifikasi laporan yang telah diteruskan oleh Admin (berstatus <strong>Diproses</strong>). Anda dapat menyetujui dengan klik <strong>Verifikasi Laporan</strong> atau menolak dengan klik <strong>Tolak Laporan</strong>.
                    </p>
                </div>
                <a href="{{ route('admin.complaints.index', ['status' => 'diproses']) }}"
                   class="shrink-0 px-4 py-2.5 bg-white text-blue-900 hover:bg-blue-50 font-bold text-xs rounded-lg transition shadow">
                    Buka Laporan Perlu Verifikasi ({{ $stats['diproses'] }}) &rarr;
                </a>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Diproses (Perlu Verifikasi) --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-blue-200 bg-blue-50/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-blue-800 uppercase tracking-wider">Perlu Verifikasi</p>
                            <h3 class="text-3xl font-black text-blue-900 mt-1">{{ $stats['diproses'] }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-100 text-blue-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-blue-700 font-semibold flex items-center gap-1">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                        Diteruskan oleh Admin
                    </p>
                </div>

                {{-- Terverifikasi --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-emerald-200 bg-emerald-50/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider">Lolos Terverifikasi</p>
                            <h3 class="text-3xl font-black text-emerald-900 mt-1">{{ $stats['terverifikasi'] }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-emerald-100 text-emerald-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-emerald-700 font-semibold">Telah selesai diverifikasi</p>
                </div>

                {{-- Ditolak --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-red-200 bg-red-50/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-red-800 uppercase tracking-wider">Ditolak</p>
                            <h3 class="text-3xl font-black text-red-900 mt-1">{{ $stats['ditolak'] }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-red-100 text-red-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-red-700 font-semibold">Tidak memenuhi kriteria</p>
                </div>

                {{-- Menunggu di Admin --}}
                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tahap Telaah Admin</p>
                            <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['menunggu'] }}</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-slate-100 text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-slate-500">Belum diteruskan ke tim khusus</p>
                </div>
            </div>

            {{-- Daftar Laporan Yang Perlu Diverifikasi --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Laporan Diteruskan untuk Verifikasi</h4>
                        <p class="text-[11px] text-slate-500">Daftar laporan berstatus 'Diproses' yang menunggu aksi verifikasi atau penolakan oleh Tim Khusus.</p>
                    </div>
                    <a href="{{ route('admin.complaints.index', ['status' => 'diproses']) }}" class="text-xs font-bold text-blue-600 hover:underline">
                        Lihat Semua ({{ $stats['diproses'] }}) &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-500">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th scope="col" class="px-5 py-3">Tiket</th>
                                <th scope="col" class="px-5 py-3">Pelapor</th>
                                <th scope="col" class="px-5 py-3">Uraian Kejadian</th>
                                <th scope="col" class="px-5 py-3">Kategori</th>
                                <th scope="col" class="px-5 py-3">Tanggal Diterima</th>
                                <th scope="col" class="px-5 py-3 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($needVerification as $item)
                                <tr class="bg-white border-b hover:bg-slate-50 transition">
                                    <td class="px-5 py-3 font-mono font-bold text-blue-600 text-xs">
                                        #{{ $item->token }}
                                    </td>
                                    <td class="px-5 py-3 font-semibold text-slate-900 whitespace-nowrap">
                                        {{ $item->user->name ?? 'Anonim' }}
                                    </td>
                                    <td class="px-5 py-3 text-slate-800">
                                        {{ Str::limit($item->what, 45) }}
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <span class="bg-amber-50 text-amber-800 border border-amber-200 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                            {{ $item->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-3 text-center whitespace-nowrap">
                                        <a href="{{ route('admin.complaints.show', $item->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-xs font-bold transition shadow-sm">
                                            <span>Verifikasi Sekarang</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-8 text-center text-slate-400 text-xs">
                                        <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Tidak ada laporan yang sedang menunggu verifikasi Tim Khusus saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
