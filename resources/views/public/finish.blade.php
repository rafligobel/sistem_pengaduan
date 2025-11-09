@extends('layouts.public')

@section('title', 'Pengaduan Terkirim!')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-8 sm:p-12 rounded-lg shadow-xl text-center">
        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        <h2 class="text-3xl font-bold mb-4 text-gray-800">Pengaduan Berhasil Terkirim!</h2>
        <p class="text-lg text-gray-600 mb-6">
            Terima kasih atas laporan Anda. Mohon simpan kode token berikut untuk mengecek status pengaduan Anda.
        </p>

        <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 mb-8">
            <p class="text-sm uppercase text-gray-500 tracking-wider">Token Pengaduan Anda</p>
            <p class="text-4xl font-mono font-bold text-indigo-600 tracking-widest my-2">
                {{ $token }}
            </p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('status.show', $token) }}"
                class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-md shadow-md hover:bg-indigo-700">
                Lihat Status Sekarang
            </a>
            <a href="{{ route('landing') }}"
                class="inline-block px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-md shadow-md hover:bg-gray-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
