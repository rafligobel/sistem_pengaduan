<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black-900 dark:text-black-100 leading-tight tracking-tight">
                Manajemen User
            </h2>
            {{-- Tombol Tambah User Baru --}}
            <a href="{{ route('admin.users.create') }}">
                <x-primary-button>
                    <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah User
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-black-100">

                    {{-- Pesan Sukses/Error --}}
                    @if (session('success'))
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-sm font-medium text-red-600 dark:text-red-400">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-black-500 dark:text-black-400">
                            <thead
                                class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-black-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-black-900 whitespace-nowrap dark:text-white">
                                            {{ $user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Menampilkan role sebagai badge --}}
                                            @foreach ($user->getRoleNames() as $role)
                                                <span
                                                    class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                                    {{ $role }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 flex gap-2">
                                            {{-- Tombol Aksi Edit (Konsisten) --}}
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Edit
                                            </a>
                                            {{-- Tombol Aksi Hapus (Konsisten) --}}
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Hapus</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="4" class="px-6 py-4 text-center">
                                            Tidak ada data user.
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
