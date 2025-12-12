<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 pt-20">
        <div class="max-w-md w-full text-center">
            
            {{-- Success Icon Animation --}}
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6 animate-bounce">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-slate-900 mb-2">
                Laporan Berhasil Dikirim!
            </h2>
            <p class="text-sm text-slate-500 mb-8 max-w-xs mx-auto">
                Terima kasih telah melapor. Laporan Anda akan segera kami tindak lanjuti.
            </p>

            {{-- Ticket Box --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8 relative overflow-hidden group">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">ID Laporan Anda</p>
                
                <div class="flex items-center justify-center gap-3 bg-slate-50 rounded-lg py-3 px-4 border border-slate-100 relative">
                    <h1 id="ticketToken" class="text-2xl font-mono font-bold text-slate-800 tracking-tight select-all">
                        {{ $complaint->token }}
                    </h1>
                    
                    {{-- Copy Button --}}
                    <button onclick="copyToken()" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Salin ID Taket">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                    
                    {{-- Tooltip Copied --}}
                    <span id="copyFeedback" class="absolute -top-8 right-0 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 transition-opacity duration-300">
                        Disalin!
                    </span>
                </div>
                
                <p class="mt-3 text-xs text-slate-400">
                    Simpan ID ini untuk memantau perkembangan laporan.
                </p>
            </div>

            {{-- Actions --}}
            <div class="space-y-3 sm:space-y-0 sm:flex sm:gap-3 justify-center">
                <a href="{{ route('status.index') }}" 
                   class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 border border-slate-300 shadow-sm text-sm font-bold rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-all">
                    Cek Status
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 transition-all">
                    Ke Dashboard
                </a>
            </div>

        </div>
    </div>

    <script>
        function copyToken() {
            const tokenText = document.getElementById('ticketToken').innerText.trim();
            navigator.clipboard.writeText(tokenText).then(() => {
                const feedback = document.getElementById('copyFeedback');
                feedback.classList.remove('opacity-0');
                setTimeout(() => {
                    feedback.classList.add('opacity-0');
                }, 2000);
            });
        }
    </script>
</x-app-layout>
