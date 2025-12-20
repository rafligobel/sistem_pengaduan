<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                Manajemen User
            </h2>
            {{-- Tombol Tambah User Baru --}}
            <a href="{{ route('admin.users.create') }}">
                <x-primary-button class="px-3 py-1.5 text-xs">
                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Pengguna
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div
                class="bg-white border border-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-slate-900">

                    {{-- Pesan Sukses/Error --}}
                    @if (session('success'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-sm font-medium text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            <thead
                                class="text-xs text-slate-700 uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">No</th>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">Nama</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr
                                        class="bg-white border-b border-slate-300 hover:bg-slate-50 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Menampilkan role sebagai badge --}}
                                            @foreach ($user->getRoleNames() as $role)
                                                <span
                                                    class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                    {{ $role }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                                            {{-- Tombol Aksi Edit --}}
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md font-bold text-xs transition-colors">
                                                Edit
                                            </a>
                                            {{-- Tombol Aksi Hapus --}}
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 mb-2 text-slate-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <span>Tidak ada data user.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
