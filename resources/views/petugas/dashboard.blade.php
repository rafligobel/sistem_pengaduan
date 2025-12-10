<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Inspektur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Selamat bertugas, <strong>{{ Auth::user()->name }}</strong>!
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-yellow-100 p-6 rounded-lg shadow">
                    <div class="font-bold text-yellow-800">Menunggu Verifikasi</div>
                    <div class="text-3xl font-bold">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <div class="font-bold text-blue-800">Sedang Diproses</div>
                    <div class="text-3xl font-bold">{{ $stats['process'] }}</div>
                </div>
                <div class="bg-green-100 p-6 rounded-lg shadow">
                    <div class="font-bold text-green-800">Selesai</div>
                    <div class="text-3xl font-bold">{{ $stats['finished'] }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <a href="{{ route('admin.complaints.index') }}"
                    class="flex items-center justify-between p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition cursor-pointer">
                    <div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">💬 Tanggapi Pengaduan Masuk
                        </h5>
                        <p class="font-normal text-gray-700">Klik di sini untuk melihat daftar laporan dan memberikan
                            tanggapan/tindak lanjut.</p>
                    </div>
                    <span class="text-4xl">👉</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
