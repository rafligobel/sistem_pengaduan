<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto w-full">
            {{-- Header Modern Compact --}}
            <div class="text-center mb-1">
                <div class="inline-flex items-center justify-center space-x-1 mb-1">
                    <span class="px-2 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold tracking-wide uppercase shadow-sm">
                        Langkah 1
                    </span>
                    <span class="w-2 h-1 rounded-full bg-slate-300"></span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide">
                        Langkah 2
                    </span>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                    Buat Laporan
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                    Sampaikan laporan Anda dengan jelas. Identitas Anda aman.
                </p>
            </div>

            {{-- Card Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <div class="p-5">
                    <form action="{{ route('complaint.public.step1.store') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                        @csrf
 
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-2">
                            {{-- Judul --}}
                            <div class="sm:col-span-8">
                                <label for="title" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Judul Laporan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title"
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                    placeholder="Contoh: Jalan rusak di..." required value="{{ old('title') }}">
                                @error('title')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori (Compact Side-by-Side) --}}
                            <div class="sm:col-span-4">
                                <label for="category_id" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" id="category_id" required
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 text-sm text-slate-900 transition-colors">
                                    <option value="" disabled selected>Pilih...</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Isi --}}
                            <div class="sm:col-span-12">
                                <label for="content" class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">
                                    Detail Laporan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="content" name="content" rows="3"
                                    class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 placeholder-slate-400 py-2 text-sm leading-relaxed transition-colors"
                                    placeholder="Jelaskan kronologi kejadian..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Upload Image --}}
                            <div class="sm:col-span-12">
                                <label class="block text-[10px] font-bold text-slate-700 mb-1 uppercase tracking-wide">Bukti (Opsional)</label>
                                <div class="relative flex justify-center px-4 py-3 border-2 border-slate-300 border-dashed rounded-lg hover:bg-slate-50 transition-colors group cursor-pointer" id="drop-zone">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-6 w-6 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-xs text-slate-600 justify-center gap-1">
                                            <span class="font-medium text-blue-600 group-hover:text-blue-500">
                                                Upload
                                            </span>
                                            <span class="">atau drag & drop</span>
                                        </div>
                                        <p class="text-[10px] text-slate-500">
                                            Max 5MB (JPG/PNG)
                                        </p>
                                        <div id="file-preview" class="hidden mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800" id="file-name">
                                            </span>
                                        </div>
                                    </div>
                                    {{-- Unified Input --}}
                                    <input id="image" name="image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(this)">
                                </div>
                                @error('image')
                                    <p class="mt-0.5 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-1 border-t border-slate-100 mt-1">
                            <a href="{{ url('/') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 hover:shadow-blue-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                Lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
             <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Dilindungi dengan enkripsi SSL 256-bit.
            </p>
            <div class="w-full h-20 bg-transparent"></div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const previewLink = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
                previewLink.classList.remove('hidden');
            }
        }
    </script>
</x-public-layout>
