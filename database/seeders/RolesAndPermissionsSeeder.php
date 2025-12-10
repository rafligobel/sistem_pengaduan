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
        $roleKepala = Role::create(['name' => 'kepala_instansi']);

        // --- TAMBAHAN PENTING ---
        $roleMasyarakat = Role::create(['name' => 'masyarakat']);
        // ------------------------

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
