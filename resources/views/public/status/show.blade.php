@extends('layouts.public')

@section('title', 'Detail Status Pengaduan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Detail Pengaduan (Token: {{ $complaint->token }})</h2>

        <div class="bg-white p-8 rounded-lg shadow-xl mb-8">
            <h3 class="text-xl font-semibold mb-6 border-b pb-3">Data Laporan Anda</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Judul Laporan</span>
                    <p class="text-lg text-gray-900">{{ $complaint->title }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Kategori</span>
                    <p class="text-lg text-gray-900">{{ $complaint->category->name }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tanggal Lapor</span>
                    <p class="text-lg text-gray-900">{{ $complaint->created_at->format('d F Y H:i') }}</T_>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Status</span>
                    <p
                        class="text-lg font-bold 
                    @switch($complaint->status)
                        @case('pending') text-yellow-600 @break
                        @case('processed') text-blue-600 @break
                        @case('finished') text-green-600 @break
                        @default text-gray-600
                    @endswitch">
                        {{ ucfirst($complaint->status) }}
                    </p>
                </div>
                <div class="md:col-span-2">
                    <span class="text-sm font-medium text-gray-500">Isi Laporan</span>
                    <p class="text-base text-gray-800 whitespace-pre-wrap mt-1">{{ $complaint->description }}</p>
                </div>
                @if ($complaint->attachment)
                    <div class="md:col-span-2">
                        <span class="text-sm font-medium text-gray-500">Lampiran</span>
                        <p class="mt-1">
                            <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                                class="text-indigo-600 hover:underline">
                                Lihat Lampiran
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-xl">
            <h3 class="text-xl font-semibold mb-6 border-b pb-3">Tanggapan Instansi</h3>

            @if ($complaint->responses->isEmpty())
                <div class="text-center text-gray-500 py-6">
                    <p>Belum ada tanggapan dari instansi.</p>
                </div>
            @else
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach ($complaint->responses as $response)
                            <li>
                                <div class="relative pb-8">
                                    @if (!$loop->last)
                                        <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200"
                                            aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex items-start space-x-3">
                                        <div class="relative">
                                            <span
                                                class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 py-1.5">
                                            <div class="text-sm text-gray-500">
                                                <span class="font-medium text-gray-900">{{ $response->user->name }}</span>
                                                <span
                                                    class="ml-2">({{ $response->user->roles->first()->name ?? 'Petugas' }})</span>
                                                <span
                                                    class="whitespace-nowrap float-right">{{ $response->created_at->format('d F Y, H:i') }}</span>
                                            </div>
                                            <div class="mt-2 text-base text-gray-700">
                                                <p>{{ $response->body }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
