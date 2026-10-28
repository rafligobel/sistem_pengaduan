<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto w-full">
            {{-- Header Compact --}}
            <div class="text-center mb-4">
                 <div class="inline-flex items-center justify-center space-x-1 mb-1">
                    <span class="w-1 h-1 rounded-full bg-blue-600"></span>
                    <span class="text-[10px] font-semibold text-blue-600 uppercase tracking-wide">
                        Langkah 1
                    </span>
                    <span class="w-2 h-1 rounded-full bg-slate-300"></span>
                    <span class="px-2 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold tracking-wide uppercase shadow-sm">
                        Langkah 2
                    </span>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                    Konfirmasi Data Pengaduan
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-md mx-auto">
                    Pastikan seluruh data pengaduan Anda sudah benar sebelum dikirim.
                </p>
            </div>

            {{-- Card Summary --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                 <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                <div class="p-5 space-y-5">

                    {{-- IDENTITAS PELAPOR --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Identitas Pelapor</h4>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-3 border border-slate-100">
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <span class="text-slate-400 font-medium">Nama:</span>
                                    <span class="text-slate-800 font-semibold ml-1">{{ Auth::user()->name }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-medium">Email:</span>
                                    <span class="text-slate-800 font-semibold ml-1">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- UNSUR 5W+1H --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Unsur 5W + 1H</h4>
                        </div>

                        <div class="space-y-3">
                            {{-- What --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-red-100 text-red-600 text-[9px] font-black">W</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Apa yang Terjadi (What)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    {!! nl2br(e($data['what'])) !!}
                                </div>
                            </div>

                            {{-- Who --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-orange-100 text-orange-600 text-[9px] font-black">W</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Siapa yang Terlibat (Who)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    {!! nl2br(e($data['who'])) !!}
                                </div>
                            </div>

                            {{-- Where --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-green-100 text-green-600 text-[9px] font-black">W</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Di mana Terjadi (Where)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    {!! nl2br(e($data['where_location'])) !!}
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-purple-100 text-purple-600 text-[9px] font-black">W</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kapan Terjadi (When)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    {!! nl2br(e($data['when_time'])) !!}
                                </div>
                            </div>

                            {{-- Why --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-teal-100 text-teal-600 text-[9px] font-black">W</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Mengapa Terjadi (Why)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    @if($data['why'])
                                        {!! nl2br(e($data['why'])) !!}
                                    @else
                                        <span class="text-slate-400 italic">Tidak diisi</span>
                                    @endif
                                </div>
                            </div>

                            {{-- How --}}
                            <div class="border border-slate-100 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center justify-center w-4 h-4 rounded bg-blue-100 text-blue-600 text-[9px] font-black">H</span>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Modus Operandi (How)</label>
                                </div>
                                <div class="bg-slate-50 rounded-md p-2 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                                    {!! nl2br(e($data['how'])) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KATEGORI TINDAK PIDANA --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-amber-100 text-amber-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jenis Tindak Pidana Korupsi</h4>
                        </div>
                        <div class="border border-slate-100 rounded-lg p-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                {{ $category->name ?? 'Kategori Tidak Ditemukan' }}
                            </span>
                        </div>
                    </div>

                    {{-- BUKTI PENDUKUNG --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            </div>
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Bukti Pendukung</h4>
                        </div>

                        @if (count($attachmentPreviews) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($attachmentPreviews as $att)
                                    <div class="border border-slate-200 rounded-lg overflow-hidden">
                                        @if($att['preview'])
                                            <img src="{{ $att['preview'] }}" alt="Preview" class="w-full h-28 object-contain object-center bg-slate-50">
                                        @else
                                            <div class="w-full h-28 bg-slate-50 flex items-center justify-center">
                                                <div class="text-center">
                                                    <svg class="mx-auto w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <p class="text-[10px] text-slate-400 mt-1">{{ strtoupper(pathinfo($att['name'], PATHINFO_EXTENSION)) }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="p-2 bg-white border-t border-slate-100">
                                            <p class="text-[10px] text-slate-600 font-medium truncate">{{ $att['name'] }}</p>
                                            <p class="text-[9px] text-slate-400">{{ number_format($att['size'] / 1024, 1) }} KB</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-3 text-center">
                                <span class="text-[10px] text-slate-400 italic">Tidak ada bukti pendukung disertakan</span>
                            </div>
                        @endif
                    </div>

                    {{-- TOMBOL AKSI --}}
                    <form action="{{ route('complaint.public.step2.store') }}" method="POST" class="pt-1">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-3 border-t border-slate-100">
                            <a href="{{ route('complaint.public.step1.create') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Perbaiki Data
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-emerald-600 hover:bg-emerald-700 hover:shadow-emerald-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                                Kirim Pengaduan
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Pastikan data Anda sudah benar sebelum mengirim. Data pengaduan tidak dapat diubah setelah dikirim.
            </p>
        </div>
    </div>
</x-public-layout>
