<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                {{ __('Manajemen Kategori') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 px-3 py-1.5 text-xs">
                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Tambah Kategori') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Perbaikan: Mengganti typo bg-white-800 menjadi bg-white dan border-slate --}}
            <div
                class="bg-white border border-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">

                    {{-- Tabel Responsif --}}
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            {{-- Header Tabel dengan warna Slate lembut --}}
                            <thead
                                class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr
                                        class="bg-white border-b border-slate-300 hover:bg-slate-50 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md font-bold text-xs transition-colors">
                                                Edit
                                            </a>
                                            {{-- Tombol Hapus --}}
                                            <form method="POST"
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-md font-bold text-xs transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b border-slate-300">
                                        <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 mb-2 text-slate-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <span>Tidak ada data kategori.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
