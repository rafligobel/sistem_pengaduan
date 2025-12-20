<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Daftar Pengaduan Masuk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-slate-200">
                <div class="p-4 text-slate-900">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">Pelapor</th>
                                    <th scope="col" class="px-4 py-3">Judul</th>
                                    <th scope="col" class="px-4 py-3">Kategori</th>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $key => $item)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition duration-150">
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $complaints->firstItem() + $key }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $item->user->name ?? 'Anonim' }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ Str::limit($item->title, 25) }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="bg-slate-100 text-slate-700 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                                {{ $item->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if ($item->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    Pending
                                                </span>
                                            @elseif($item->status == 'proses')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Proses
                                                </span>
                                            @elseif($item->status == 'selesai')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.complaints.show', $item->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-transparent rounded-md font-bold text-xs transition-colors">
                                                    Detail
                                                </a>
                                                
                                                @can('delete_complaints')
                                                <form action="{{ route('admin.complaints.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 border border-transparent rounded-md font-bold text-xs transition-colors">
                                                        Hapus
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
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
