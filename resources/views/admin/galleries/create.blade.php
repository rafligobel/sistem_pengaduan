<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Dokumentasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 bg-white border-b border-slate-200">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Judul --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Judul Dokumentasi</label>
                            <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-bold text-slate-700 mb-1">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3" class="w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Upload Foto</label>
                            <input type="file" name="image" id="image" class="w-full text-sm text-slate-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100" accept="image/*" required>
                            <p class="text-xs text-slate-500 mt-1">PNG, JPG, JPEG hingga 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-4">
                            <a href="{{ route('admin.galleries.index') }}" class="text-slate-600 font-medium hover:text-slate-800">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm">
                                Simpan Dokumentasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
