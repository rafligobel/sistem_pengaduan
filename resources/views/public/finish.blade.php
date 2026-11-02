<x-public-layout>
    <div class="flex-grow flex flex-col items-center justify-center w-full px-4 py-8 sm:px-6 lg:px-8 bg-slate-50/60">
        <div class="max-w-xl mx-auto w-full">
            
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-6 sm:p-8 text-center relative overflow-hidden">
                {{-- Decorative Top Accent --}}
                <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-emerald-500"></div>

                {{-- Success Icon --}}
                <div class="flex justify-center mb-5">
                    <div class="relative">
                        <div class="flex items-center justify-center h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-emerald-50 text-emerald-600 border-[4px] border-white shadow-md ring-1 ring-emerald-100">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Title & Intro --}}
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2">
                    Pengaduan Berhasil Dikirim!
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mb-6 leading-relaxed max-w-md mx-auto">
                    Laporan Anda telah resmi tercatat di sistem <strong>SI-ADUAN</strong> Inspektorat Daerah Kota Gorontalo dan akan segera diverifikasi oleh tim pemeriksa.
                </p>

                {{-- KOTAK KETERANGAN TIKET --}}
                <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 sm:p-5 mb-6 text-left shadow-xs">
                    <div class="flex items-center justify-between border-b border-slate-200/80 pb-3 mb-3.5">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            Nomor Tiket Pengaduan
                        </span>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            {{ ucfirst($complaint->status ?? 'Pending') }} &bull; Menunggu Verifikasi
                        </span>
                    </div>

                    {{-- Kode Tiket & Tombol Salin --}}
                    <div class="flex items-center justify-between gap-3 bg-white p-3 rounded-lg border border-slate-200 mb-4">
                        <span id="ticket-id" class="text-lg sm:text-2xl font-mono font-extrabold text-blue-700 tracking-wider break-all select-all">
                            {{ $complaint->token }}
                        </span>
                        <button type="button" onclick="copyTicket()" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 hover:text-blue-700 rounded-md border border-slate-300 transition-colors shrink-0" title="Salin Kode Tiket">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v2"></path>
                            </svg>
                            <span id="copy-btn-text">Salin</span>
                        </button>
                    </div>

                    {{-- Rincian Singkat Informasi Tiket --}}
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-200/50">
                            <span class="text-slate-500">Kategori:</span>
                            <span class="font-semibold text-slate-800 text-right">{{ $complaint->category->name ?? 'Pengaduan Tipikor' }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-200/50">
                            <span class="text-slate-500">Waktu Dikirim:</span>
                            <span class="font-semibold text-slate-800 text-right">
                                {{ $complaint->created_at ? $complaint->created_at->translatedFormat('d F Y, H:i') . ' WITA' : now()->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="py-1">
                            <span class="text-slate-500 block mb-0.5">Perihal Laporan (What):</span>
                            <p class="font-medium text-slate-800 italic bg-white p-2 rounded border border-slate-100">
                                "{{ Str::limit($complaint->what, 120) }}"
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PETUNJUK KETERANGAN TIKET --}}
                <div class="bg-blue-50/70 border border-blue-200 rounded-xl p-4 mb-6 text-left text-xs text-slate-700">
                    <h4 class="font-bold text-blue-900 flex items-center gap-1.5 mb-2">
                        <svg class="w-4 h-4 text-blue-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Keterangan Penting Tiket Pengaduan:</span>
                    </h4>
                    <ul class="space-y-1.5 pl-5 list-disc text-slate-600">
                        <li><strong>Simpan Kode Tiket:</strong> Catat atau simpan kode tiket di atas sebagai bukti resmi bahwa laporan Anda telah terdaftar.</li>
                        <li><strong>Pelacakan Status:</strong> Anda dapat melacak tahapan telaah dan tindak lanjut laporan melalui menu <em>Cek Status</em> menggunakan kode tiket ini.</li>
                        <li><strong>Tahapan Pemeriksaan:</strong> Laporan Anda akan ditelaah awal oleh Administrator dan diteruskan ke Verifikator APIP Inspektorat untuk verifikasi dalam waktu 1&ndash;3 hari kerja.</li>
                        <li><strong>Kerahasiaan:</strong> Identitas pelapor dilindungi secara ketat sesuai pedoman Whistleblowing System (WBS).</li>
                    </ul>
                </div>

                {{-- TOMBOL TINDAKAN --}}
                <div class="flex flex-col sm:flex-row gap-2.5 justify-center w-full">
                    @if ($complaint->status == 'terverifikasi' || $complaint->status == 'selesai')
                        <a href="{{ route('complaints.pdf.token', $complaint->token) }}" target="_blank"
                           class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-emerald-500 text-xs sm:text-sm font-bold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-md transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Unduh Berkas PDF</span>
                        </a>
                    @endif

                    <a href="{{ route('status.show', $complaint->token) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-transparent text-xs sm:text-sm font-bold rounded-xl shadow-md text-white bg-blue-700 hover:bg-blue-800 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Lacak Status Tiket Ini</span>
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-slate-300 text-xs sm:text-sm font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-slate-900 transition-all">
                            <span>Buka Dashboard</span>
                        </a>
                    @endauth

                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-slate-300 text-xs sm:text-sm font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-slate-900 transition-all">
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6">
                Inspektorat Daerah Kota Gorontalo &bull; Saluran Pengaduan Whistleblowing System (WBS)
            </p>

        </div>
    </div>

    {{-- Script Salin Kode Tiket --}}
    <script>
        function copyTicket() {
            const ticketId = document.getElementById('ticket-id').innerText.trim();
            const btnText = document.getElementById('copy-btn-text');
            navigator.clipboard.writeText(ticketId).then(() => {
                if (btnText) {
                    btnText.innerText = 'Tersalin!';
                    setTimeout(() => {
                        btnText.innerText = 'Salin';
                    }, 2000);
                }
            });
        }
    </script>
</x-public-layout>
