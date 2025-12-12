<x-public-layout>
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 pt-32">
        <div class="max-w-5xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Status Pengaduan</h2>
                    <p class="text-slate-500 mt-1">
                        Tiket ID: <span class="font-mono font-bold text-slate-700 bg-slate-200 px-2 py-0.5 rounded">{{ $complaint->ticket_id }}</span>
                    </p>
                </div>
                <a href="{{ route('status.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
                    &larr; Kembali Cari
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Detail Laporan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wide">
                                    {{ $complaint->category->name ?? 'Umum' }}
                                </span>
                                <span class="text-xs text-slate-400">&bull;</span>
                                <span class="text-sm text-slate-500">{{ $complaint->created_at->format('d F Y, H:i') }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $complaint->title }}</h3>
                            
                            <div class="prose prose-slate max-w-none text-slate-600 mb-6 leading-relaxed">
                                {!! nl2br(e($complaint->content)) !!}
                            </div>

                            @if ($complaint->image)
                                <div class="mt-6 border-t border-slate-100 pt-6">
                                    <h4 class="text-sm font-bold text-slate-900 mb-3">Bukti Lampiran</h4>
                                    <div class="rounded-lg overflow-hidden border border-slate-200 inline-block">
                                        <img src="{{ asset('storage/' . $complaint->image) }}" alt="Bukti" class="max-w-full h-auto max-h-96 object-contain bg-slate-50">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Status & Riwayat --}}
                <div class="space-y-6">
                    {{-- Status Card --}}
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Status Terkini</h4>
                        
                        @if ($complaint->status == 'pending')
                            <div class="w-full py-4 text-center bg-amber-50 rounded-lg border border-amber-100">
                                <span class="block text-2xl font-black text-amber-600">PENDING</span>
                                <span class="text-xs font-medium text-amber-700">Menunggu Verifikasi</span>
                            </div>
                        @elseif($complaint->status == 'proses')
                            <div class="w-full py-4 text-center bg-blue-50 rounded-lg border border-blue-100">
                                <span class="block text-2xl font-black text-blue-600">DIPROSES</span>
                                <span class="text-xs font-medium text-blue-700">Sedang Ditindaklanjuti</span>
                            </div>
                        @elseif($complaint->status == 'selesai')
                            <div class="w-full py-4 text-center bg-emerald-50 rounded-lg border border-emerald-100">
                                <span class="block text-2xl font-black text-emerald-600">SELESAI</span>
                                <span class="text-xs font-medium text-emerald-700">Laporan Ditutup</span>
                            </div>
                        @elseif($complaint->status == 'ditolak')
                            <div class="w-full py-4 text-center bg-red-50 rounded-lg border border-red-100">
                                <span class="block text-2xl font-black text-red-600">DITOLAK</span>
                                <span class="text-xs font-medium text-red-700">Laporan Tidak Valid</span>
                            </div>
                        @endif
                    </div>

                    {{-- Timeline Tanggapan --}}
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="bg-slate-50 px-6 py-3 border-b border-slate-100">
                            <h4 class="text-sm font-bold text-slate-700">Riwayat Tanggapan</h4>
                        </div>
                        <div class="p-6">
                            <ol class="relative border-l border-slate-200 ml-2 space-y-8">
                                {{-- Item Laporan Dibuat (Default) --}}
                                <li class="ml-6">
                                    <span class="absolute flex items-center justify-center w-4 h-4 bg-blue-100 rounded-full -left-2 ring-4 ring-white">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-sm font-semibold text-slate-900">Laporan Dibuat</h3>
                                    <time class="block mb-2 text-xs font-normal leading-none text-slate-400">{{ $complaint->created_at->format('d M Y, H:i') }}</time>
                                    <p class="text-sm font-normal text-slate-500">Laporan berhasil dikirim ke sistem.</p>
                                </li>

                                {{-- Loop Tanggapan --}}
                                @foreach($complaint->responses as $response)
                                    <li class="ml-6">
                                        <span class="absolute flex items-center justify-center w-4 h-4 bg-purple-100 rounded-full -left-2 ring-4 ring-white">
                                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-sm font-semibold text-slate-900">
                                            {{ $response->user->name ?? 'Admin' }}
                                            <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ml-2">Petugas</span>
                                        </h3>
                                        <time class="block mb-2 text-xs font-normal leading-none text-slate-400">{{ $response->created_at->format('d M Y, H:i') }}</time>
                                        <div class="p-3 text-xs italic font-normal text-slate-600 bg-slate-50 rounded-lg border border-slate-100">
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
