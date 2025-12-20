<x-public-layout>
    <div class="relative bg-white overflow-hidden">
        {{-- Hero Background --}}
        <div class="absolute inset-0">
             <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-black opacity-95"></div>
              {{-- Pattern --}}
             <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
        </div>

        <div class="relative max-w-5xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl mb-4">
                Lacak Status Laporan
            </h1>
            <p class="mt-2 max-w-xl mx-auto text-base text-slate-300">
                Pantau progres tindak lanjut pengaduan Anda secara real-time.
            </p>

            {{-- Search Form --}}
            <div class="mt-8 max-w-lg mx-auto">
                <form action="{{ route('status.check') }}" method="POST" class="sm:flex gap-2">
                    @csrf
                    <div class="min-w-0 flex-1 relative">
                        <label for="token" class="sr-only">Nomor Tiket (ID)</label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <input id="token" name="token" type="text" required
                            class="block w-full pl-10 pr-3 py-3 border border-transparent rounded-lg leading-5 bg-white/10 text-white placeholder-slate-400 focus:outline-none focus:bg-white focus:text-slate-900 focus:placeholder-slate-500 focus:ring-2 focus:ring-blue-500 sm:text-sm transition-colors duration-200"
                            placeholder="Masukkan ID Tiket (Contoh: TIKET-2023...)">
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <button type="submit"
                            class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-sm font-bold rounded-lg text-blue-900 bg-blue-400 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-colors shadow-lg shadow-blue-900/50">
                            Lacak
                        </button>
                    </div>
                </form>
                 <p class="mt-3 text-xs text-slate-400">
                    *ID Tiket diberikan saat Anda berhasil mengirim laporan.
                </p>
                @if(session('error'))
                    <div class="mt-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-200 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Riwayat Pengaduan (Login Only) --}}
    @auth
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800">Riwayat Pengaduan Saya</h2>
                <a href="{{ route('complaint.public.step1.create') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500 hover:underline">
                    + Buat Laporan Baru
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">ID Tiket</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class=" relative px-6 py-3"><span class="sr-only">Detail</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($complaints as $complaint)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-mono font-medium text-slate-600">
                                        {{ $complaint->token }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-900 line-clamp-1">{{ $complaint->title }}</div>
                                        <div class="text-xs text-slate-500">{{ $complaint->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                        {{ $complaint->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                         @if ($complaint->status == 'pending')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-amber-700 bg-amber-100 rounded-full">Pending</span>
                                        @elseif($complaint->status == 'proses')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-blue-700 bg-blue-100 rounded-full">Proses</span>
                                        @elseif($complaint->status == 'selesai')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-emerald-700 bg-emerald-100 rounded-full">Selesai</span>
                                        @elseif($complaint->status == 'ditolak')
                                            <span class="inline-flex px-2 text-[10px] font-semibold leading-5 text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                        <a href="{{ route('status.show', $complaint->token) }}" class="text-blue-600 hover:text-blue-900 border border-blue-200 bg-blue-50 hover:bg-white hover:border-blue-300 px-3 py-1.5 rounded-md transition-all">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                             <svg class="h-10 w-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <span class="text-sm font-medium">Belum ada riwayat pengaduan.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     @if($complaints instanceof \Illuminate\Pagination\LengthAwarePaginator && $complaints->hasPages())
                        <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
                            {{ $complaints->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endauth
</x-public-layout>
