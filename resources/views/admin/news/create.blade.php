<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tulis Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">
                    
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Judul Berita</label>
                            <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Gambar Utama</label>
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 10MB.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-bold text-slate-700 mb-1">Isi Berita</label>
                            <textarea name="content" id="content" rows="10" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-medium text-sm">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold text-sm">
                                Terbitkan Berita
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
