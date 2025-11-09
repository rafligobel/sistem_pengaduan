@extends('layouts.public')

@section('title', 'Lapor: Step 1 - Biodata')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Langkah 1: Biodata Pelapor</h2>

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

        <form action="{{ route('complaint.public.step1.post') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $biodata['name'] ?? '') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK (Nomor Induk
                        Kependudukan)</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $biodata['nik'] ?? '') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $biodata['email'] ?? '') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon (WhatsApp)</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $biodata['phone'] ?? '') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            <div class="mt-8 text-right">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Selanjutnya
                </button>
            </div>
        </form>
    </div>
@endsection
