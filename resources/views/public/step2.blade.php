<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-12 pt-28 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto">
            {{-- Header Compact --}}
            <div class="text-center mb-8">
                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wide uppercase mb-3">
                    Langkah 2 / 2
                </span>
                <h2 class="text-2xl font-bold text-slate-900">
                    Konfirmasi Data
                </h2>
                <p class="mt-2 text-sm text-slate-600">
                    Pastikan data laporan Anda sudah benar sebelum dikirim.
                </p>
            </div>

            {{-- Card Summary --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 sm:p-8 space-y-6">
                    
                    {{-- Judul --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Laporan</h3>
                        <p class="text-lg font-bold text-slate-800">{{ $data['title'] }}</p>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                            {{ $category->name }}
                        </span>
                    </div>

                    {{-- Isi Laporan --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Detail Laporan</h3>
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-100">
                            <p class="text-sm text-slate-700 whitespace-pre-line leading-relaxed">{!! nl2br(e($data['content'])) !!}</p>
                        </div>
                    </div>

                    {{-- Bukti Foto --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Bukti Lampiran</h3>
                        @if ($image)
                            <div class="rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $image) }}" alt="Bukti Laporan" class="w-full h-auto object-cover max-h-64">
                            </div>
                        @else
                            <p class="text-sm text-slate-400 italic">Tidak ada foto dilampirkan.</p>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-6 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-slate-100">
                        <a href="{{ route('complaint.public.step1.create') }}" 
                           class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-200 transition-all">
                            &larr; Perbaiki Data
                        </a>

                        <form action="{{ route('complaint.public.step2.store') }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                                Kirim Laporan Sekarang
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
