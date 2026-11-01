<x-public-layout>
    <div class="w-full py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Status Pengaduan</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-slate-500 text-xs font-medium">ID Tiket:</span>
                        <span class="font-mono font-bold text-blue-700 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded text-xs tracking-wide">{{ $complaint->token }}</span>
                    </div>
                </div>
                <a href="{{ route('status.index') }}" class="inline-flex items-center text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors bg-white px-3 py-2 rounded-lg border border-slate-200 shadow-sm hover:shadow">
                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                     Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Kolom Kiri: Detail Laporan 5W+1H --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden relative">
                        {{-- Decorative Top --}}
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>

                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wide">
                                    {{ $complaint->category->name ?? 'Umum' }}
                                </span>
                                <span class="text-slate-300">|</span>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $complaint->created_at->format('d F Y') }}
                                </div>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $complaint->created_at->format('H:i') }} WITA
                                </div>
                            </div>

                            {{-- 5W+1H Sections --}}
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Unsur 5W + 1H</h3>
                            <div class="space-y-3">
                                {{-- What --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-red-100 text-red-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Apa yang Terjadi (What)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">{{ $complaint->what }}</p>
                                </div>

                                {{-- Who --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-orange-100 text-orange-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Pihak yang Terlibat (Who)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">{{ $complaint->who }}</p>
                                </div>

                                {{-- Where --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-green-100 text-green-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Lokasi Kejadian (Where)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">{{ $complaint->where_location }}</p>
                                </div>

                                {{-- When --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-purple-100 text-purple-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Waktu Kejadian (When)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">{{ $complaint->when_time }}</p>
                                </div>

                                {{-- Why --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-teal-100 text-teal-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Latar Belakang (Why)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">
                                        @if($complaint->why)
                                            {{ $complaint->why }}
                                        @else
                                            <span class="text-slate-400 italic">Tidak diisi oleh pelapor</span>
                                        @endif
                                    </p>
                                </div>

                                {{-- How --}}
                                <div class="bg-slate-50/50 p-3 rounded-lg border border-slate-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-blue-100 text-blue-600 text-[10px] font-black">H</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">Kronologi & Modus (How)</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed ml-7">{{ $complaint->how }}</p>
                                </div>
                            </div>

                            {{-- Bukti Pendukung --}}
                            @if ($complaint->attachment)
                                <div class="mt-6 border-t border-slate-100 pt-4">
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Bukti Pendukung</h4>
                                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200">
                                        <a href="{{ route('attachments.show', ['complaint' => $complaint->id, 'token' => $complaint->token]) }}" target="_blank"
                                            class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Lihat File Bukti Lampiran
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Status & Riwayat --}}
                <div class="space-y-6">
                    {{-- Status Card --}}
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 p-5 overflow-hidden">
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4">Status Terkini</h4>
                        
                        @if ($complaint->status == 'menunggu' || $complaint->status == 'pending')
                            <div class="w-full py-4 text-center bg-amber-50 rounded-lg border border-amber-200 ring-2 ring-amber-50/50">
                                <span class="block text-2xl font-black text-amber-600 mb-1">MENUNGGU</span>
                                <span class="text-[10px] font-bold text-amber-800 tracking-wide uppercase">Menunggu Telaah Admin</span>
                            </div>
                        @elseif($complaint->status == 'diproses' || $complaint->status == 'proses')
                            <div class="w-full py-4 text-center bg-blue-50 rounded-lg border border-blue-200 ring-2 ring-blue-50/50">
                                <span class="block text-2xl font-black text-blue-600 mb-1">DIPROSES</span>
                                <span class="text-[10px] font-bold text-blue-800 tracking-wide uppercase">Diteruskan & Diverifikasi Tim Khusus</span>
                            </div>
                        @elseif($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                            <div class="w-full py-4 text-center bg-emerald-50 rounded-lg border border-emerald-200 ring-2 ring-emerald-50/50">
                                <span class="block text-2xl font-black text-emerald-600 mb-1">TERVERIFIKASI</span>
                                <span class="text-[10px] font-bold text-emerald-800 tracking-wide uppercase">Laporan Selesai Diverifikasi</span>
                            </div>
                        @elseif($complaint->status == 'ditolak')
                            <div class="w-full py-4 text-center bg-red-50 rounded-lg border border-red-200 ring-2 ring-red-50/50">
                                <span class="block text-2xl font-black text-red-600 mb-1">DITOLAK</span>
                                <span class="text-[10px] font-bold text-red-800 tracking-wide uppercase">Laporan Tidak Memenuhi Syarat</span>
                            </div>
                        @endif
                        
                        <div class="mt-4 pt-4 border-t border-slate-100">
                             <p class="text-[10px] text-center text-slate-400">Terakhir diperbarui: {{ $complaint->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    {{-- Timeline Tanggapan --}}
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                        <div class="bg-slate-50 px-5 py-3 border-b border-slate-100">
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Riwayat Tanggapan</h4>
                        </div>
                        <div class="p-5">
                            <ol class="relative border-l-2 border-slate-200 ml-2 space-y-8">
                                {{-- Item Laporan Dibuat --}}
                                <li class="ml-6 relative">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-[37px] ring-4 ring-white border border-blue-200">
                                         <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-xs font-bold text-slate-900">Laporan Dikirim</h3>
                                    <time class="block mb-2 text-[10px] font-medium text-slate-400">{{ $complaint->created_at->format('d M Y, H:i') }}</time>
                                    <p class="text-xs font-medium text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                        Pengaduan berhasil dikirim ke sistem SI-ADUAN.
                                    </p>
                                </li>

                                {{-- Loop Tanggapan --}}
                                @foreach($complaint->responses as $response)
                                    <li class="ml-6 relative">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-purple-100 rounded-full -left-[37px] ring-4 ring-white border border-purple-200">
                                            <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-xs font-bold text-slate-900">
                                            {{ $response->user->name ?? 'Admin' }}
                                            <span class="bg-purple-100 text-purple-700 text-[10px] font-bold mr-2 px-1.5 py-0.5 rounded ml-2 uppercase tracking-wide">
                                                {{ $response->user->roles->pluck('name')->first() ?? 'Petugas' }}
                                            </span>
                                        </h3>
                                        <time class="block mb-2 text-[10px] font-medium text-slate-400">{{ $response->created_at->format('d M Y, H:i') }}</time>
                                        <div class="p-3 text-xs font-normal text-slate-700 bg-slate-50 rounded-lg border border-slate-100 relative group">
                                            <div class="absolute top-3 left-[-5px] w-2.5 h-2.5 bg-slate-50 border-t border-l border-slate-100 transform -rotate-45"></div>
                                            "{{ $response->content }}"
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-public-layout>
