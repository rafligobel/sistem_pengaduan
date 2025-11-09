@extends('layouts.public')

@section('title', 'Cek Status Pengaduan')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Cek Status Pengaduan Anda</h2>
        <p class="text-center text-gray-600 mb-6">
            Masukkan token unik yang Anda dapatkan saat melakukan pengaduan.
        </p>

        <form action="{{ route('status.check') }}" method="POST" class="flex flex-col sm:flex-row gap-2">
            @csrf
            <label for="token" class="sr-only">Token Pengaduan</label>
            <input type="text" name="token" id="token" required placeholder="Masukkan token..."
                class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg text-center"
                style="text-transform: uppercase;">

            <button type="submit"
                class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Cek Status
            </button>
        </form>

        @if ($errors->any())
            <p class="text-red-500 text-sm mt-2 text-center">{{ $errors->first() }}</p>
        @endif
    </div>
@endsection
