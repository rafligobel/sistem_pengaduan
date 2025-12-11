<x-app-layout>
    <section class="popular">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="h2 section-title">Konfirmasi Laporan</h2>
                <p class="section-text">Langkah 2 dari 2: Periksa kembali data Anda sebelum dikirim.</p>
            </div>

            <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 0 auto;">
                <div class="card-body p-5">

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold text-dark">Judul:</div>
                        <div class="col-md-8">{{ $data['title'] }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold text-dark">Kategori:</div>
                        <div class="col-md-8 badge badge-info">{{ $category->name }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold text-dark">Isi Laporan:</div>
                        <div class="col-md-8 text-justify">{!! nl2br(e($data['content'])) !!}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold text-dark">Bukti Foto:</div>
                        <div class="col-md-8">
                            @if ($image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Preview"
                                    class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            @else
                                <span class="text-muted">Tidak ada foto dilampirkan.</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-secondary">Kembali /
                            Edit</a>

                        <form action="{{ route('complaint.public.step2.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg px-5">Kirim Laporan!</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
