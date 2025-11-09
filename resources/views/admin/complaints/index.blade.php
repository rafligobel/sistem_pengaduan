<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Pengaduan Masuk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                                            {{ $complaint->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.complaints.show', $complaint) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                Lihat/Tanggapi
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            Tidak ada data pengaduan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $complaints->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
