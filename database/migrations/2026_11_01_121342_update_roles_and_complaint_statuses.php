<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ubah default status dan perbarui data status lama di tabel complaints
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('menunggu')->change();
        });

        DB::table('complaints')->where('status', 'pending')->update(['status' => 'menunggu']);
        DB::table('complaints')->where('status', 'proses')->update(['status' => 'diproses']);
        DB::table('complaints')->where('status', 'selesai')->update(['status' => 'terverifikasi']);

        // 2. Reset cache Spatie Permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 3. Buat/Update 4 Role Resmi: pengguna, admin, tim khusus, pimpinan
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $rolePengguna = Role::firstOrCreate(['name' => 'pengguna', 'guard_name' => 'web']);
        $roleTimKhusus = Role::firstOrCreate(['name' => 'tim khusus', 'guard_name' => 'web']);
        $rolePimpinan = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);

        // Migrasi relasi user dari role lama ke role baru jika role lama ada
        $oldMasyarakat = Role::where('name', 'masyarakat')->first();
        if ($oldMasyarakat) {
            DB::table('model_has_roles')
                ->where('role_id', $oldMasyarakat->id)
                ->update(['role_id' => $rolePengguna->id]);
        }

        $oldPetugas = Role::where('name', 'petugas')->first();
        if ($oldPetugas) {
            DB::table('model_has_roles')
                ->where('role_id', $oldPetugas->id)
                ->update(['role_id' => $roleTimKhusus->id]);
        }

        $oldWalikota = Role::where('name', 'walikota')->first();
        if ($oldWalikota) {
            DB::table('model_has_roles')
                ->where('role_id', $oldWalikota->id)
                ->update(['role_id' => $rolePimpinan->id]);
        }

        // 4. Buat Permissions
        $permissions = [
            'view_complaints',
            'process_complaints',  // Admin: proses/teruskan ke tim khusus atau tolak
            'verify_complaints',   // Tim Khusus: verifikasi atau tolak
            'respond_complaints',  // Admin: menanggapi laporan
            'delete_complaints',   // Admin: hapus laporan
            'manage_master',       // Admin: kategori & user
            'manage_documentation',// Admin: galeri & berita
            'manage_system',       // Admin: sistem
        ];

        foreach ($permissions as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        // 5. Sinkronisasi Hak Akses (Permissions) per Role:
        // ADMIN: Mengelola sistem secara menyeluruh, menerima laporan, tolak/proses, dan menanggapi laporan
        $roleAdmin->syncPermissions([
            'view_complaints',
            'process_complaints',
            'verify_complaints',
            'respond_complaints',
            'delete_complaints',
            'manage_master',
            'manage_documentation',
            'manage_system',
        ]);

        // TIM KHUSUS: Menerima laporan yang diteruskan admin, tolak atau verifikasi
        $roleTimKhusus->syncPermissions([
            'view_complaints',
            'verify_complaints',
        ]);

        // PIMPINAN: Hanya bisa melihat seluruh bentuk laporan pengaduan
        $rolePimpinan->syncPermissions([
            'view_complaints',
        ]);

        // PENGGUNA: Akses frontend untuk membuat & memantau laporan sendiri
        $rolePengguna->syncPermissions([]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });

        DB::table('complaints')->where('status', 'menunggu')->update(['status' => 'pending']);
        DB::table('complaints')->where('status', 'diproses')->update(['status' => 'proses']);
        DB::table('complaints')->where('status', 'terverifikasi')->update(['status' => 'selesai']);
    }
};
