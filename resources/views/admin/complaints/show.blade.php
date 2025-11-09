<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengaduan: ') }} {{ $complaint->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Data Laporan</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Judul Laporan</span>
                                <p class="text-base text-gray-900">{{ $complaint->title }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Isi Laporan</span>
                                <p class="text-base text-gray-900 whitespace-pre-wrap">{{ $complaint->description }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Lampiran</span>
                                @if ($complaint->attachment)
                                    <p class="mt-1">
                                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank"
                                            class="text-indigo-600 hover:underline">
                                            Lihat Lampiran
                                        </a>
                                    </p>
                                @else
                                    <p class="text-base text-gray-500">Tidak ada lampiran.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Riwayat Tanggapan</h3>
                        </div>
                        <div class="p-6">
                            @forelse ($complaint->responses as $response)
                                <div class="mb-4 pb-4 border-b">
                                    <p class="font-semibold">{{ $response->user->name }} <span
                                            class="text-sm text-gray-500">({{ $response->user->roles->first()->name ?? 'Petugas' }})</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mb-2">
                                        {{ $response->created_at->format('d F Y, H:i') }}</p>
                                    <p class="text-gray-700">{{ $response->body }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500">Belum ada tanggapan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Beri Tanggapan</h3>
                        </div>
                        <form action="{{ route('admin.complaints.respond', $complaint) }}" method="POST"
                            class="p-6">
                            @csrf

                            @if (session('success'))
                                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="space-y-4">
                                <div>
                                    <label for="body"
                                        class="block text-sm font-medium text-gray-700">Tanggapan</label>
                                    <textarea id="body" name="body" rows="5"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required></textarea>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Ubah
                                        Status</label>
                                    <select id="status" name="status"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="pending"
                                            {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processed"
                                            {{ $complaint->status == 'processed' ? 'selected' : '' }}>Diproses</option>
                                        <option value="finished"
                                            {{ $complaint->status == 'finished' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <x-primary-button>
                                        Kirim Tanggapan
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Data Pelapor</h3>
                        </div>
                        <div class="p-6 space-y-2">
                            <p class="text-sm text-gray-700"><strong>Nama:</strong> {{ $complaint->name }}</p>
                            <p class="text-sm text-gray-700"><strong>NIK:</strong> {{ $complaint->nik }}</p>
                            <p class="text-sm text-gray-700"><strong>Email:</strong> {{ $complaint->email }}</p>
                            <p class="text-sm text-gray-700"><strong>Telepon:</strong> {{ $complaint->phone }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
