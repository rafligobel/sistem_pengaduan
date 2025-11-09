@extends('layouts.public')

@section('title', 'Lapor: Step 2 - Data Pengaduan')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Langkah 2: Data Pengaduan</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <strong class="font-bold">Oops!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('complaint.public.step2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Pengaduan</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori Pengaduan</label>
                    <select name="category_id" id="category_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Isi Pengaduan</label>
                    <textarea name="description" id="description" rows="5" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700">Lampiran (Opsional)</label>
                    <input type="file" name="attachment" id="attachment"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-500 mt-1">Maks: 2MB. Format: JPG, PNG, PDF.</p>
                </div>
            </div>
            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('complaint.public.step1.create') }}" class="text-sm text-gray-600 hover:text-indigo-600">
                    &laquo; Kembali ke Biodata
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
@endsection
