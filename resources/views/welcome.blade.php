@extends('layouts.public')

@section('title', 'Selamat Datang - Sistem Pengaduan')

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-8 sm:p-12 text-center">

            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Sistem Informasi Pengaduan
            </h1>
            <p class="text-lg text-gray-600 mb-10">
                Sampaikan laporan Anda langsung kepada kami.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">

                <a href="{{ route('complaint.public.step1.create') }}"
                    class="inline-block px-8 py-4 bg-indigo-600 text-white font-medium text-lg rounded-md shadow-md hover:bg-indigo-700 transition duration-300">
                    Lakukan Pengaduan
                </a>

                <a href="{{ route('status.index') }}"
                    class="inline-block px-8 py-4 bg-gray-200 text-gray-800 font-medium text-lg rounded-md shadow-md hover:bg-gray-300 transition duration-300">
                    Cek Status Pengaduan
                </a>
            </div>

        </div>
    </div>
@endsection
