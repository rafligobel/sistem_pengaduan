<x-guest-layout>
    <div class="w-full max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white">Detail Status Pengaduan</h2>
        <p class_="text-center text-lg text-gray-600 dark:text-gray-300">Token: <code
                class="font-mono font-bold">{{ $complaint->token }}</code></p>

        <div class="mt-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <div class="flex justify-between items-baseline">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $complaint->title }}</h3>
                    <span
                        class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                        {{ $complaint->status }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Kategori: <strong>{{ $complaint->category->name }}</strong>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Dilaporkan oleh: <strong>{{ $complaint->nama_pelapor }}</strong> pada
                    {{ $complaint->created_at->format('d F Y, H:i') }}
                </p>

                <div class="mt-4 text-gray-700 dark:text-gray-300 prose dark:prose-invert max-w-none">
                    <p>{{ $complaint->content }}</p>
                </div>

                @if ($complaint->attachment)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Lihat Lampiran
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Tanggapan Instansi</h3>

            @forelse ($complaint->responses as $response)
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-baseline">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">
                                Ditanggapi oleh: {{ $response->user->name }} (Petugas)
                            </h4>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $response->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="mt-3 text-gray-700 dark:text-gray-300 prose dark:prose-invert max-w-none">
                            <p>{{ $response->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        <p>Belum ada tanggapan dari instansi.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('status.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                &laquo; Cek token lain
            </a>
        </div>
    </div>
</x-guest-layout>
