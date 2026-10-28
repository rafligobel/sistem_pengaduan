<x-public-layout>
    <div class="w-full pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto w-full">
            {{-- Header Modern --}}
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center space-x-1 mb-1">
                    <span class="px-2 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold tracking-wide uppercase shadow-sm">
                        Langkah 1
                    </span>
                    <span class="w-2 h-1 rounded-full bg-slate-300"></span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide">
                        Langkah 2
                    </span>
                </div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                    Form Pengaduan Tindak Pidana Korupsi
                </h2>
                <p class="mt-1 text-xs text-slate-500 max-w-md mx-auto">
                    Berdasarkan Perwako Tahun 2025 &mdash; Sampaikan pengaduan Anda dengan mengisi unsur 5W+1H secara lengkap. Identitas Anda dilindungi.
                </p>
            </div>

            {{-- Card Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <div class="p-5">
                    <form action="{{ route('complaint.public.step1.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        {{-- ============================================= --}}
                        {{-- BAGIAN 1: IDENTITAS PELAPOR (READONLY) --}}
                        {{-- ============================================= --}}
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Identitas Pelapor</h3>
                                <span class="ml-auto px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500 uppercase">Otomatis</span>
                            </div>

                            <div class="bg-slate-50 rounded-lg border border-slate-200 p-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</label>
                                        <input type="text" value="{{ Auth::user()->name }}" readonly
                                            class="block w-full rounded-md border-slate-200 bg-white text-sm text-slate-700 py-1.5 cursor-not-allowed opacity-75">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Email</label>
                                        <input type="text" value="{{ Auth::user()->email }}" readonly
                                            class="block w-full rounded-md border-slate-200 bg-white text-sm text-slate-700 py-1.5 cursor-not-allowed opacity-75">
                                    </div>
                                    @if(Auth::user()->nik)
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">NIK</label>
                                        <input type="text" value="{{ Auth::user()->nik }}" readonly
                                            class="block w-full rounded-md border-slate-200 bg-white text-sm text-slate-700 py-1.5 cursor-not-allowed opacity-75">
                                    </div>
                                    @endif
                                    @if(Auth::user()->phone)
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">No. Telepon</label>
                                        <input type="text" value="{{ Auth::user()->phone }}" readonly
                                            class="block w-full rounded-md border-slate-200 bg-white text-sm text-slate-700 py-1.5 cursor-not-allowed opacity-75">
                                    </div>
                                    @endif
                                </div>
                                <p class="mt-2 text-[10px] text-slate-400 italic">
                                    <svg class="inline w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Data diambil otomatis dari akun Anda dan dijaga kerahasiaannya.
                                </p>
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- BAGIAN 2: UNSUR 5W+1H --}}
                        {{-- ============================================= --}}
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 text-indigo-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Unsur 5W + 1H</h3>
                            </div>

                            <div class="space-y-3">
                                {{-- WHAT (Apa) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="what" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-red-100 text-red-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-700">What — Apa yang Terjadi? <span class="text-red-500">*</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Jelaskan jenis pelanggaran secara spesifik, misalnya: penyuapan, penggelapan aset, pelecehan, atau benturan kepentingan.</p>
                                    <textarea id="what" name="what" rows="3"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Uraikan jenis pelanggaran yang terjadi..." required>{{ old('what') }}</textarea>
                                    @error('what')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- WHO (Siapa) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="who" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-orange-100 text-orange-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-700">Who — Siapa yang Terlibat? <span class="text-red-500">*</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Sebutkan pihak-pihak yang terlibat: pelaku utama (terlapor), pihak yang membantu, pihak yang diuntungkan, serta saksi-saksi.</p>
                                    <textarea id="who" name="who" rows="3"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Sebutkan nama/jabatan pihak yang terlibat..." required>{{ old('who') }}</textarea>
                                    @error('who')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- WHERE (Di mana) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="where_location" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-green-100 text-green-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-700">Where — Di mana Terjadi? <span class="text-red-500">*</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Sebutkan lokasi kejadian: nama divisi, kantor, ruang spesifik, atau platform digital tempat pelanggaran dilakukan.</p>
                                    <textarea id="where_location" name="where_location" rows="2"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Sebutkan lokasi/tempat terjadinya pelanggaran..." required>{{ old('where_location') }}</textarea>
                                    @error('where_location')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- WHEN (Kapan) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="when_time" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-purple-100 text-purple-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-700">When — Kapan Terjadi? <span class="text-red-500">*</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Cantumkan tanggal, jam, atau rentang waktu terjadinya pelanggaran agar mudah dicocokkan dengan data sistem/CCTV.</p>
                                    <textarea id="when_time" name="when_time" rows="2"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Kapan pelanggaran terjadi? (tanggal, jam, rentang waktu)..." required>{{ old('when_time') }}</textarea>
                                    @error('when_time')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- WHY (Mengapa) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="why" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-teal-100 text-teal-600 text-[10px] font-black">W</span>
                                        <span class="text-xs font-bold text-slate-700">Why — Mengapa Terjadi? <span class="text-slate-400 text-[10px] font-normal">(Opsional)</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Jika diketahui, jelaskan motivasi atau latar belakang mengapa pelanggaran dilakukan dan aturan internal yang dilanggar.</p>
                                    <textarea id="why" name="why" rows="2"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Motivasi/latar belakang pelanggaran (jika diketahui)...">{{ old('why') }}</textarea>
                                    @error('why')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- HOW (Bagaimana) --}}
                                <div class="bg-white rounded-lg border border-slate-200 p-4 transition-all hover:border-blue-200 hover:shadow-sm">
                                    <label for="how" class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-blue-100 text-blue-600 text-[10px] font-black">H</span>
                                        <span class="text-xs font-bold text-slate-700">How — Bagaimana Modus Operandinya? <span class="text-red-500">*</span></span>
                                    </label>
                                    <p class="text-[10px] text-slate-400 mb-2">Jelaskan skema kecurangan secara detail, termasuk bagaimana pelaku menutupi jejaknya.</p>
                                    <textarea id="how" name="how" rows="3"
                                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-slate-900 placeholder-slate-400 transition-colors"
                                        placeholder="Uraikan cara/modus pelaku melakukan pelanggaran..." required>{{ old('how') }}</textarea>
                                    @error('how')
                                        <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- BAGIAN 3: JENIS/KATEGORI TINDAK PIDANA KORUPSI --}}
                        {{-- ============================================= --}}
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Jenis Tindak Pidana Korupsi</h3>
                            </div>
                            
                            <div class="bg-white rounded-lg border border-slate-200 p-4">
                                <p class="text-[10px] text-slate-400 mb-3">Pilih kategori yang paling sesuai berdasarkan UU Tipikor. Pilih "Tidak Diketahui" jika Anda tidak yakin.</p>

                                <div class="space-y-2" x-data="{ selected: '{{ old('category_id', '') }}' }">
                                    @foreach ($categories as $cat)
                                        <label class="flex items-start gap-3 p-3 rounded-lg border cursor-pointer transition-all"
                                            :class="selected == '{{ $cat->id }}' ? 'border-blue-400 bg-blue-50 shadow-sm ring-1 ring-blue-200' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50'">
                                            <input type="radio" name="category_id" value="{{ $cat->id }}" required
                                                x-model="selected"
                                                class="mt-0.5 text-blue-600 focus:ring-blue-500 border-slate-300">
                                            <div class="flex-1">
                                                <span class="text-sm font-semibold text-slate-800">{{ $cat->name }}</span>
                                                @if($cat->name == 'Kerugian Keuangan Negara')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Perbuatan melawan hukum atau penyalahgunaan kewenangan yang merugikan keuangan/perekonomian negara.</p>
                                                @elseif($cat->name == 'Suap-menyuap')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Pemberian atau penerimaan sesuatu untuk memengaruhi tindakan pejabat yang berkaitan dengan jabatannya.</p>
                                                @elseif($cat->name == 'Penggelapan dalam Jabatan')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Penyalahgunaan atau penggelapan uang/surat berharga yang berada dalam penguasaan karena jabatan.</p>
                                                @elseif($cat->name == 'Pemerasan')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Penyalahgunaan kekuasaan/jabatan untuk memaksa seseorang memberikan sesuatu atau melakukan tindakan tertentu.</p>
                                                @elseif($cat->name == 'Perbuatan Curang')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Tindakan curang dalam pelaksanaan pekerjaan atau pengadaan tertentu sesuai UU Tipikor.</p>
                                                @elseif(str_contains($cat->name, 'Benturan Kepentingan'))
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Keterlibatan pejabat dalam pengadaan yang memiliki kepentingan pribadi sehingga memenuhi unsur tindak pidana.</p>
                                                @elseif($cat->name == 'Gratifikasi')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Pemberian dalam arti luas kepada pegawai negeri yang berkaitan dengan jabatannya dan berlawanan dengan kewajiban/tugasnya.</p>
                                                @elseif($cat->name == 'Tidak Diketahui')
                                                    <p class="text-[10px] text-slate-400 mt-0.5">Pilih ini jika Anda belum memahami atau tidak mengetahui jenis tindak pidana korupsi yang sesuai.</p>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                @error('category_id')
                                    <p class="mt-2 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- BAGIAN 4: BUKTI PENDUKUNG (MEDIA) --}}
                        {{-- ============================================= --}}
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wide">Bukti Pendukung</h3>
                                <span class="ml-auto px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 uppercase">Opsional</span>
                            </div>

                            <div class="bg-white rounded-lg border border-slate-200 p-4">
                                <p class="text-[10px] text-slate-400 mb-3">Unggah bukti berupa foto, dokumen, audio, atau video. Maksimal 5 file, masing-masing max 10MB.</p>
                                
                                <div class="relative flex justify-center px-4 py-5 border-2 border-slate-300 border-dashed rounded-lg hover:bg-slate-50 transition-colors group cursor-pointer" id="drop-zone">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-8 w-8 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-xs text-slate-600 justify-center gap-1">
                                            <span class="font-medium text-blue-600 group-hover:text-blue-500">
                                                Upload file
                                            </span>
                                            <span>atau drag & drop</span>
                                        </div>
                                        <p class="text-[10px] text-slate-500">
                                            JPG, PNG, PDF, DOC, MP4, MP3 &mdash; Max 10MB per file, max 5 file
                                        </p>
                                        <div id="file-preview" class="hidden mt-2 space-y-1">
                                        </div>
                                    </div>
                                    <input id="attachments" name="attachments[]" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*,.pdf,.doc,.docx,.mp4,.mp3" multiple onchange="previewFiles(this)">
                                </div>
                                @error('attachments')
                                    <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                                @error('attachments.*')
                                    <p class="mt-1 text-[10px] text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ============================================= --}}
                        {{-- TOMBOL AKSI --}}
                        {{-- ============================================= --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0 pt-3 border-t border-slate-100">
                            <a href="{{ url('/') }}" class="w-full sm:w-auto text-center order-2 sm:order-1 px-4 py-2 border border-slate-200 text-sm font-bold rounded-lg text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 hover:shadow-blue-500/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                Lanjut ke Konfirmasi
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="mt-3 text-center text-[10px] text-slate-400 font-medium">
                Dilindungi dengan enkripsi SSL 256-bit. Pengaduan diproses sesuai UU No. 31 Tahun 1999 jo. UU No. 20 Tahun 2001.
            </p>
            <div class="w-full h-20 bg-transparent"></div>
        </div>
    </div>

    <script>
        function previewFiles(input) {
            const previewContainer = document.getElementById('file-preview');
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                previewContainer.classList.remove('hidden');
                
                if (input.files.length > 5) {
                    previewContainer.innerHTML = '<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-red-100 text-red-800">Maksimal 5 file!</span>';
                    return;
                }

                for (let i = 0; i < input.files.length; i++) {
                    const file = input.files[i];
                    const sizeKB = (file.size / 1024).toFixed(1);
                    const span = document.createElement('span');
                    span.className = 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800';
                    span.textContent = file.name + ' (' + sizeKB + ' KB)';
                    previewContainer.appendChild(span);
                }
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>

</x-public-layout>
