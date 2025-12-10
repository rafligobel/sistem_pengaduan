<x-public-layout>
    <section class="popular" style="padding-top: 150px; min-height: 80vh;">
        <div class="container">

            <div class="text-center mb-5" style="margin-bottom: 40px;">
                <h2 class="h2 section-title" style="color: #0d2481;">Dashboard Pengaduan</h2>
                <p class="section-text">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
                </p>
            </div>

            <div class="card"
                style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h3 class="h3" style="color: #0d2481;">Daftar Laporan Saya</h3>
                    <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary">
                        + Buat Laporan Baru
                    </a>
                </div>

                @if (Auth::user()->complaints && Auth::user()->complaints->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                                    <th style="padding: 15px; text-align: left; color: #555;">ID Tiket</th>
                                    <th style="padding: 15px; text-align: left; color: #555;">Judul</th>
                                    <th style="padding: 15px; text-align: left; color: #555;">Tanggal</th>
                                    <th style="padding: 15px; text-align: left; color: #555;">Status</th>
                                    <th style="padding: 15px; text-align: left; color: #555;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->complaints as $complaint)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 15px; font-weight: bold; color: #0d2481;">
                                            {{ $complaint->ticket_id }}</td>
                                        <td style="padding: 15px;">{{ Str::limit($complaint->title, 30) }}</td>
                                        <td style="padding: 15px;">{{ $complaint->created_at->format('d M Y') }}</td>
                                        <td style="padding: 15px;">
                                            @if ($complaint->status == 'pending')
                                                <span
                                                    style="background: #ffc107; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">Menunggu</span>
                                            @elseif($complaint->status == 'proses')
                                                <span
                                                    style="background: #17a2b8; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">Proses</span>
                                            @elseif($complaint->status == 'selesai')
                                                <span
                                                    style="background: #28a745; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">Selesai</span>
                                            @else
                                                <span
                                                    style="background: #dc3545; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">Ditolak</span>
                                            @endif
                                        </td>
                                        <td style="padding: 15px;">
                                            <a href="{{ route('complaint.public.finish', $complaint->ticket_id) }}"
                                                style="color: #0d2481; text-decoration: underline; font-weight: 600;">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 10px;">
                        <p style="color: #888;">Anda belum memiliki riwayat pengaduan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-public-layout>
