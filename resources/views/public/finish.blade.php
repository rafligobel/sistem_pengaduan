<x-public-layout>
    <section class="popular" style="min-height: 80vh; display: flex; align-items: center;">
        <div class="container text-center">

            <div class="card shadow-lg border-0" style="max-width: 600px; margin: 0 auto; border-radius: 20px;">
                <div class="card-body p-5">
                    <div style="font-size: 4rem; color: #28a745;" class="mb-3">
                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                    </div>

                    <h2 class="h2 text-dark">Laporan Terkirim!</h2>
                    <p class="text-muted mb-4">Terima kasih telah melapor. Identitas Anda aman.</p>

                    <div class="alert alert-primary py-4" role="alert" style="border-radius: 10px;">
                        <p class="mb-2 font-weight-bold">Nomor Tiket Anda:</p>
                        <h1 class="display-4 font-weight-bold text-primary m-0">{{ $complaint->ticket_id }}</h1>
                        <small>Simpan nomor ini untuk mengecek status laporan.</small>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('status.index') }}" class="btn btn-outline-primary mr-2">Cek Status</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Ke Dashboard Saya</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-public-layout>
