<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\Response as ComplaintResponse;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

        // 1. Jalankan seeder roles & permissions resmi
        $this->seed(RolesAndPermissionsSeeder::class);

        // 2. Pastikan 4 role resmi terdaftar
        foreach (['masyarakat', 'admin', 'verifikator', 'pimpinan'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // 3. Ambil atau inisialisasi akun pengujian untuk masing-masing peran
        $this->masyarakat = User::where('email', 'warga@example.com')->first();
        if (!$this->masyarakat) {
            $this->masyarakat = User::factory()->create([
                'name' => 'Masyarakat Penguji',
                'email' => 'warga.test@example.com',
                'nik' => '7571010101010001',
                'phone' => '081234567890',
                'password' => Hash::make('password'),
            ]);
            $this->masyarakat->syncRoles(['masyarakat']);
        }

        $this->admin = User::where('email', 'admin@example.com')->first();
        if (!$this->admin) {
            $this->admin = User::factory()->create([
                'name' => 'Admin Penguji',
                'email' => 'admin.test@example.com',
                'password' => Hash::make('password'),
            ]);
            $this->admin->syncRoles(['admin']);
        }

        $this->verifikator = User::where('email', 'timkhusus@example.com')->first();
        if (!$this->verifikator) {
            $this->verifikator = User::factory()->create([
                'name' => 'Verifikator Penguji',
                'email' => 'verifikator.test@example.com',
                'password' => Hash::make('password'),
            ]);
            $this->verifikator->syncRoles(['verifikator']);
        }

        $this->pimpinan = User::where('email', 'pimpinan@example.com')->first();
        if (!$this->pimpinan) {
            $this->pimpinan = User::factory()->create([
                'name' => 'Pimpinan Penguji',
                'email' => 'pimpinan.test@example.com',
                'password' => Hash::make('password'),
            ]);
            $this->pimpinan->syncRoles(['pimpinan']);
        }

        // 4. Pastikan kategori pengujian tersedia
        $this->category = Category::firstOrCreate(
            ['name' => 'Pelanggaran Administratif'],
            ['description' => 'Kategori pelanggaran administratif pengadaan barang dan jasa']
        );
    }

    // =========================================================================
    // TC01: USE CASE REGISTRASI (Aktor: Masyarakat)
    // =========================================================================

    public function test_tc01_positif_masyarakat_dapat_melakukan_registrasi(): void
    {
        $payload = [
            'name' => 'Pelapor Baru Gorontalo',
            'nik' => '7571020202020002',
            'phone' => '081298765432',
            'email' => 'pelapor.baru@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $response = $this->post('/register', $payload);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'pelapor.baru@example.com',
            'nik' => '7571020202020002',
        ]);

        $registeredUser = User::where('email', 'pelapor.baru@example.com')->first();
        $this->assertNotNull($registeredUser);
        $this->assertTrue($registeredUser->hasRole('masyarakat'));
    }

    public function test_tc01_negatif_registrasi_ditolak_jika_email_duplikat(): void
    {
        $payload = [
            'name' => 'Pelapor Duplikat',
            'nik' => '7571030303030003',
            'phone' => '081298765433',
            'email' => $this->masyarakat->email,
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $response = $this->from('/register')->post('/register', $payload);

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
        // Fitur terproteksi wajib memenuhi relasi <<include>> Login
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/lapor/step-1')->assertRedirect('/login');
        $this->get('/admin/complaints')->assertRedirect('/login');
        $this->get('/admin/categories')->assertRedirect('/login');
    }

    // =========================================================================
    // TC03: PANTAU STATUS LAPORAN BERDASARKAN KODE REGISTRASI (Masyarakat / Publik)
    // =========================================================================

    public function test_tc03_positif_masyarakat_memantau_status_dengan_kode_valid(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-2026-TEST01',
            'what' => 'Terjadi pungutan liar layanan publik pada dinas perizinan terpadu',
            'who' => 'Oknum staf loket pelayanan terpadu',
            'where_location' => 'Kantor Pelayanan Terpadu Satu Pintu Kota Gorontalo',
            'when_time' => '28 Oktober 2026 pukul 09:30 WITA',
            'why' => 'Mempercepat antrean penerbitan surat izin usaha',
            'how' => 'Meminta biaya tambahan tanpa bukti setor resmi perbankan daerah',
            'status' => 'menunggu',
        ]);

        // 1. Pencarian via form submit cek-status
        $searchResponse = $this->post('/cek-status', [
            'token' => $complaint->token,
        ]);
        $searchResponse->assertRedirect(route('status.show', $complaint->token));

        // 2. Akses halaman status publik
        $showResponse = $this->get('/status/' . $complaint->token);
        $showResponse->assertStatus(200);
        $showResponse->assertSee($complaint->token);
    }

    public function test_tc03_negatif_pantau_status_dengan_kode_tidak_terdaftar(): void
    {
        $response = $this->post('/cek-status', [
            'token' => 'TIKET-TIDAK-VALID-999',
        ]);

        $response->assertRedirect(route('status.index'));
        $response->assertSessionHas('error');

        // Akses langsung kode fiktif menghasilkan 404
        $this->get('/status/TIKET-TIDAK-VALID-999')->assertStatus(404);
    }

    // =========================================================================
    // TC04: MEMBUAT LAPORAN PENGADUAN 5W+1H (Aktor: Masyarakat)
    // =========================================================================

    public function test_tc04_positif_masyarakat_membuat_laporan_pengaduan_5w1h(): void
    {
        Storage::fake('local');

        $step1Payload = [
            'category_id' => $this->category->id,
            'what' => 'Penyalahgunaan anggaran kegiatan daerah pada renovasi gedung dinas',
            'who' => 'Pejabat Pembuat Komitmen dan staf bendahara dinas',
            'where_location' => 'Dinas Pendidikan dan Kebudayaan Kota Gorontalo',
            'when_time' => '15 Oktober 2026 pada tahapan pencairan belanja modal',
            'why' => 'Diduga terjadi manipulasi spesifikasi volume material fisik',
            'how' => 'Mengubah spesifikasi teknis pada dokumen kontrak adendum tanpa uji teknis',
        ];

        // Step 1: Validasi form 5W+1H dan simpan ke session
        $step1Response = $this->actingAs($this->masyarakat)->post('/lapor/step-1', $step1Payload);
        $step1Response->assertRedirect(route('complaint.public.step2.create'));
        $step1Response->assertSessionHas('complaint_data');

        // Step 2: Konfirmasi dan simpan ke database
        $step2Response = $this->actingAs($this->masyarakat)->post('/lapor/step-2');
        $step2Response->assertRedirect();

        $this->assertDatabaseHas('complaints', [
            'user_id' => $this->masyarakat->id,
            'what' => 'Penyalahgunaan anggaran kegiatan daerah pada renovasi gedung dinas',
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

        $response->assertSessionHasErrors([
            'category_id',
            'what',
            'who',
            'where_location',
            'when_time',
            'how',
        ]);
    }

    // =========================================================================
    // TC05: MENGAKSES LAPORAN PENGADUAN & DOKUMEN PDF (Semua Aktor)
    // =========================================================================

    public function test_tc05_positif_aktor_berwenang_mengakses_daftar_dan_pdf_laporan(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-2026-TEST02',
            'what' => 'Ketidaksesuaian laporan belanja operasional barang dan jasa kantor',
            'who' => 'Bendahara pengeluaran dinas dan verifikator internal',
            'where_location' => 'Kantor Inspektorat Daerah Kota Gorontalo',
            'when_time' => '20 Oktober 2026 pada audit kepatuhan berkala',
            'why' => 'Kelalaian pencatatan bukti kuitansi belanja dinas',
            'how' => 'Nota belanja tidak dilampirkan secara sah dan valid sesuai ketentuan',
            'status' => 'terverifikasi',
        ]);

        // 1. Masyarakat mengakses dasbor laporan miliknya
        $this->actingAs($this->masyarakat)
            ->get('/dashboard')
            ->assertStatus(200);

        // 2. Admin, Verifikator, dan Pimpinan mengakses daftar laporan internal
        foreach ([$this->admin, $this->verifikator, $this->pimpinan] as $internalActor) {
            $this->actingAs($internalActor)
                ->get('/admin/complaints')
                ->assertStatus(200);
        }

        // 3. Akses unduh PDF resmi (status terverifikasi dapat diunduh)
        $pdfResponse = $this->actingAs($this->admin)->get("/complaints/{$complaint->id}/pdf");
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
            'token' => 'TIKET-2026-TEST03',
            'what' => 'Pelanggaran prosedur standar pelayanan perizinan lingkungan',
            'who' => 'Staf administrasi loket pelayanan terpadu',
            'where_location' => 'Bagian Umum Sekretariat Daerah Kota Gorontalo',
            'when_time' => '25 Oktober 2026 saat jam operasional kantor',
            'why' => 'Dokumen pemohon ditahan tanpa alasan dan dasar hukum jelas',
            'how' => 'Berkas permohonan tidak diproses melebihi batas waktu standar SOP',
            'status' => 'menunggu',
        ]);

        // Admin melakukan verifikasi administratif: 'menunggu' -> 'diproses' (diteruskan ke Verifikator)
        $response = $this->actingAs($this->admin)->put("/admin/complaints/{$complaint->id}", [
            'status' => 'diproses',
            'note' => 'Berkas administratif lengkap dan memenuhi syarat untuk ditelaah Verifikator.',
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
            'token' => 'TIKET-2026-TEST04',
            'what' => 'Uji proteksi verifikasi administratif laporan pengaduan',
            'who' => 'Pihak terlapor dalam pengujian',
            'where_location' => 'Lokasi uji coba sistem proteksi',
            'when_time' => '26 Oktober 2026 waktu setempat',
            'why' => 'Pengujian hak akses peran',
            'how' => 'Mencoba mengubah status tanpa hak otorisasi yang sah',
            'status' => 'menunggu',
        ]);

        // Masyarakat tidak diizinkan mengubah status laporan di panel admin
        $this->actingAs($this->masyarakat)
            ->put("/admin/complaints/{$complaint->id}", [
                'status' => 'diproses',
            ])
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
            'token' => 'TIKET-2026-TEST05',
            'what' => 'Indikasi penyimpangan prosedur pengadaan alat laboratorium sekolah',
            'who' => 'Panitia pengadaan barang dan penyedia rekanan',
            'where_location' => 'Unit Layanan Pengadaan Barang dan Jasa Pemerintah Kota',
            'when_time' => '27 Oktober 2026 tahapan pembuktian kualifikasi teknis',
            'why' => 'Mengarahkan pemenang lelang pada rekanan terafiliasi',
            'how' => 'Persyaratan lelang dibuat mengunci spesifikasi satu distributor tunggal',
            'status' => 'diproses',
        ]);

        // Verifikator menelaah laporan berstatus 'diproses' -> 'terverifikasi' dengan catatan verifikasi
        $response = $this->actingAs($this->verifikator)->put("/admin/complaints/{$complaint->id}", [
            'status' => 'terverifikasi',
            'note' => 'Laporan memenuhi seluruh unsur 5W1H dan bukti awal dinyatakan lengkap.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('complaints', [
            'id' => $complaint->id,
            'status' => 'terverifikasi',
        ]);
        $this->assertDatabaseHas('responses', [
            'complaint_id' => $complaint->id,
            'user_id' => $this->verifikator->id,
            'content' => 'Laporan memenuhi seluruh unsur 5W1H dan bukti awal dinyatakan lengkap.',
        ]);
    }

    public function test_tc07_negatif_verifikator_gagal_menyimpan_catatan_kosong(): void
    {
        $complaint = Complaint::create([
            'user_id' => $this->masyarakat->id,
            'category_id' => $this->category->id,
            'token' => 'TIKET-2026-TEST06',
            'what' => 'Pengujian validasi status pembaruan laporan pengaduan',
            'who' => 'Pihak terlapor dalam pengujian',
            'where_location' => 'Lokasi dinas pengujian sistem',
            'when_time' => '28 Oktober 2026 waktu setempat',
            'why' => 'Pengujian integritas validasi form status',
            'how' => 'Mengosongkan parameter status yang wajib diisi',
            'status' => 'diproses',
        ]);

        // Status wajib diisi dalam form pembaruan status pengaduan
        $response = $this->actingAs($this->verifikator)->put("/admin/complaints/{$complaint->id}", [
            'status' => '',
        ]);

        $response->assertSessionHasErrors('status');
    }

    // =========================================================================
    // TC08: KELOLA DATA MASTER (Aktor: Admin)
    // =========================================================================

    public function test_tc08_positif_admin_mengelola_data_master_kategori_dan_pengguna(): void
    {
        // 1. Tambah Kategori Baru oleh Admin
        $categoryResponse = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => 'Tindak Pidana Korupsi Baru',
        ]);

        $categoryResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('categories', [
            'name' => 'Tindak Pidana Korupsi Baru',
        ]);

        // 2. Tambah Pengguna Baru oleh Admin dengan single-role dropdown
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

        $newUser = User::where('email', 'verifikator.baru@example.com')->first();
        $this->assertNotNull($newUser);
        $this->assertTrue($newUser->hasRole('verifikator'));
    }

    public function test_tc08_negatif_kelola_data_master_gagal_jika_input_kosong(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }
}
