<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Tepat 4 Roles Resmi
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $roleMasyarakat = Role::firstOrCreate(['name' => 'masyarakat', 'guard_name' => 'web']);
        $roleVerifikator = Role::firstOrCreate(['name' => 'verifikator', 'guard_name' => 'web']);
        $rolePimpinan = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);

        // 2. Buat Permissions (Hak Akses Granular)
        $permissions = [
            'view_complaints',      // Melihat daftar dan detail laporan
            'process_complaints',   // Admin: tolak atau proses (teruskan ke verifikator)
            'verify_complaints',    // Verifikator: tolak atau verifikasi
            'respond_complaints',   // Admin: menanggapi laporan
            'delete_complaints',    // Admin: menghapus laporan
            'manage_master',        // Admin: kelola kategori & user
            'manage_documentation', // Admin: dokumentasi galeri & berita
            'manage_system',        // Admin: backup & optimasi sistem
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // 3. Assign Permissions ke 4 Role:
        // _admin: mengelola sistem secara menyeluruh, menerima laporan, meneruskan laporan, tolak/proses, menanggapi
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

        // _verifikator: menerima laporan yang diteruskan admin, tolak atau verifikasi jika lolos
        $roleVerifikator->syncPermissions([
            'view_complaints',
            'verify_complaints',
        ]);

        // _pimpinan: hanya bisa melihat seluruh bentuk laporan pengaduan
        $rolePimpinan->syncPermissions([
            'view_complaints',
        ]);

        // _masyarakat: pelapor pengaduan (membuat & memantau pengaduan)
        $roleMasyarakat->syncPermissions([]);

        // 4. Default Accounts (Opsional)
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->syncRoles([$roleAdmin]);

        $verifikatorUser = User::firstOrCreate(
            ['email' => 'timkhusus@example.com'],
            [
                'name' => 'Verifikator Inspektorat',
                'password' => Hash::make('password'),
            ]
        );
        $verifikatorUser->syncRoles([$roleVerifikator]);

        $pimpinanUser = User::firstOrCreate(
            ['email' => 'pimpinan@example.com'],
            [
                'name' => 'Pimpinan Inspektorat',
                'password' => Hash::make('password'),
            ]
        );
        $pimpinanUser->syncRoles([$rolePimpinan]);

        $masyarakatUser = User::firstOrCreate(
            ['email' => 'warga@example.com'],
            [
                'name' => 'Masyarakat Contoh',
                'password' => Hash::make('password'),
            ]
        );
        $masyarakatUser->syncRoles([$roleMasyarakat]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
