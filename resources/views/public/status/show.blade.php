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
                {{-- Kolom Kiri: Detail Laporan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden relative">
                        {{-- Decorative Top --}}
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>

                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-wide">
                                    {{ $complaint->category->name ?? 'Umum' }}
                                </span>
                                <span class="text-slate-300">|</span>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $complaint->created_at->format('d F Y') }}
                                </div>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $complaint->created_at->format('H:i') }} WIB
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-4 leading-snug">{{ $complaint->title }}</h3>
                            
                            <div class="prose prose-slate prose-sm max-w-none text-slate-600 mb-6 leading-relaxed bg-slate-50/50 p-4 rounded-lg border border-slate-100">
                                {!! nl2br(e($complaint->content)) !!}
                            </div>

                            @if ($complaint->attachment)
                                <div class="mt-6 border-t border-slate-100 pt-4">
                                    <h4 class="text-xs font-bold text-slate-900 mb-3 flex items-center">
                                        <svg class="w-3 h-3 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Bukti Lampiran
                                    </h4>
                                    <div class="rounded-lg overflow-hidden border border-slate-200 inline-block shadow-sm">
                                        {{-- Note: Ensure route 'attachments.show' exists or adjust as needed. Assuming typical storage link usage --}}
                                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">
                                             <img src="{{ asset('storage/' . $complaint->attachment) }}" alt="Bukti" class="max-w-full h-auto max-h-64 object-contain bg-slate-50 hover:bg-slate-100 transition-colors">
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
                        
                        @if ($complaint->status == 'pending')
                            <div class="w-full py-4 text-center bg-amber-50 rounded-lg border border-amber-100 ring-2 ring-amber-50/50">
                                <span class="block text-2xl font-black text-amber-500 mb-1">MENUNGGU</span>
                                <span class="text-[10px] font-bold text-amber-700 tracking-wide uppercase">Menunggu Verifikasi</span>
                            </div>
                        @elseif($complaint->status == 'proses')
                            <div class="w-full py-4 text-center bg-blue-50 rounded-lg border border-blue-100 ring-2 ring-blue-50/50">
                                <span class="block text-2xl font-black text-blue-600 mb-1">DIPROSES</span>
                                <span class="text-[10px] font-bold text-blue-700 tracking-wide uppercase">Sedang Ditindaklanjuti</span>
                            </div>
                        @elseif($complaint->status == 'selesai')
                            <div class="w-full py-4 text-center bg-emerald-50 rounded-lg border border-emerald-100 ring-2 ring-emerald-50/50">
                                <span class="block text-2xl font-black text-emerald-600 mb-1">SELESAI</span>
                                <span class="text-[10px] font-bold text-emerald-700 tracking-wide uppercase">Laporan Ditutup</span>
                            </div>
                        @elseif($complaint->status == 'ditolak')
                            <div class="w-full py-4 text-center bg-red-50 rounded-lg border border-red-100 ring-2 ring-red-50/50">
                                <span class="block text-2xl font-black text-red-600 mb-1">DITOLAK</span>
                                <span class="text-[10px] font-bold text-red-700 tracking-wide uppercase">Laporan Tidak Valid</span>
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
                                {{-- Item Laporan Dibuat (Default) --}}
                                <li class="ml-6 relative">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-[37px] ring-4 ring-white border border-blue-200">
                                         <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-xs font-bold text-slate-900">Laporan Dibuat</h3>
                                    <time class="block mb-2 text-[10px] font-medium text-slate-400">{{ $complaint->created_at->format('d M Y, H:i') }}</time>
                                    <p class="text-xs font-medium text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                        Laporan berhasil dikirim ke sistem.
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
                                            <span class="bg-purple-100 text-purple-700 text-[10px] font-bold mr-2 px-1.5 py-0.5 rounded ml-2 uppercase tracking-wide">Petugas</span>
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
