<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    {{ __('Daftar Pengaduan Masuk') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Kelola dan pantau seluruh tahapan pengaduan masyarakat.
                </p>
            </div>
            @can('delete_complaints')
            <div>
                <form action="{{ route('admin.complaints.destroyAll') }}" method="POST" onsubmit="return confirm('PERHATIAN: Apakah Anda yakin ingin MENGHAPUS SEMUA data pengaduan? Tindakan ini tidak dapat dibatalkan!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-sm text-xs transition duration-150 ease-in-out">
                        Hapus Semua
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

            {{-- Info Banner Khusus Role --}}
            @role('tim khusus')
                <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg text-xs flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><strong>Tugas Tim Khusus:</strong> Fokus pada laporan berstatus <strong>Diproses</strong> yang telah diteruskan oleh Admin untuk dilakukan verifikasi lapangan atau penolakan.</span>
                </div>
            @endrole

            @role('pimpinan')
                <div class="bg-slate-50 border border-slate-200 text-slate-700 px-4 py-3 rounded-lg text-xs flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span><strong>Mode Pengawasan Pimpinan:</strong> Anda dapat memantau seluruh riwayat dan proses pengaduan secara transparan (Hanya Melihat).</span>
                </div>
            @endrole

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Filter Tabs --}}
            <div class="flex flex-wrap items-center gap-2 pb-2 border-b border-slate-200">
                <a href="{{ route('admin.complaints.index') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition {{ empty($statusFilter) ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                    <span>Semua</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ empty($statusFilter) ? 'bg-slate-700 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $counts['semua'] ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.complaints.index', ['status' => 'menunggu']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $statusFilter === 'menunggu' ? 'bg-amber-600 text-white' : 'bg-white text-amber-800 border border-amber-200 hover:bg-amber-50' }}">
                    <span>⏳ Menunggu</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter === 'menunggu' ? 'bg-amber-800 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $counts['menunggu'] ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.complaints.index', ['status' => 'diproses']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $statusFilter === 'diproses' ? 'bg-blue-600 text-white' : 'bg-white text-blue-800 border border-blue-200 hover:bg-blue-50' }}">
                    <span>⚙️ Diproses</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter === 'diproses' ? 'bg-blue-800 text-white' : 'bg-blue-100 text-blue-800' }}">{{ $counts['diproses'] ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.complaints.index', ['status' => 'terverifikasi']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $statusFilter === 'terverifikasi' ? 'bg-emerald-600 text-white' : 'bg-white text-emerald-800 border border-emerald-200 hover:bg-emerald-50' }}">
                    <span>✅ Terverifikasi</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter === 'terverifikasi' ? 'bg-emerald-800 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $counts['terverifikasi'] ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.complaints.index', ['status' => 'ditolak']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $statusFilter === 'ditolak' ? 'bg-red-600 text-white' : 'bg-white text-red-800 border border-red-200 hover:bg-red-50' }}">
                    <span>❌ Ditolak</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter === 'ditolak' ? 'bg-red-800 text-white' : 'bg-red-100 text-red-800' }}">{{ $counts['ditolak'] ?? 0 }}</span>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-slate-200">
                <div class="p-4 text-slate-900">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-slate-500">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">Tiket</th>
                                    <th scope="col" class="px-4 py-3">Pelapor</th>
                                    <th scope="col" class="px-4 py-3">Ringkasan</th>
                                    <th scope="col" class="px-4 py-3">Kategori</th>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaints as $key => $item)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition duration-150">
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $complaints->firstItem() + $key }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap font-mono font-bold text-blue-600 text-xs">#{{ $item->token }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-slate-900 font-medium">{{ $item->user->name ?? 'Anonim' }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ Str::limit($item->what, 35) }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="bg-slate-100 text-slate-700 py-0.5 px-2 rounded-full text-[10px] font-bold">
                                                {{ $item->category->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-xs text-slate-500">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if ($item->status == 'menunggu' || $item->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                                                    ⏳ Menunggu
                                                </span>
                                            @elseif($item->status == 'diproses' || $item->status == 'proses')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                                    ⚙️ Diproses
                                                </span>
                                            @elseif($item->status == 'terverifikasi' || $item->status == 'selesai')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    ✅ Terverifikasi
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                                    ❌ Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.complaints.show', $item->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-transparent rounded-md font-bold text-xs transition-colors">
                                                    Lihat Detail
                                                </a>
                                                
                                                @can('delete_complaints')
                                                <form action="{{ route('admin.complaints.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengaduan ini?');">
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
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-8 text-slate-500">
                                            Tidak ada data pengaduan yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
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
