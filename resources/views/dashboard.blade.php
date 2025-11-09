<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight tracking-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menerapkan style card premium yang konsisten --}}
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p classs="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Anda login sebagai
                        <span class="font-medium text-indigo-600 dark:text-indigo-400">
                            {{-- Mengambil role pertama user --}}
                            {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                        </span>.
                    </p>
                    <p class="mt-4">
                        Anda dapat mengelola pengaduan masuk melalui menu "Pengaduan" di navigasi atas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
