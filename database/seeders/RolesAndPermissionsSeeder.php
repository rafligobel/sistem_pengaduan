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

        // 1. Buat Roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePetugas = Role::create(['name' => 'petugas']);
        $roleWalikota = Role::create(['name' => 'walikota']); // Sebelumnya kepala_instansi
        $roleMasyarakat = Role::create(['name' => 'masyarakat']);

        // 2. Buat Permissions (Hak Akses Granular)
        // Laporan
        Permission::create(['name' => 'view_complaints']);
        Permission::create(['name' => 'verify_complaints']); // Petugas: Pending -> Process
        Permission::create(['name' => 'resolve_complaints']); // Admin: Process -> Finish
        Permission::create(['name' => 'delete_complaints']); 
        
        // Manajemen
        Permission::create(['name' => 'manage_master']); // User management, config
        Permission::create(['name' => 'manage_documentation']); // Gallery
        Permission::create(['name' => 'manage_system']); // Backup, Restore, Logs (Simulasi)

        // 3. Assign Permissions ke Role
        
        // ADMIN: Mengatur hampir semua, TAPI untuk workflow laporan dia fokus di finishing (resolve) + Manajerial
        $roleAdmin->givePermissionTo([
            'view_complaints',
            'resolve_complaints', // Eksekusi Akhir
            'delete_complaints',
            'manage_master',
            'manage_documentation',
            'manage_system',
        ]);

        // PETUGAS: Verifikasi Laporan
        $rolePetugas->givePermissionTo([
            'view_complaints',
            'verify_complaints'
        ]);

        // WALIKOTA : Hanya Mengawasi (View Only)
        $roleWalikota->givePermissionTo(['view_complaints']);

        // Masyarakat: Tidak butuh permission khusus dari server side ini (logic terpisah), 
        // tapi jika mau strict bisa tambah 'create_complaint'. Untuk saat ini skip agar simple.

        // 2. Buat User Admin Default
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->assignRole($roleAdmin);

        // 3. Buat User Petugas Default
        $petugasUser = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
        ]);
        $petugasUser->assignRole($rolePetugas);

        // 4. Buat User Masyarakat Default (Opsional, untuk tes)
        $wargaUser = User::create([
            'name' => 'Masyarakat Contoh',
            'email' => 'warga@example.com',
            'password' => Hash::make('password'),
        ]);
        $wargaUser->assignRole($roleMasyarakat);
    }
}
