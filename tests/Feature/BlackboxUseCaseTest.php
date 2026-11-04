<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BlackboxUseCaseTest extends TestCase
{
    use RefreshDatabase;

    protected User $masyarakat;
    protected User $admin;
    protected User $verifikator;
    protected User $pimpinan;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        // Jalankan seeder roles dan permissions resmi
        $this->seed(RolesAndPermissionsSeeder::class);

        // Ambil user resmi hasil seeder atau buat jika belum ada
        $this->masyarakat = User::where('email', 'warga@example.com')->first()
            ?? User::factory()->create(['email' => 'warga@example.com']);
        if (!$this->masyarakat->hasRole('masyarakat')) {
            $this->masyarakat->assignRole('masyarakat');
        }

        $this->admin = User::where('email', 'admin@example.com')->first()
            ?? User::factory()->create(['email' => 'admin@example.com']);
        if (!$this->admin->hasRole('admin')) {
            $this->admin->assignRole('admin');
        }

        $this->verifikator = User::where('email', 'timkhusus@example.com')->first()
            ?? User::factory()->create(['email' => 'timkhusus@example.com']);
        if (!$this->verifikator->hasRole('verifikator')) {
            $this->verifikator->assignRole('verifikator');
        }

        $this->pimpinan = User::where('email', 'pimpinan@example.com')->first()
            ?? User::factory()->create(['email' => 'pimpinan@example.com']);
        if (!$this->pimpinan->hasRole('pimpinan')) {
            $this->pimpinan->assignRole('pimpinan');
        }

        $this->category = Category::firstOrCreate([
            'name' => 'Pelanggaran Administratif Pelayanan',
        ]);
    }

    // =========================================================================
    // TC01: USE CASE REGISTRASI (Aktor: Masyarakat)
    // =========================================================================

    public function test_tc01_positif_masyarakat_dapat_melakukan_registrasi(): void
    {
        $response = $this->post('/register', [
            'name' => 'Pelapor Baru',
            'nik' => '7571012345670001',
            'phone' => '081234567890',
            'email' => 'pelapor.baru@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('users', [
            'email' => 'pelapor.baru@example.com',
            'nik' => '7571012345670001',
        ]);
    }

    public function test_tc01_negatif_registrasi_ditolak_jika_email_duplikat(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Pelapor Duplikat',
            'nik' => '7571012345670002',
            'phone' => '081234567891',
            'email' => $this->masyarakat->email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // =========================================================================
    // TC02: USE CASE LOGIN & RELASI <<INCLUDE>> (Semua Aktor)
    // =========================================================================

    public function test_tc02_positif_aktor_dapat_login_dengan_kredensial_valid(): void
    {
        $response = $this->post('/login', [
            'email' => $this->masyarakat->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->masyarakat);
        $response->assertRedirect();
    }

    public function test_tc02_negatif_akses_fitur_tanpa_login_dialihkan_ke_halaman_login(): void
    {
        // Menguji relasi <<include>> login pada fitur yang diproteksi
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/admin/complaints')->assertRedirect('/login');
        $this->get('/admin/categories')->assertRedirect('/login');
    }

    // =========================================================================
    // TC03: PANTAU STATUS LAPORAN BERDASARKAN KODE REGISTRASI (Masyarakat)
    // =========================================================================

    public function test_tc03_positif_masyarakat_memantau_status_dengan_kode_valid(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-ABCD',
            'what' => 'Terjadi pungutan liar layanan publik perizinan usaha',
            'who' => 'Oknum petugas loket pelayanan dinas',
            'where_location' => 'Kantor Pelayanan Terpadu Satu Pintu',
            'when_time' => '28 Oktober 2026 pukul 10:00 WITA',
            'why' => 'Mempercepat pengurusan berkas perizinan pemohon',
            'how' => 'Meminta setoran tunai tambahan tanpa disertai kwitansi',
            'status' => 'menunggu',
        ]);

        // Form submit cek status menggunakan nomor token
        $response = $this->post('/cek-status', [
            'token' => $complaint->token,
        ]);

        $response->assertRedirect(route('status.show', $complaint->token));

        // Membuka halaman detail pengaduan publik
        $viewResponse = $this->get('/status/' . $complaint->token);
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee($complaint->token);
    }

    public function test_tc03_negatif_pantau_status_dengan_kode_tidak_terdaftar(): void
    {
        $response = $this->post('/cek-status', [
            'token' => 'TIKET-TIDAK-VALID-999',
        ]);

        $response->assertRedirect(route('status.index'));
        $response->assertSessionHas('error');
    }

    // =========================================================================
    // TC04: MEMBUAT LAPORAN PENGADUAN (Aktor: Masyarakat)
    // =========================================================================

    public function test_tc04_positif_masyarakat_membuat_laporan_pengaduan_5w1h(): void
    {
        // Tahap 1: Validasi form 5W+1H dan simpan ke sesi sementara
        $step1Response = $this->actingAs($this->masyarakat)->post('/lapor/step-1', [
            'category_id' => $this->category->id,
            'what' => 'Penyalahgunaan alokasi anggaran belanja fiktif tahun 2026',
            'who' => 'Pejabat pelaksana teknis kegiatan satuan kerja',
            'where_location' => 'Instansi Dinas Pekerjaan Umum Daerah',
            'when_time' => '15 Oktober 2026 jam kerja dinas',
            'why' => 'Mark-up harga satuan barang pengadaan rutin',
            'how' => 'Membuat kwitansi fiktif dan merekayasa tanda tangan pengesahan',
        ]);

        $step1Response->assertRedirect(route('complaint.public.step2.create'));
        $step1Response->assertSessionHasNoErrors();

        // Tahap 2: Konfirmasi dan simpan ke database
        $step2Response = $this->actingAs($this->masyarakat)->post('/lapor/step-2');
        $step2Response->assertRedirect();

        $this->assertDatabaseHas('complaints', [
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'status' => 'menunggu',
        ]);
    }

    public function test_tc04_negatif_membuat_laporan_gagal_jika_data_5w1h_kosong(): void
    {
        $response = $this->actingAs($this->masyarakat)->post('/lapor/step-1', [
            'category_id' => '',
            'what' => '',
            'who' => '',
            'where_location' => '',
            'when_time' => '',
            'why' => '',
            'how' => '',
        ]);

        $response->assertSessionHasErrors(['category_id', 'what', 'who', 'where_location', 'when_time', 'how']);
    }

    // =========================================================================
    // TC05: MENGAKSES LAPORAN PENGADUAN & DOKUMEN PDF (Semua Aktor)
    // =========================================================================

    public function test_tc05_positif_aktor_berwenang_mengakses_daftar_dan_pdf_laporan(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-PDF1',
            'what' => 'Ketidaksesuaian laporan belanja operasional instansi',
            'who' => 'Bendahara pengeluaran satuan kerja perangkat daerah',
            'where_location' => 'Kantor Inspektorat Kota Gorontalo',
            'when_time' => '20 Oktober 2026',
            'why' => 'Kelalaian pelaporan bukti transaksi pengeluaran kas',
            'how' => 'Nota belanja tidak dilampirkan secara sah dan lengkap',
            'status' => 'terverifikasi',
        ]);

        // Masyarakat mengakses dasbor miliknya
        $this->actingAs($this->masyarakat)
            ->get('/dashboard')
            ->assertStatus(200);

        // Admin, Verifikator, dan Pimpinan dapat mengakses daftar laporan
        foreach ([$this->admin, $this->verifikator, $this->pimpinan] as $internalActor) {
            $this->actingAs($internalActor)
                ->get('/admin/complaints')
                ->assertStatus(200);
        }

        // Dokumen PDF laporan berstatus terverifikasi dapat diakses
        $pdfResponse = $this->actingAs($this->masyarakat)
            ->get("/complaints/{$complaint->id}/pdf");
        $pdfResponse->assertStatus(200);
        $pdfResponse->assertHeader('content-type', 'application/pdf');
    }

    public function test_tc05_negatif_masyarakat_ditolak_mengakses_panel_laporan_admin(): void
    {
        $this->actingAs($this->masyarakat)
            ->get('/admin/complaints')
            ->assertStatus(403);
    }

    // =========================================================================
    // TC06: MELAKUKAN VERIFIKASI ADMINISTRATIF (Aktor: Admin)
    // =========================================================================

    public function test_tc06_positif_admin_melakukan_verifikasi_administratif(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-ADM1',
            'what' => 'Pelanggaran ketentuan standar waktu pelayanan publik',
            'who' => 'Staf administrasi bagian pelayanan perizinan',
            'where_location' => 'Bagian Umum Pelayanan Masyarakat',
            'when_time' => '25 Oktober 2026',
            'why' => 'Dokumen ditahan tanpa alasan dan landasan regulasi',
            'how' => 'Berkas permohonan dibiarkan melebihi SOP waktu pelayanan',
            'status' => 'menunggu',
        ]);

        // Admin menelaah laporan berstatus 'menunggu' dan meneruskannya ('diproses') ke Verifikator
        $response = $this->actingAs($this->admin)->put("/admin/complaints/{$complaint->id}", [
            'status' => 'diproses',
            'note' => 'Berkas administrasi lengkap, diteruskan ke Verifikator.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('complaints', [
            'id' => $complaint->id,
            'status' => 'diproses',
        ]);
    }

    public function test_tc06_negatif_aktor_selain_admin_ditolak_verifikasi_administratif(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-ADM2',
            'what' => 'Uji proteksi akses verifikasi administratif pengaduan',
            'who' => 'Oknum terkait investigasi sistem',
            'where_location' => 'Lokasi kantor pemerintah daerah',
            'when_time' => '26 Oktober 2026',
            'why' => 'Keperluan pengujian hak akses antar peran aktor',
            'how' => 'Menjalankan skenario pengujian tanpa hak otorisasi',
            'status' => 'menunggu',
        ]);

        // Masyarakat tidak berhak mengakses rute verifikasi internal (403)
        $this->actingAs($this->masyarakat)
            ->put("/admin/complaints/{$complaint->id}", ['status' => 'diproses'])
            ->assertStatus(403);

        // Pimpinan hanya bertindak sebagai pemantau dan dilarang mengubah status (403)
        $this->actingAs($this->pimpinan)
            ->put("/admin/complaints/{$complaint->id}", ['status' => 'diproses'])
            ->assertStatus(403);
    }

    // =========================================================================
    // TC07: VERIFIKASI LAPORAN & CATATAN VERIFIKASI (Aktor: Verifikator)
    // =========================================================================

    public function test_tc07_positif_verifikator_menambahkan_catatan_verifikasi(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-VRF1',
            'what' => 'Indikasi penyimpangan prosedur pengadaan tender lelang',
            'who' => 'Panitia pengadaan barang dan jasa instansi',
            'where_location' => 'Unit Layanan Pengadaan Barang Jasa',
            'when_time' => '27 Oktober 2026',
            'why' => 'Mengarahkan pemenang lelang pada rekanan terafiliasi',
            'how' => 'Persyaratan lelang diatur khusus untuk membatasi peserta lain',
            'status' => 'diproses',
        ]);

        // Verifikator memverifikasi laporan berstatus 'diproses' menjadi 'terverifikasi' disertai catatan
        $response = $this->actingAs($this->verifikator)->put("/admin/complaints/{$complaint->id}", [
            'status' => 'terverifikasi',
            'note' => 'Laporan memenuhi unsur 5W1H dan bukti awal dinyatakan lengkap.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('complaints', [
            'id' => $complaint->id,
            'status' => 'terverifikasi',
        ]);
        $this->assertDatabaseHas('responses', [
            'complaint_id' => $complaint->id,
            'user_id' => $this->verifikator->id,
            'content' => 'Laporan memenuhi unsur 5W1H dan bukti awal dinyatakan lengkap.',
        ]);
    }

    public function test_tc07_negatif_verifikator_gagal_menyimpan_catatan_kosong(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-20261104-VRF2',
            'what' => 'Indikasi pelanggaran disiplin kerja pegawai negeri',
            'who' => 'Pegawai bagian kepegawaian dinas',
            'where_location' => 'Kantor Badan Kepegawaian Daerah',
            'when_time' => '28 Oktober 2026',
            'why' => 'Tidak masuk kerja tanpa surat izin yang sah',
            'how' => 'Meninggalkan tugas kedinasan pada waktu jam kerja efektif',
            'status' => 'menunggu', // Status belum diproses oleh Admin
        ]);

        // Verifikator tidak diizinkan memproses laporan yang belum berstatus 'diproses' oleh Admin
        $response = $this->actingAs($this->verifikator)->put("/admin/complaints/{$complaint->id}", [
            'status' => 'terverifikasi',
            'note' => 'Catatan verifikasi',
        ]);

        $response->assertSessionHas('error');
    }

    // =========================================================================
    // TC08: KELOLA DATA MASTER (Aktor: Admin)
    // =========================================================================

    public function test_tc08_positif_admin_mengelola_data_master_kategori_dan_pengguna(): void
    {
        // 1. Tambah Kategori Baru oleh Admin
        $categoryResponse = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => 'Tindak Pidana Korupsi Finansial',
        ]);

        $categoryResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('categories', [
            'name' => 'Tindak Pidana Korupsi Finansial',
        ]);

        // 2. Tambah Pengguna Baru oleh Admin
        $userResponse = $this->actingAs($this->admin)->post('/admin/users', [
            'name' => 'Petugas Verifikator Baru',
            'email' => 'verifikator.baru@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'verifikator',
        ]);

        $userResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'email' => 'verifikator.baru@example.com',
        ]);
    }

    public function test_tc08_negatif_kelola_data_master_gagal_jika_input_kosong(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }
}
