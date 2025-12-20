<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Sistem & Konfigurasi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card 1: Informasi Arsitektur --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-300">
                <div class="p-6 bg-white border-b border-slate-300">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Arsitektur & Environment</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($systemInfo as $key => $value)
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-300">
                                <dt class="text-xs font-bold text-slate-500 uppercase">{{ str_replace('_', ' ', $key) }}</dt>
                                <dd class="text-sm font-mono text-slate-900 mt-1">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Card 2: Maintenance & Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Optimize --}}
                <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-300">
                    <h3 class="font-bold text-slate-900 mb-2">Maintenance</h3>
                    <p class="text-sm text-slate-600 mb-4">Bersihkan cache aplikasi dan konfigurasi untuk menyegarkan sistem.</p>
                    <form action="{{ route('admin.system.optimize') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Optimasi Sistem (Clear Cache)
                        </button>
                    </form>
                </div>

                {{-- Backup --}}
                <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-300">
                    <h3 class="font-bold text-slate-900 mb-2">Backup & Restore</h3>
                    <p class="text-sm text-slate-600 mb-4">Cadangkan database dan file aplikasi Anda secara manual.</p>
                    <form action="{{ route('admin.system.backup') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Jalankan Backup Sekarang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card 3: Logs (Testing & QA) --}}
            <div class="bg-slate-50 text-slate-600 overflow-hidden shadow-sm sm:rounded-lg font-mono border border-slate-300">
                <div class="p-4 border-b border-slate-300 flex justify-between items-center bg-slate-100">
                    <h3 class="font-bold text-slate-800">System Logs (Last 20 lines)</h3>
                    <span class="text-xs text-slate-500">storage/logs/laravel.log</span>
                </div>
                <div class="p-4 overflow-x-auto text-xs whitespace-pre-wrap">
                    @forelse($logs as $log)
                        <div class="mb-1 border-b border-slate-200 pb-1">{{ $log }}</div>
                    @empty
                        <span class="text-slate-500">Log file kosong atau tidak terbaca.</span>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
