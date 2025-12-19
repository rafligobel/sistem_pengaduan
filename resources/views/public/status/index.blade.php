<x-public-layout>
    <div class="relative bg-white overflow-hidden">
        {{-- Hero Background --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-slate-900 opacity-95"></div>
            {{-- Optional: Add pattern/image here --}}
        </div>

        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 pt-32 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                Lacak Status Laporan
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-slate-300">
                Masukkan ID Tiket Anda untuk mengetahui perkembangan terkini dari laporan yang telah Anda kirimkan.
            </p>

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="mt-8 max-w-xl mx-auto bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{!! session('error') !!}</span>
                </div>
            @endif

            {{-- Search Form --}}
            <div class="mt-10 max-w-xl mx-auto">
                <form action="{{ route('status.check') }}" method="POST" class="sm:flex gap-2">
                    @csrf
                    <div class="w-full">
                        <label for="ticket_id" class="sr-only">ID Tiket</label>
                        <input type="text" name="ticket_id" id="ticket_id" required
                            class="block w-full px-5 py-3 text-base text-slate-900 placeholder-slate-500 border border-transparent rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-white focus:border-white"
                            placeholder="Contoh: TIKET-202X-XXXX">
                    </div>
                    <button type="submit"
                        class="mt-3 w-full sm:mt-0 sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-blue-500 transition-colors">
                        Lacak
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Riwayat Pengaduan (Login Only) --}}
    @auth
        <div class="bg-slate-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-2xl font-bold text-slate-900">Riwayat Pengaduan Saya</h2>
                        <p class="mt-2 text-sm text-slate-600">Daftar semua laporan yang pernah Anda kirimkan.</p>
                    </div>
                </div>
                
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-slate-300 bg-white">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">ID Tiket</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Judul</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Detail</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 bg-white">
                                        @forelse(Auth::user()->complaints as $item)
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-blue-600 sm:pl-6 family-mono">
                                                    {{ $item->token }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                                    {{ Str::limit($item->title, 40) }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    @if ($item->status == 'pending')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                            Menunggu
                                                        </span>
                                                    @elseif($item->status == 'proses')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Diproses
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
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <a href="{{ route('complaint.public.finish', $item->token) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500 italic">
                                                    Belum ada riwayat pengaduan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</x-public-layout>
