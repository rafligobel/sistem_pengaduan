<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-12 pt-28 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto">
            {{-- Header Modern Compact --}}
            <div class="text-center mb-8">
                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wide uppercase mb-3">
                    Langkah 1 dari 2
                </span>
                <h2 class="text-2xl font-bold text-slate-900">
                    Buat Laporan Baru
                </h2>
                <p class="mt-2 text-sm text-slate-600">
                    Sampaikan laporan Anda dengan jelas dan lengkap.
                </p>
            </div>

            {{-- Card Form Minimalis --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('complaint.public.step1.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-1">
                                Judul Laporan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-slate-700"
                                placeholder="Contoh: Jalan rusak di..." required value="{{ old('title') }}">
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id" required
                                class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-slate-700">
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-slate-700 mb-1">
                                Isi Laporan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="4"
                                class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm placeholder-slate-400"
                                placeholder="Jelaskan detail kejadian secara singkat dan jelas..." required>{{ old('content') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Bukti Foto (Opsional)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="image"
                                    class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition duration-300">
                                    <div class="flex flex-col items-center justify-center pt-3 pb-4">
                                        <svg class="w-6 h-6 text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-xs text-slate-500">
                                            <span class="font-semibold text-blue-600">Upload foto</span> atau drag & drop
                                        </p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-between border-t border-slate-100 mt-6">
                            <a href="{{ route('landing') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
                                &larr; Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                Lanjut
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dilindungi Enkripsi SSL.
            </p>
        </div>
    </div>
</x-app-layout>
