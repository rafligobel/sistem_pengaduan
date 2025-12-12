<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black-900 dark:text-black-100 leading-tight tracking-tight">
            Detail Pengaduan
        </h2>
        <span class="text-sm text-black-500 dark:text-black-400">
            {{ $complaint->title }}
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Card Utama (Info Pengaduan) --}}
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-slate-900 dark:text-slate-100">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $complaint->title }}</h3>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-sm text-slate-500 dark:text-slate-400">Token:</span>
                                    <code class="font-mono text-sm bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-700 dark:text-slate-300">{{ $complaint->token }}</code>
                                </div>
                            </div>
                            @if ($complaint->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                    Pending
                                </span>
                            @elseif($complaint->status == 'proses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    Proses
                                </span>
                            @elseif($complaint->status == 'selesai')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                    Ditolak
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm mb-6 border-t border-slate-100 dark:border-slate-700 pt-6">
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-1">Pelapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->nama_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-1">Email</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->email_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-1">Telepon</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->telepon_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-1">Kategori</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium badge bg-slate-50 inline-block px-2 py-0.5 rounded">{{ $complaint->category->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-1">Tanggal Lapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 dark:border-slate-700 pt-6">
                            <h4 class="font-bold text-slate-900 dark:text-white mb-3 text-lg">Isi Pengaduan</h4>
                            <div class="prose prose-slate dark:prose-invert max-w-none bg-slate-50 dark:bg-slate-900/50 p-4 rounded-xl border border-slate-200 dark:border-slate-700">
                                <p class="whitespace-pre-line text-slate-700 dark:text-slate-300 leading-relaxed">{{ $complaint->content }}</p>
                            </div>
                        </div>

                        @if ($complaint->attachment)
                            <div class="mt-6 flex items-center p-4 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-lg">
                                <svg class="w-6 h-6 text-slate-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <span class="text-slate-700 dark:text-slate-300 font-medium mr-auto">Lampiran Bukti</span>
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-md font-semibold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Lihat File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar (Form Tanggapan & Riwayat) --}}
            <div class="space-y-6">
                {{-- Card Form Tanggapan --}}
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}">
                        @csrf
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 mb-4">
                                Berikan Tanggapan
                            </h3>
                            
                            @if (session('success'))
                                <div class="mb-4 bg-green-50 text-green-700 p-3 rounded-md text-sm border border-green-200">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Isi Tanggapan</label>
                                <textarea id="content" name="content"
                                    class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    rows="5" placeholder="Tulis tanggapan untuk pelapor disini...">{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Update Status</label>
                                <select name="status" id="status"
                                    class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="pending" @selected($complaint->status == 'pending')>Pending (Menunggu)</option>
                                    <option value="processed" @selected($complaint->status == 'processed')>Proses (Sedang Ditangani)</option>
                                    <option value="finished" @selected($complaint->status == 'finished')>Selesai (Ditutup)</option>
                                    <option value="rejected" @selected($complaint->status == 'rejected')>Ditolak (Tidak Valid)</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end pt-2">
                                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 w-full justify-center">
                                    Kirim & Update
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Card Riwayat Tanggapan --}}
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 mb-4">
                            Riwayat Tanggapan
                        </h3>

                        <div class="space-y-4">
                            @forelse ($complaint->responses as $response)
                                <div class="p-4 bg-slate-50 dark:bg-slate-700/30 rounded-lg border border-slate-100 dark:border-slate-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mr-2">
                                                {{ substr($response->user->name, 0, 1) }}
                                            </div>
                                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">
                                                {{ $response->user->name }}
                                            </p>
                                        </div>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $response->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-slate-600 dark:text-slate-300">
                                        {!! nl2br(e($response->content)) !!}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-slate-400 dark:text-slate-500 text-sm italic">
                                        Belum ada tanggapan..
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
