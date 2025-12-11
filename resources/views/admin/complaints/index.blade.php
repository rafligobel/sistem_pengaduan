<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 leading-tight">
            {{ __('Daftar Pengaduan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Pelapor</th>
                                    <th class="px-4 py-2 text-left">Judul</th>
                                    <th class="px-4 py-2 text-left">Kategori</th>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $key => $item)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $complaints->firstItem() + $key }}</td>
                                        <td class="px-4 py-2">{{ $item->user->name ?? 'Anonim' }}</td>
                                        <td class="px-4 py-2">{{ Str::limit($item->title, 30) }}</td>
                                        <td class="px-4 py-2">
                                            <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">
                                                {{ $item->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-2">
                                            @if ($item->status == 'pending')
                                                <span
                                                    class="text-yellow-600 font-bold bg-yellow-100 px-2 py-1 rounded">Pending</span>
                                            @elseif($item->status == 'proses')
                                                <span
                                                    class="text-blue-600 font-bold bg-blue-100 px-2 py-1 rounded">Proses</span>
                                            @elseif($item->status == 'selesai')
                                                <span
                                                    class="text-green-600 font-bold bg-green-100 px-2 py-1 rounded">Selesai</span>
                                            @else
                                                <span
                                                    class="text-red-600 font-bold bg-red-100 px-2 py-1 rounded">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ route('admin.complaints.show', $item->id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $complaints->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
