<x-public-layout>
    <section class="popular" id="pengaduan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="h2 section-title">Formulir Pengaduan</h2>
                <p class="section-text">
                    Langkah 1 dari 2: Isi detail laporan Anda.
                </p>
            </div>

            <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; max-width: 800px; margin: 0 auto;">
                <div class="card-body p-5">
                    <form action="{{ route('complaint.public.step1.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Judul Laporan</label>
                            <input type="text" name="title" class="form-control p-3"
                                placeholder="Contoh: Jalan Rusak di..." required value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Kategori</label>
                            <select name="category_id" class="form-control p-3" style="height: 50px;" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Isi Laporan Lengkap</label>
                            <textarea name="content" class="form-control p-3" rows="6"
                                placeholder="Jelaskan kronologi kejadian secara detail..." required>{{ old('content') }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Bukti Foto (Opsional)</label>
                            <input type="file" name="image" class="form-control-file border p-2 w-100"
                                style="border-radius: 5px;">
                            <small class="text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">Lanjut ke Review</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
