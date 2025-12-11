<x-app-layout>
    <section class="popular" id="pengaduan" style="padding-top: 150px;">
        <div class="container">
            <div class="text-center mb-5" style="margin-bottom: 3rem; text-align: center;">
                <h2 class="h2 section-title">Formulir Pengaduan</h2>
                <p class="section-text">
                    Sampaikan laporan Anda dengan jelas. Identitas Anda terlindungi.
                </p>
            </div>

            <div class="card">
                <form action="{{ route('complaint.public.step1.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label" style="font-weight: bold;">Judul Laporan</label>
                        <input type="text" name="title" class="form-control"
                            placeholder="Contoh: Dugaan Pungli di..." required value="{{ old('title') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label" style="font-weight: bold;">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" style="font-weight: bold;">Isi Laporan Lengkap</label>
                        <textarea name="content" class="form-control" rows="6" placeholder="Jelaskan detail kejadian..." required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" style="font-weight: bold;">Bukti Foto (Opsional)</label>
                        <input type="file" name="image" class="form-control" style="padding: 10px;">
                    </div>

                    <div style="text-align: right; margin-top: 20px;">
                        <button type="submit" class="btn btn-primary">Lanjut ke Konfirmasi &rarr;</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
