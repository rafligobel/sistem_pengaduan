<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    Detail Pengaduan
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-xs text-slate-500">ID Tiket:</span>
                    <span class="font-mono text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 rounded">#{{ $complaint->token }}</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                    <a href="{{ route('complaints.pdf', $complaint->id) }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-md font-bold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Unduh PDF</span>
                    </a>
                @endif
                <a href="{{ route('admin.complaints.index') }}"
                   class="inline-flex items-center px-3 py-1.5 bg-white border border-slate-300 rounded-md font-semibold text-xs text-slate-700 hover:bg-slate-50 transition shadow-sm">
                    &larr; Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-300 text-emerald-800 p-4 rounded-lg text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-50 border border-red-300 text-red-800 p-4 rounded-lg text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Kolom Kiri & Tengah: Detail Pengaduan 5W+1H --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                        <div class="p-6">
                            {{-- Header Card --}}
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4 mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900">Pengaduan #{{ $complaint->token }}</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Diajukan pada {{ $complaint->created_at->format('d F Y, H:i') }} WITA</p>
                                </div>
                                <div>
                                    @if ($complaint->status == 'menunggu' || $complaint->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            ⏳ Menunggu Telaah Admin
                                        </span>
                                    @elseif($complaint->status == 'diproses' || $complaint->status == 'proses')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                            ⚙️ Diproses (Diteruskan ke Verifikator)
                                        </span>
                                    @elseif($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            ✅ Terverifikasi (Selesai)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                            ❌ Laporan Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Info Pelapor & Kategori --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs mb-5 bg-slate-50 p-4 rounded-lg border border-slate-200">
                                <div>
                                    <p class="font-bold text-slate-500 uppercase tracking-wider text-[10px]">Nama Pelapor</p>
                                    <p class="text-slate-900 font-semibold mt-0.5">{{ $complaint->user->name ?? 'Anonim' }}</p>
                                    @if($complaint->user->nik)
                                        <p class="text-slate-500 text-[11px] font-mono">NIK: {{ $complaint->user->nik }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-slate-500 uppercase tracking-wider text-[10px]">Kontak</p>
                                    <p class="text-slate-900 font-semibold mt-0.5">{{ $complaint->user->email ?? '-' }}</p>
                                    @if($complaint->user->phone)
                                        <p class="text-slate-600 text-[11px]">Telp: {{ $complaint->user->phone }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-slate-500 uppercase tracking-wider text-[10px]">Jenis Dugaan Korupsi</p>
                                    <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                        {{ $complaint->category->name ?? 'Kategori Umum' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Unsur 5W+1H --}}
                            <div>
                                <h4 class="font-bold text-slate-900 mb-3 text-sm flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Uraian Fakta Kejadian (Prinsip 5W + 1H)
                                </h4>

                                <div class="space-y-3">
                                    {{-- What --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-red-100 text-red-600 text-[10px] font-black">W</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Apa yang Terjadi (What)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">{{ $complaint->what }}</p>
                                    </div>

                                    {{-- Who --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-orange-100 text-orange-600 text-[10px] font-black">W</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Pihak yang Terlibat (Who)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">{{ $complaint->who }}</p>
                                    </div>

                                    {{-- Where --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-green-100 text-green-600 text-[10px] font-black">W</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Lokasi Kejadian (Where)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">{{ $complaint->where_location }}</p>
                                    </div>

                                    {{-- When --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-purple-100 text-purple-600 text-[10px] font-black">W</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Waktu / Periode Kejadian (When)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">{{ $complaint->when_time }}</p>
                                    </div>

                                    {{-- Why --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-teal-100 text-teal-600 text-[10px] font-black">W</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Latar Belakang / Motif (Why)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">
                                            @if($complaint->why)
                                                {{ $complaint->why }}
                                            @else
                                                <span class="text-slate-400 italic">Tidak dicantumkan oleh pelapor</span>
                                            @endif
                                        </p>
                                    </div>

                                    {{-- How --}}
                                    <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-blue-100 text-blue-600 text-[10px] font-black">H</span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">Kronologi & Modus (How)</span>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-slate-800 leading-relaxed ml-7">{{ $complaint->how }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Bukti Pendukung --}}
                            @if ($complaint->attachment)
                                <div class="mt-6 border-t border-slate-200 pt-5">
                                    <h4 class="font-bold text-slate-900 mb-3 text-sm flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        Dokumen & Bukti Pendukung
                                    </h4>
                                    @php
                                        $attachmentPaths = explode('|', $complaint->attachment);
                                    @endphp
                                    <div class="space-y-2">
                                        @foreach($attachmentPaths as $index => $attPath)
                                            <div class="flex items-center justify-between p-3 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100 transition">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                                        #{{ $index + 1 }}
                                                    </div>
                                                    <div>
                                                        <span class="text-sm font-semibold text-slate-800">Lampiran Bukti {{ $index + 1 }}</span>
                                                        <p class="text-[11px] text-slate-500 font-mono">{{ basename($attPath) }}</p>
                                                    </div>
                                                </div>
                                                <a href="{{ route('attachments.show', $complaint) }}{{ $index > 0 ? '?index=' . $index : '' }}" target="_blank"
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-slate-300 rounded-md font-bold text-xs text-blue-600 hover:text-blue-700 hover:bg-blue-50 transition shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Buka File
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Panel Aksi Sesuai Role & Riwayat Tanggapan --}}
                <div class="space-y-6">

                    {{-- 1. MODE PIMPINAN (HANYA MELIHAT) --}}
                    @role('pimpinan')
                        <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">Hak Akses Pimpinan</h3>
                                    <p class="text-[11px] text-slate-500">Mode Pengawasan Eksekutif</p>
                                </div>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 text-xs text-slate-600 leading-relaxed">
                                Pimpinan memiliki hak akses untuk memantau seluruh proses laporan pengaduan tanpa mengubah status laporan atau data sistem.
                            </div>
                        </div>
                    @endrole

                    {{-- 2. AKSI ADMIN (MENERIMA LAPORAN, PROSES KE VERIFIKATOR / TOLAK, DAN TANGGAPI) --}}
                    @role('admin')
                        {{-- Panel Aksi Awal Admin jika status 'menunggu' --}}
                        @if($complaint->status == 'menunggu' || $complaint->status == 'pending')
                            <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                                <div class="bg-amber-500 px-5 py-3 text-white">
                                    <h3 class="text-sm font-bold flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Aksi Admin: Telaah Laporan Masuk
                                    </h3>
                                    <p class="text-[11px] text-amber-100 mt-0.5">
                                        Laporan ini baru masuk. Tentukan apakah laporan diproses dan diteruskan ke Verifikator atau ditolak.
                                    </p>
                                </div>

                                <div class="p-5 space-y-4">
                                    {{-- Form Proses (Teruskan ke Verifikator) --}}
                                    <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="space-y-3" onsubmit="return confirm('Apakah Anda yakin ingin memproses laporan ini dan meneruskannya ke Verifikator?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="diproses">

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Tindakan (Opsional)</label>
                                            <textarea name="note" rows="2" class="w-full text-xs rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Catatan atau instruksi untuk Verifikator..."></textarea>
                                        </div>

                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-xs rounded-lg shadow transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                            </svg>
                                            Proses & Teruskan ke Verifikator
                                        </button>
                                    </form>

                                    <div class="relative flex py-1 items-center">
                                        <div class="flex-grow border-t border-slate-200"></div>
                                        <span class="flex-shrink mx-2 text-[10px] text-slate-400 uppercase font-bold">atau</span>
                                        <div class="flex-grow border-t border-slate-200"></div>
                                    </div>

                                    {{-- Form Tolak Laporan --}}
                                    <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="space-y-3" onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK laporan ini?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Alasan Penolakan</label>
                                            <textarea name="note" rows="2" required class="w-full text-xs rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="Tulis alasan mengapa laporan ini ditolak..."></textarea>
                                        </div>

                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-bold text-xs rounded-lg shadow transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak Laporan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            {{-- Info Status untuk Admin jika bukan 'menunggu' --}}
                            <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-4">
                                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status Saat Ini</h4>
                                @if($complaint->status == 'diproses')
                                    <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg text-xs text-blue-800">
                                        Laporan telah diproses dan diteruskan ke <strong>Verifikator</strong> untuk verifikasi.
                                    </div>
                                @elseif($complaint->status == 'terverifikasi')
                                    <div class="bg-emerald-50 border border-emerald-200 p-3.5 rounded-lg text-xs text-emerald-800 space-y-2.5">
                                        <p>Laporan telah <strong>Terverifikasi</strong> dan dinyatakan lolos verifikasi.</p>
                                        <a href="{{ route('complaints.pdf', $complaint->id) }}" target="_blank"
                                           class="inline-flex items-center justify-center gap-1.5 w-full px-3 py-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs rounded-md shadow-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Unduh Dokumen PDF Resmi</span>
                                        </a>
                                    </div>
                                @elseif($complaint->status == 'ditolak')
                                    <div class="bg-red-50 border border-red-200 p-3 rounded-lg text-xs text-red-800">
                                        Laporan ini telah <strong>Ditolak</strong>.
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Form Tanggapan Admin --}}
                        <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
                            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Tanggapi Laporan Pengaduan
                            </h3>
                            <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}" class="space-y-3">
                                @csrf
                                <div>
                                    <label for="content" class="block text-xs font-semibold text-slate-700 mb-1">Isi Tanggapan Resmi</label>
                                    <textarea id="content" name="content" rows="3" required
                                              class="w-full text-xs rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Tulis penjelasan, hasil konfirmasi, atau tindak lanjut..."></textarea>
                                </div>

                                <div>
                                    <label for="status" class="block text-xs font-semibold text-slate-700 mb-1">Perbarui Status (Opsional)</label>
                                    <select name="status" id="status" class="w-full text-xs rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="" selected>-- Tetap Gunakan Status Saat Ini ({{ ucfirst($complaint->status) }}) --</option>
                                        <option value="menunggu">Menunggu</option>
                                        <option value="diproses">Diproses (Teruskan ke Verifikator)</option>
                                        <option value="terverifikasi">Terverifikasi</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs rounded-lg shadow transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Kirim Tanggapan
                                </button>
                            </form>
                        </div>
                    @endrole

                    {{-- 3. AKSI VERIFIKATOR (MENERIMA LAPORAN YANG DITERUSKAN OLEH ADMIN, VERIFIKASI ATAU TOLAK) --}}
                    @role('verifikator')
                        @if($complaint->status == 'diproses')
                            <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                                <div class="bg-blue-600 px-5 py-3 text-white">
                                    <h3 class="text-sm font-bold flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Aksi Verifikator: Verifikasi Laporan
                                    </h3>
                                    <p class="text-[11px] text-blue-100 mt-0.5">
                                        Laporan ini telah diteruskan oleh Admin untuk diverifikasi. Tentukan hasil verifikasi Verifikator.
                                    </p>
                                </div>

                                <div class="p-5 space-y-4">
                                    {{-- Form Verifikasi (Lolos) --}}
                                    <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="space-y-3" onsubmit="return confirm('Apakah Anda yakin laporan ini telah VALID dan LOLOS verifikasi? Status akan menjadi Terverifikasi.');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="terverifikasi">

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Verifikasi (Opsional)</label>
                                            <textarea name="note" rows="2" class="w-full text-xs rounded-lg border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Hasil telaah berkas dan verifikasi lapangan..."></textarea>
                                        </div>

                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs rounded-lg shadow transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Verifikasi Laporan (Lolos)
                                        </button>
                                    </form>

                                    <div class="relative flex py-1 items-center">
                                        <div class="flex-grow border-t border-slate-200"></div>
                                        <span class="flex-shrink mx-2 text-[10px] text-slate-400 uppercase font-bold">atau</span>
                                        <div class="flex-grow border-t border-slate-200"></div>
                                    </div>

                                    {{-- Form Tolak Laporan --}}
                                    <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="space-y-3" onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK laporan ini setelah verifikasi?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Alasan Penolakan</label>
                                            <textarea name="note" rows="2" required class="w-full text-xs rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="Jelaskan kekurangan bukti atau dasar penolakan..."></textarea>
                                        </div>

                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-bold text-xs rounded-lg shadow transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak Laporan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif($complaint->status == 'menunggu')
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center">
                                <span class="text-2xl">⏳</span>
                                <h4 class="font-bold text-xs text-amber-900 mt-2">Menunggu Telaah Awal Admin</h4>
                                <p class="text-[11px] text-amber-700 mt-1 leading-relaxed">
                                    Laporan ini belum diteruskan ke Verifikator. Admin akan menelaah laporan terlebih dahulu dan mengubah status menjadi "Diproses" sebelum Anda dapat memverifikasinya.
                                </p>
                            </div>
                        @elseif($complaint->status == 'terverifikasi')
                            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center">
                                <span class="text-2xl">✅</span>
                                <h4 class="font-bold text-xs text-emerald-900 mt-2">Telah Terverifikasi</h4>
                                <p class="text-[11px] text-emerald-700 mt-1 mb-3">
                                    Laporan ini telah dinyatakan lolos verifikasi oleh Verifikator.
                                </p>
                                <a href="{{ route('complaints.pdf', $complaint->id) }}" target="_blank"
                                   class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold text-xs rounded-md shadow-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Unduh Dokumen PDF Resmi</span>
                                </a>
                            </div>
                        @elseif($complaint->status == 'ditolak')
                            <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                                <span class="text-2xl">❌</span>
                                <h4 class="font-bold text-xs text-red-900 mt-2">Laporan Ditolak</h4>
                                <p class="text-[11px] text-red-700 mt-1">
                                    Laporan ini tidak memenuhi syarat atau telah ditolak.
                                </p>
                            </div>
                        @endif
                    @endrole

                    {{-- Riwayat Tanggapan & Catatan Tindakan --}}
                    <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
                        <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Riwayat Tindakan & Tanggapan
                        </h3>

                        <div class="space-y-3">
                            @forelse ($complaint->responses as $response)
                                <div class="p-3.5 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex justify-between items-center mb-1.5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold">
                                                {{ substr($response->user->name ?? 'A', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800 text-xs">
                                                    {{ $response->user->name ?? 'Petugas' }}
                                                </p>
                                                <p class="text-[10px] text-slate-400">
                                                    {{ ucfirst($response->user->roles->pluck('name')->first() ?? 'Internal') }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-slate-400 font-mono">
                                            {{ $response->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-slate-700 leading-relaxed pl-8">
                                        {!! nl2br(e($response->content)) !!}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <p class="text-slate-400 text-xs italic">
                                        Belum ada catatan atau tanggapan.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
