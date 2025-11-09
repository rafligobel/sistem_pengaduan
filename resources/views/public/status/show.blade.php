{{-- Menggunakan layout publik yang lebar, bukan guest-layout --}}
<x-public-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight tracking-tight">
            Status Pengaduan Anda
        </h2>
        <span class="text-sm text-gray-500 dark:text-gray-400">
            Token: <code class="font-mono">{{ $complaint->token }}</code>
        </span>
    </x-slot>

    <div class="py-12">
        {{-- Styling ini sengaja dibuat mirip dengan admin/show.blade.php untuk konsistensi --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Card Utama (Info Pengaduan) --}}
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold">{{ $complaint->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Kategori: {{ $complaint->category->name }}
                                </p>
                            </div>
                            {{-- Status Badge (Konsisten) --}}
                            <span @class([
                                'text-xs font-medium px-2.5 py-0.5 rounded-full',
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' =>
                                    $complaint->status == 'pending',
                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' =>
                                    $complaint->status == 'processed',
                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' =>
                                    $complaint->status == 'finished',
                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' =>
                                    $complaint->status == 'rejected',
                            ])>
                                {{ $complaint->status }}
                            </span>
                        </div>

                        <div class="border-t dark:border-gray-700 pt-4 mt-4">
                            <dt class="font-medium text-gray-500 dark:text-gray-400 mb-2">Isi Pengaduan Anda</dt>
                            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                <p>{!! nl2br(e($complaint->content)) !!}</p>
                            </div>
                        </div>

                        @if ($complaint->attachment)
                            <div class="border-t dark:border-gray-700 pt-4 mt-4">
                                <dt class="font-medium text-gray-500 dark:text-gray-400 mb-2">Lampiran Anda</dt>
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Lihat Lampiran
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar (Riwayat Tanggapan) --}}
            <div class="space-y-6">
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Riwayat Tanggapan Petugas
                        </h3>

                        <div class="mt-4 space-y-4">
                            @forelse ($complaint->responses as $response)
                                <div class="p-4 border dark:border-gray-700 rounded-lg">
                                    <div class="flex justify-between items-baseline">
                                        <p class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $response->user->name }} (Petugas)
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $response->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-300 prose dark:prose-invert max-w-none">
                                        <p>{!! nl2br(e($response->content)) !!}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada tanggapan dari petugas.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-public-layout>
