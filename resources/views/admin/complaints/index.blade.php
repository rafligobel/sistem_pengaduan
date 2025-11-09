<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header dibuat konsisten dengan 'show.blade.php' --}}
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight tracking-tight">
            Daftar Pengaduan Masuk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Utama disempurnakan (shadow-lg dan border) --}}
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Judul Pengaduan</th>
                                    <th scope="col" class="px-6 py-3">Pelapor</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop dimulai --}}
                                @forelse ($complaints as $complaint)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $complaint->created_at->format('d-m-Y') }}
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $complaint->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $complaint->nama_pelapor }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $complaint->category->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Styling status badge agar lebih jelas --}}
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
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Link Aksi diubah menjadi tombol kecil --}}
                                            <a href="{{ route('admin.complaints.show', $complaint) }}"
                                                class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            Tidak ada data pengaduan.
                                        </td>
                                    </tr>
                                    {{-- PENYEMPURNAAN DI SINI: Ganti @endAmdforelse menjadi @endforelse --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (sudah bagus, tidak perlu diubah) --}}
                    <div class="mt-4">
                        {{ $complaints->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
