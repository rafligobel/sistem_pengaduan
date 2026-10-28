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

        // 1. Buat / Ambil Roles (firstOrCreate agar tidak error jika sudah ada)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolePetugas = Role::firstOrCreate(['name' => 'petugas']);
        $roleWalikota = Role::firstOrCreate(['name' => 'walikota']); // Sebelumnya kepala_instansi
        $roleMasyarakat = Role::firstOrCreate(['name' => 'masyarakat']);

        // 2. Buat / Ambil Permissions (Hak Akses Granular)
        $permissions = [
            'view_complaints',
            'verify_complaints',
            'resolve_complaints',
            'delete_complaints',
            'manage_master',
            'manage_documentation',
            'manage_system',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 3. Assign Permissions ke Role
        // ADMIN: Mengatur hampir semua, TAPI untuk workflow laporan dia fokus di finishing (resolve) + Manajerial
        $roleAdmin->syncPermissions([
            'view_complaints',
            'resolve_complaints', // Eksekusi Akhir
            'delete_complaints',
            'manage_master',
            'manage_documentation',
            'manage_system',
        ]);

        // PETUGAS: Verifikasi Laporan
        $rolePetugas->syncPermissions([
            'view_complaints',
            'verify_complaints'
        ]);

        // WALIKOTA : Hanya Mengawasi (View Only)
        $roleWalikota->syncPermissions(['view_complaints']);

        // Masyarakat: Tidak butuh permission khusus dari server side ini (logic terpisah), 
        // tapi jika mau strict bisa tambah 'create_complaint'. Untuk saat ini skip agar simple.

        // 2. Buat / Ambil User Admin Default
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->syncRoles([$roleAdmin]);

        // 3. Buat / Ambil User Petugas Default
        $petugasUser = User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'name' => 'Petugas',
                'password' => Hash::make('password'),
            ]
        );
        $petugasUser->syncRoles([$rolePetugas]);

        // 4. Buat / Ambil User Masyarakat Default (Opsional, untuk tes)
        $wargaUser = User::firstOrCreate(
            ['email' => 'warga@example.com'],
            [
                'name' => 'Masyarakat Contoh',
                'password' => Hash::make('password'),
            ]
        );
        $wargaUser->syncRoles([$roleMasyarakat]);
    }
}
