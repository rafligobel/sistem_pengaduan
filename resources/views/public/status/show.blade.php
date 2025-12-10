<x-public-layout>
    <section class="popular">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="h2 section-title">Status Pengaduan</h2>
                <p class="section-text">Detail tiket: <strong>{{ $complaint->ticket_id }}</strong></p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="m-0 text-white">Detail Laporan</h5>
                            <span
                                class="badge badge-light text-primary">{{ $complaint->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="card-body">
                            <h3 class="h4 text-dark mb-3">{{ $complaint->title }}</h3>
                            <span class="badge badge-info mb-3">{{ $complaint->category->name ?? 'Umum' }}</span>

                            <p class="text-justify text-dark mt-2">
                                {!! nl2br(e($complaint->content)) !!}
                            </p>

                            @if ($complaint->image)
                                <hr>
                                <p class="font-weight-bold">Bukti Lampiran:</p>
                                <img src="{{ asset('storage/' . $complaint->image) }}" class="img-fluid rounded"
                                    style="max-height: 400px; width: auto;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-muted mb-3">Status Saat Ini</h5>
                            @if ($complaint->status == 'pending')
                                <span class="badge badge-warning p-3" style="font-size: 1rem;">MENUNGGU
                                    VERIFIKASI</span>
                            @elseif($complaint->status == 'proses')
                                <span class="badge badge-info p-3" style="font-size: 1rem;">SEDANG DIPROSES</span>
                            @elseif($complaint->status == 'selesai')
                                <span class="badge badge-success p-3" style="font-size: 1rem;">SELESAI</span>
                            @elseif($complaint->status == 'ditolak')
                                <span class="badge badge-danger p-3" style="font-size: 1rem;">DITOLAK</span>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="m-0 text-white">Tanggapan Petugas</h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($complaint->responses as $response)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $response->user->name ?? 'Admin' }}</strong>
                                            <small
                                                class="text-muted">{{ $response->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mt-2 mb-0 small text-dark">{{ $response->content }}</p>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted py-4">
                                        Belum ada tanggapan.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('status.index') }}" class="btn btn-secondary">Kembali Cari</a>
            </div>
        </div>
    </section>
</x-public-layout>
