<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Dashboard Pengaduan') }}
            </h2>
            <div class="text-sm text-slate-500">
                Dashboard / Laporan Saya
            </div>
        </div>
    </x-slot>

    {{-- Fetch data once --}}
    @php
        $complaints = Auth::user()->complaints()->latest()->get();
    @endphp

    <div class="py-5" x-data="{ activeModal: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Greeting Section --}}
            <div class="mb-5 px-2">
                <h2 class="text-lg text-slate-800 flex items-center flex-wrap gap-1">
                    Selamat datang, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>!
                </h2>
                <p class="text-slate-600 mt-1">
                    Berikut adalah riwayat pengaduan yang telah Anda kirimkan.
                </p>
            </div>

            {{-- Main Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-300">

                <div class="p-6 bg-slate-50 border-b border-slate-300 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Daftar Laporan Saya</h3>
                        <p class="text-sm text-slate-500">Kelola dan pantau status tiket Anda.</p>
                    </div>

                    <a href="{{ route('complaint.public.step1.create') }}">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                            <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('Buat Laporan Baru') }}
                        </x-primary-button>
                    </a>
                </div>

                <div class="p-6">
                    @if ($complaints->count() > 0)
                        <div class="overflow-x-auto rounded-lg border border-slate-300">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-800 uppercase text-xs font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">ID Tiket</th>
                                        <th class="px-6 py-4">Judul Laporan</th>
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-300 bg-white">
                                    @foreach ($complaints as $complaint)
                                        <tr class="hover:bg-slate-50 transition duration-150">
                                            <td class="px-6 py-4 font-mono font-bold text-blue-600">
                                                #{{ $complaint->token }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-slate-900">
                                                {{ Str::limit($complaint->title, 40) }}
                                            </td>
                                            <td class="px-6 py-4 text-slate-500">
                                                {{ $complaint->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($complaint->status == 'pending')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                        ⏳ Menunggu
                                                    </span>
                                                @elseif($complaint->status == 'proses')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        ⚙️ Proses
                                                    </span>
                                                @elseif($complaint->status == 'selesai')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        ✅ Selesai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                        ❌ Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <button @click="activeModal = '{{ $complaint->id }}'"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-bold rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors cursor-pointer">
                                                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 px-4">
                            <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900">Belum ada laporan</h3>
                            <p class="text-slate-500 mt-1 max-w-sm mx-auto mb-6">Anda belum pernah mengirimkan pengaduan.</p>
                            <a href="{{ route('complaint.public.step1.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 transition">
                                Mulai Buat Laporan
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Modals Loop --}}
            @foreach ($complaints as $complaint)
                <div x-show="activeModal === '{{ $complaint->id }}'" 
                     class="relative z-[100]" 
                     style="display: none;">
                    
                    {{-- Backdrop --}}
                    <div x-show="activeModal === '{{ $complaint->id }}'"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" 
                         @click="activeModal = null"></div>

                    {{-- Modal Wrapper --}}
                    <div class="fixed inset-0 z-[100] w-screen overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                            
                            {{-- Modal Panel --}}
                            <div x-show="activeModal === '{{ $complaint->id }}'"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
                                
                                {{-- Header --}}
                                <div class="bg-blue-600 px-4 py-4 sm:px-6 flex justify-between items-center">
                                    <h3 class="text-base font-bold leading-6 text-white" id="modal-title">Detail Pengaduan</h3>
                                    <button type="button" @click="activeModal = null" class="text-blue-100 hover:text-white transition-colors focus:outline-none">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Body --}}
                                <div class="px-4 py-5 sm:p-6 space-y-5">
                                    
                                    {{-- Meta Info --}}
                                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">ID Tiket</p>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl font-mono font-bold text-blue-600">#{{ $complaint->token }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Tanggal</p>
                                            <p class="text-sm font-semibold text-slate-700">{{ $complaint->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Status Laporan</p>
                                        @if ($complaint->status == 'pending')
                                            <div class="flex items-center gap-2 text-amber-700 bg-amber-50 px-3 py-2 rounded-lg border border-amber-100">
                                                <span class="relative flex h-2 w-2">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                                </span>
                                                <span class="text-xs font-bold uppercase">Menunggu Verifikasi</span>
                                            </div>
                                        @elseif($complaint->status == 'proses')
                                            <div class="flex items-center gap-2 text-blue-700 bg-blue-50 px-3 py-2 rounded-lg border border-blue-100">
                                                <span class="relative flex h-2 w-2">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                                </span>
                                                <span class="text-xs font-bold uppercase">Sedang Diproses</span>
                                            </div>
                                        @elseif($complaint->status == 'selesai')
                                            <div class="flex items-center gap-2 text-emerald-700 bg-emerald-50 px-3 py-2 rounded-lg border border-emerald-100">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-xs font-bold uppercase">Selesai</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-2 text-red-700 bg-red-50 px-3 py-2 rounded-lg border border-red-100">
                                                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                <span class="text-xs font-bold uppercase">Ditolak</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">Isi Laporan</p>
                                        <h4 class="text-base font-bold text-slate-900 mb-2">{{ $complaint->title }}</h4>
                                        <div class="bg-slate-50 rounded-lg p-4 text-sm text-slate-600 border border-slate-100 max-h-48 overflow-y-auto leading-relaxed">
                                            {!! nl2br(e($complaint->content)) !!}
                                        </div>
                                    </div>

                                    {{-- Image --}}
                                    @if ($complaint->image)
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-2">Bukti Lampiran</p>
                                            <div class="rounded-lg overflow-hidden border border-slate-200 bg-slate-50">
                                                <img src="{{ asset('storage/' . $complaint->image) }}" class="w-full h-auto object-contain max-h-64 mx-auto" alt="Bukti">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Footer --}}
                                <div class="bg-slate-50 px-4 py-4 sm:px-6 flex flex-col sm:flex-row-reverse gap-2 border-t border-slate-100">
                                    <a href="{{ route('complaint.public.finish', $complaint->token) }}" class="inline-flex w-full sm:w-auto justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                        Lihat Selengkapnya
                                    </a>
                                    <button type="button" class="inline-flex w-full sm:w-auto justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-all" @click="activeModal = null">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>