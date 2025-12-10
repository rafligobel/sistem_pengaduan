<x-public-layout>
    <section class="hero" style="padding-top: 150px; padding-bottom: 100px; min-height: 60vh;">
        <div class="container">

            <div class="hero-content text-center">
                <h1 class="h2 hero-title" style="color: #0d2481;">Lacak Pengaduan</h1>
                <p class="hero-text" style="color: #666; margin-bottom: 30px;">
                    Masukkan ID Tiket atau NIK Anda untuk melihat sejauh mana proses tindak lanjut laporan Anda.
                </p>

                @if (session('error'))
                    <div class="alert alert-danger"
                        style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: inline-block;">
                        {!! session('error') !!}
                    </div>
                @endif

                <div class="search-box-wrapper" style="max-width: 600px; margin: 0 auto;">
                    <form action="{{ route('status.check') }}" method="POST">
                        @csrf
                        <div class="input-wrapper" style="display: flex; gap: 10px;">
                            <input type="text" name="ticket_id" class="form-control form-input"
                                placeholder="Masukkan ID Tiket (Contoh: TICKET-12345)" required
                                style="padding: 15px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
                            <button type="submit" class="btn btn-primary" style="padding: 15px 30px;">Cek</button>
                        </div>
                    </form>
                </div>

                @auth
                    <div class="mt-5 text-left"
                        style="background: white; padding: 30px; border-radius: 15px; margin-top: 50px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                        <h3 class="h3 section-title mb-4" style="font-size: 1.5rem; color: #0d2481;">Riwayat Pengaduan Saya
                        </h3>

                        <div class="table-responsive">
                            <table class="table" style="width: 100%; text-align: left; border-collapse: collapse;">
                                <thead style="border-bottom: 2px solid #eee;">
                                    <tr>
                                        <th style="padding: 15px;">Tanggal</th>
                                        <th style="padding: 15px;">Judul Laporan</th>
                                        <th style="padding: 15px;">Status</th>
                                        <th style="padding: 15px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->complaints as $item)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 15px;">{{ $item->created_at->format('d M Y') }}</td>
                                            <td style="padding: 15px;">{{ $item->title }}</td>
                                            <td style="padding: 15px;">
                                                @if ($item->status == 'pending')
                                                    <span class="badge"
                                                        style="background: #ffc107; color: #000; padding: 5px 10px; border-radius: 5px;">Pending</span>
                                                @elseif($item->status == 'proses')
                                                    <span class="badge"
                                                        style="background: #17a2b8; color: #fff; padding: 5px 10px; border-radius: 5px;">Proses</span>
                                                @elseif($item->status == 'selesai')
                                                    <span class="badge"
                                                        style="background: #28a745; color: #fff; padding: 5px 10px; border-radius: 5px;">Selesai</span>
                                                @elseif($item->status == 'ditolak')
                                                    <span class="badge"
                                                        style="background: #dc3545; color: #fff; padding: 5px 10px; border-radius: 5px;">Ditolak</span>
                                                @endif
                                            </td>
                                            <td style="padding: 15px;">
                                                <a href="{{ route('complaint.public.finish', $item->ticket_id) }}"
                                                    class="btn-link" style="color: #0d2481; font-weight: 600;">Lihat
                                                    Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center" style="padding: 30px; color: #999;">
                                                Belum ada pengaduan yang Anda kirim.
                                            </td>
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
