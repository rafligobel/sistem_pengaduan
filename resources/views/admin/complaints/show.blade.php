<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black-900 dark:text-gray-100 leading-tight tracking-tight">
            Detail Pengaduan
        </h2>
        <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ $complaint->title }}
        </span>
    </x-slot>

    <div class="py-12">
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
                                    Token: <code class="font-mono">{{ $complaint->token }}</code>
                                </p>
                            </div>
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

                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-4 border-t dark:border-gray-700 pt-4">
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Pelapor</dt>
                                <dd class="mt-1">{{ $complaint->nama_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1">{{ $complaint->email_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Telepon</dt>
                                <dd class="mt-1">{{ $complaint->telepon_pelapor }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Kategori</dt>
                                <dd class="mt-1">{{ $complaint->category->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Tanggal Lapor</dt>
                                <dd class="mt-1">{{ $complaint->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </div>

                        <div class="border-t dark:border-gray-700 pt-4">
                            <dt class="font-medium text-gray-500 dark:text-gray-400 mb-2">Isi Pengaduan</dt>
                            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                {{-- Menggunakan nl2br() agar baris baru dari textarea tetap tampil --}}
                                <p>{!! nl2br(e($complaint->content)) !!}</p>
                            </div>
                        </div>

                        @if ($complaint->attachment)
                            <div class="border-t dark:border-gray-700 pt-4 mt-4">
                                <dt class="font-medium text-gray-500 dark:text-gray-400 mb-2">Lampiran</dt>
                                <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Lihat Lampiran
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
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:rounded-lg">
                    <form method="POST" action="{{ route('admin.complaints.respond', $complaint) }}">
                        @csrf
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Berikan Tanggapan
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Tanggapan Anda akan terlihat oleh pelapor.
                            </p>

                            @if (session('success'))
                                <div class="mt-4 text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mt-4">
                                <x-input-label for="content" value="Isi Tanggapan" />
                                <textarea id="content" name="content"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="5">{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="status" value="Ubah Status Pengaduan" />
                                <select name="status" id="status"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="pending" @selected($complaint->status == 'pending')>Pending (Menunggu)</option>
                                    <option value="processed" @selected($complaint->status == 'processed')>Processed (Diproses)</option>
                                    <option value="finished" @selected($complaint->status == 'finished')>Finished (Selesai)</option>
                                    <option value="rejected" @selected($complaint->status == 'rejected')>Rejected (Ditolak)</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    Kirim Tanggapan
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Card Riwayat Tanggapan --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Riwayat Tanggapan
                        </h3>

                        <div class="mt-4 space-y-4">
                            @forelse ($complaint->responses as $response)
                                <div class="p-4 border dark:border-gray-700 rounded-lg">
                                    <div class="flex justify-between items-baseline">
                                        <p class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $response->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $response->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-300 prose dark:prose-invert max-w-none">
                                        {{-- Menggunakan nl2br() agar baris baru tetap tampil --}}
                                        <p>{!! nl2br(e($response->content)) !!}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada tanggapan untuk pengaduan ini.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
