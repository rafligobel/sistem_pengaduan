<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-slate-100 leading-tight tracking-tight">
            Detail Pengaduan
        </h2>
        <span class="text-sm text-slate-500 dark:text-slate-400">
            {{ $complaint->title }}
        </span>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4">

            {{-- Card Utama (Info Pengaduan) --}}
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                    <div class="p-5 text-slate-900 dark:text-slate-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-black">{{ $complaint->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Token:</span>
                                    <code class="font-mono text-xs bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-700 dark:text-slate-300">{{ $complaint->token }}</code>
                                </div>
                            </div>
                            @if ($complaint->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                    Menunggu
                                </span>
                            @elseif($complaint->status == 'proses')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    Diproses
                                </span>
                            @elseif($complaint->status == 'selesai')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    Ditolak
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs mb-4 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Pelapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->user->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Email</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->user->email }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Kategori</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium badge bg-slate-50 inline-block px-2 py-0.5 rounded">{{ $complaint->category->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400 mb-0.5">Tanggal Lapor</dt>
                                <dd class="text-slate-900 dark:text-slate-200 font-medium">{{ $complaint->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 dark:border-slate-700 pt-4">
                            <h4 class="font-bold text-slate-900 dark:text-black mb-2 text-base">Isi Pengaduan</h4>
                            <div class="prose prose-slate dark:prose-invert max-w-none bg-slate-50 dark:bg-slate-900/50 p-3 rounded-lg border border-slate-200 dark:border-slate-700">
                                <p class="whitespace-pre-line text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $complaint->content }}</p>
                            </div>
                        </div>

                        @if ($complaint->attachment)
                            <div class="mt-4 flex items-center p-3 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-lg">
                                <svg class="w-5 h-5 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <span class="text-sm text-slate-700 dark:text-slate-300 font-medium mr-auto">Lampiran Bukti</span>
                                <a href="{{ route('attachments.show', $complaint) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-md font-semibold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Lihat File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar (Form Tanggapan & Riwayat) --}}
            <div class="space-y-4">
                {{-- Card Form Tanggapan --}}
                {{-- Card Form Tanggapan / Verifikasi --}}
                
                {{-- 1. FORM UNTUK PETUGAS (VERIFIKASI) --}}
                @can('verify_complaints')
                    @if($complaint->status == 'pending')
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg mb-4">
                        <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}">
                            @csrf
                            @method('PUT')
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-black border-b border-slate-100 dark:border-slate-700 pb-2 mb-3">
                                    Verifikasi Laporan
                                </h3>
                                <p class="text-xs text-slate-500 mb-3">Sebagai Petugas, silakan validasi laporan ini.</p>
                                
                                <div class="mb-3">
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Tindakan</label>
                                    <select name="status" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option value="proses">Terima & Diproses</option>
                                        <option value="ditolak">Tolak (Data Tidak Valid)</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Verifikasi
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                @endcan

                {{-- 2. FORM UNTUK ADMIN (RESOLVE / TANGGAPI) --}}
                {{-- 2. FORM UNTUK ADMIN (RESOLVE / TANGGAPI) --}}
                @can('resolve_complaints')
                    @if($complaint->status != 'pending')
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm sm:rounded-lg">
                        <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}">
                            @csrf
                            <div class="p-5">
                                <h3 class="text-base font-bold text-slate-900 dark:text-black border-b border-slate-100 dark:border-slate-700 pb-2 mb-3">
                                    Tindak Lanjuti & Tanggapi
                                </h3>
                                
                                @if (session('success'))
                                    <div class="mb-3 bg-green-50 text-green-700 p-2 rounded-md text-xs border border-green-200">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="mb-3 bg-red-50 text-red-700 p-2 rounded-md text-xs border border-red-200">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="content" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Isi Tanggapan</label>
                                    <textarea id="content" name="content"
                                        class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        rows="4" placeholder="Tulis tanggapan penyelesaian disini..." required>{{ old('content') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Update Status</label>
                                    <select name="status" id="status" class="block w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        {{-- Admin bisa memindahkan status kemana saja, tapi defaultnya ke Selesai --}}
                                        {{-- Opsi pending dihapus agar Admin tidak mengembalikan ke petugas --}}
                                        <option value="proses" @selected($complaint->status == 'proses')>Diproses (Sedang Ditangani)</option>
                                        <option value="selesai" @selected($complaint->status == 'selesai')>Selesai (Tutup Laporan)</option>
                                        <option value="ditolak" @selected($complaint->status == 'ditolak')>Ditolak</option>
                                    </select>
                                </div>

                                <div class="flex items-center justify-end pt-1">
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Kirim Tanggapan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-center">
                        <p class="text-sm text-amber-800 font-bold">Laporan belum diverifikasi.</p>
                        <p class="text-xs text-amber-700 mt-1">Harap tunggu Petugas melakukan verifikasi sebelum Anda dapat menindaklanjuti.</p>
                    </div>
                    @endif
                @endcan

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
