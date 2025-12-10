<x-public-layout>
    <section class="hero"
        style="padding-top: 160px; padding-bottom: 100px; background-image: url('{{ asset('assets/img/hero-bg.jpg') }}');">
        <div class="container">

            <div class="hero-content text-center">
                <h1 class="h2 hero-title" style="color: #0d2481;">Lacak Status Laporan</h1>
                <p class="hero-text" style="color: #555; margin-bottom: 30px;">
                    Masukkan ID Tiket yang Anda dapatkan saat melapor.
                </p>

                @if (session('error'))
                    <div class="alert alert-danger" style="display: inline-block; width: 100%; max-width: 600px;">
                        {!! session('error') !!}
                    </div>
                @endif

                <div
                    style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <form action="{{ route('status.check') }}" method="POST" style="display: flex; gap: 10px;">
                        @csrf
                        <input type="text" name="ticket_id" class="form-control"
                            placeholder="Contoh: TIKET-2024-XXXX" required
                            style="margin-bottom: 0; border: 2px solid #eee;">
                        <button type="submit" class="btn btn-primary">Cek</button>
                    </form>
                </div>

                @auth
                    <div class="card mt-5" style="margin-top: 50px; text-align: left;">
                        <h3 class="h3 section-title" style="margin-bottom: 20px; font-size: 1.25rem;">Riwayat Pengaduan Saya
                        </h3>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                        <th style="padding: 15px; text-align: left;">ID Tiket</th>
                                        <th style="padding: 15px; text-align: left;">Judul</th>
                                        <th style="padding: 15px; text-align: left;">Status</th>
                                        <th style="padding: 15px; text-align: left;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->complaints as $item)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 15px; font-weight: bold; color: #0d2481;">
                                                {{ $item->ticket_id }}</td>
                                            <td style="padding: 15px;">{{ $item->title }}</td>
                                            <td style="padding: 15px;">
                                                <span
                                                    style="padding: 5px 10px; border-radius: 5px; font-size: 0.8rem; font-weight: bold;
                                                    background: {{ $item->status == 'pending' ? '#ffc107' : ($item->status == 'proses' ? '#17a2b8' : ($item->status == 'selesai' ? '#28a745' : '#dc3545')) }};
                                                    color: {{ $item->status == 'pending' ? 'black' : 'white' }};">
                                                    {{ strtoupper($item->status) }}
                                                </span>
                                            </td>
                                            <td style="padding: 15px;">
                                                <a href="{{ route('complaint.public.finish', $item->ticket_id) }}"
                                                    style="color: #0d2481; text-decoration: underline;">Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="padding: 20px; text-align: center; color: #777;">Belum
                                                ada riwayat pengaduan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>
</x-public-layout>
