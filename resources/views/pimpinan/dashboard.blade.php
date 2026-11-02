<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    Dashboard Eksekutif Pimpinan
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Pemantauan transparan seluruh laporan pengaduan dan kinerja tindak lanjut APIP Inspektorat.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                    👁️ Mode Pengawasan (Hanya Melihat)
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Executive Banner --}}
            <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-blue-950 text-white rounded-xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-800 text-slate-300 border border-slate-700 mb-2">
                        Pimpinan Daerah & APIP Inspektorat
                    </span>
                    <h3 class="text-xl font-bold">Selamat datang, {{ Auth::user()->name }}</h3>
                    <p class="text-slate-300 text-xs mt-1 leading-relaxed max-w-xl">
                        Sistem menyajikan seluruh pengaduan tindak pidana korupsi secara utuh dan terperinci. Anda dapat meninjau kronologi 5W+1H, berkas lampiran pendukung, serta catatan verifikasi dari Admin dan Verifikator.
                    </p>
                </div>
                <a href="{{ route('admin.complaints.index') }}"
                   class="shrink-0 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg transition shadow">
                    Buka Seluruh Laporan Pengaduan &rarr;
                </a>
            </div>

            {{-- 4 Status Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Laporan</p>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total'] }}</h3>
                    <p class="mt-2 text-[10px] text-slate-500">Semua laporan masuk</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-amber-200 bg-amber-50/30">
                    <p class="text-[11px] font-bold text-amber-800 uppercase tracking-wider">⏳ Menunggu</p>
                    <h3 class="text-3xl font-black text-amber-900 mt-1">{{ $stats['menunggu'] }}</h3>
                    <p class="mt-2 text-[10px] text-amber-700">Tahap telaah Admin</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-blue-200 bg-blue-50/30">
                    <p class="text-[11px] font-bold text-blue-800 uppercase tracking-wider">⚙️ Diproses</p>
                    <h3 class="text-3xl font-black text-blue-900 mt-1">{{ $stats['diproses'] }}</h3>
                    <p class="mt-2 text-[10px] text-blue-700">Verifikasi Verifikator</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-emerald-200 bg-emerald-50/30">
                    <p class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider">✅ Terverifikasi</p>
                    <h3 class="text-3xl font-black text-emerald-900 mt-1">{{ $stats['terverifikasi'] }}</h3>
                    <p class="mt-2 text-[10px] text-emerald-700">Lolos & selesai</p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-red-200 bg-red-50/30 col-span-2 sm:col-span-1">
                    <p class="text-[11px] font-bold text-red-800 uppercase tracking-wider">❌ Ditolak</p>
                    <h3 class="text-3xl font-black text-red-900 mt-1">{{ $stats['ditolak'] }}</h3>
                    <p class="mt-2 text-[10px] text-red-700">Tidak memenuhi syarat</p>
                </div>

            </div>

            {{-- Recent Complaints Table --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Daftar Laporan Terkini</h4>
                        <p class="text-[11px] text-slate-500">Pantau perkembangan status penanganan laporan secara berkala.</p>
                    </div>
                    <a href="{{ route('admin.complaints.index') }}" class="text-xs font-bold text-blue-600 hover:underline">
                        Lihat Seluruh Pengaduan &rarr;
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
                                <th scope="col" class="px-5 py-3">Tanggal Lapor</th>
                                <th scope="col" class="px-5 py-3">Tahapan Status</th>
                                <th scope="col" class="px-5 py-3 text-right">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentComplaints as $complaint)
                                <tr class="bg-white border-b hover:bg-slate-50 transition">
                                    <td class="px-5 py-3 font-mono font-bold text-blue-600 text-xs whitespace-nowrap">
                                        #{{ $complaint->token }}
                                    </td>
                                    <td class="px-5 py-3 font-medium text-slate-900 whitespace-nowrap">
                                        {{ $complaint->user->name ?? 'Anonim' }}
                                    </td>
                                    <td class="px-5 py-3 text-slate-800">
                                        {{ Str::limit($complaint->what, 45) }}
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <span class="bg-slate-100 text-slate-700 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                            {{ $complaint->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">
                                        {{ $complaint->created_at->format('d M Y') }}
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
                                        <a href="{{ route('admin.complaints.show', $complaint->id) }}"
                                           class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-800 rounded text-xs font-bold transition">
                                            <span>Lihat</span>
                                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-8 text-center text-slate-400 text-xs italic">Belum ada pengaduan terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

