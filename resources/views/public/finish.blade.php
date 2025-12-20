<x-public-layout>
    <div class="flex-grow flex flex-col items-center justify-center w-full px-4 py-8 sm:px-6 lg:px-8 bg-slate-50/50">
        <div class="max-w-md mx-auto w-full">
            
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-10 text-center relative">
                {{-- Decorative Background Elements --}}
                <div class="absolute inset-0 overflow-hidden rounded-2xl pointer-events-none">
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500"></div>
                </div>

                {{-- Success Icon --}}
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-75"></div>
                        <div class="relative flex items-center justify-center h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-green-50 text-green-500 border-[5px] border-white shadow-sm ring-1 ring-green-100">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2">
                    Laporan Terkirim!
                </h2>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Kami telah menerima laporan Anda. Cek status laporan anda secara berkala.
                </p>

                {{-- Ticket ID Box --}}
                <!-- <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 sm:p-5 mb-6 relative group shadow-inner hover:shadow-md transition-shadow">
                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-[0.2em] mb-2">ID Tiket Laporan</p>
                    
                    <div class="flex items-center justify-center gap-3 shrink-0 cursor-pointer select-all" onclick="copyTicket()" title="Klik untuk menyalin">
                        <span id="ticket-id" class="text-lg sm:text-3xl font-mono font-black text-slate-800 tracking-widest break-all">
                            {{ $complaint->token }}
                        </span>
                        
                        <button class="p-1.5 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v2"></path></svg>
                        </button>
                    </div>

                    {{-- Tooltip feedback --}}
                    <div id="copy-feedback" class="absolute -bottom-9 left-1/2 transform -translate-x-1/2 opacity-0 transition-opacity duration-300 pointer-events-none">
                         <span class="bg-slate-800 text-white text-[10px] font-bold py-1 px-2.5 rounded-full shadow-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Disalin!
                        </span>
                    </div>
                </div> -->

                <div class="flex flex-col gap-2.5 justify-center w-full">
                    <!-- <a href="{{ route('status.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-blue-600 hover:border-blue-200 transition-all">
                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Lacak Status
                    </a> -->
                    <a href="{{ url('/') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-xl shadow-lg shadow-blue-500/30 text-white bg-blue-600 hover:bg-blue-700 transition-all transform active:scale-95">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
            
            <p class="text-center text-xs text-slate-400 mt-6 md:mt-8">
                Terima kasih telah berpartisipasi dalam membangun tata kelola yang lebih baik.
            </p>

        </div>
    </div>

    <script>
        function copyTicket() {
            const ticketId = document.getElementById('ticket-id').innerText.trim();
            navigator.clipboard.writeText(ticketId).then(() => {
                const feedback = document.getElementById('copy-feedback');
                feedback.classList.remove('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    feedback.classList.add('opacity-0', 'translate-y-2');
                }, 2000);
            });
        }
    </script>
</x-public-layout>
