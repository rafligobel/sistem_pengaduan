<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto w-full">
            {{-- Header Compact --}}
            <div class="text-center mb-1">
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
                    Konfirmasi Data
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                    Pastikan detail laporan Anda sudah benar.
                </p>
            </div>

            {{-- Card Summary --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                 <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                <div class="p-5">
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Laporan</label>
                        <h3 class="text-sm font-bold text-slate-900 leading-snug">{{ $data['title'] }}</h3>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Permasalahan</label>
                         <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $category->name ?? 'Kategori Tidak Ditemukan' }}
                        </span>
                    </div>

                    {{-- Isi --}}
                    <div class="mb-4">
                         <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Detail Laporan</label>
                        <div class="bg-slate-50 rounded-lg p-3 text-xs text-slate-700 border border-slate-100 leading-relaxed">
                            {!! nl2br(e($data['content'])) !!}
                        </div>
                    </div>

                    {{-- Gambar --}}
                    @if (isset($data['image_path']))
                        <div class="mb-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bukti Lampiran</label>
                            <div class="relative rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $data['image_path']) }}" alt="Preview" class="w-full h-32 object-cover object-center">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-2">
                                     <span class="text-white text-[10px] font-medium opacity-90">Lampiran tersedia</span>
                                </div>
                            </div>
                        </div>
                    @else
                         <div class="mb-2">
                             <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bukti Lampiran</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-2 text-center">
                                <span class="text-[10px] text-slate-400 italic">Tidak ada lampiran</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('complaint.public.step2.store') }}" method="POST" class="pt-1">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-1 border-t border-slate-100 mt-1   ">
                            <a href="{{ route('complaint.public.step1.create') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Perbaiki Data
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-emerald-600 hover:bg-emerald-700 hover:shadow-emerald-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                                Kirim Laporan
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Pastikan data Anda sudah benar sebelum mengirim.
            </p>
        </div>
    </div>
</x-public-layout>
