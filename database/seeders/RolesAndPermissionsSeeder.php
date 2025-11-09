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

        // 1. Buat Roles sesuai kebutuhan di web.php
        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePetugas = Role::create(['name' => 'petugas']);
        $roleKepala = Role::create(['name' => 'kepala_instansi']);

        // (Opsional) Buat Permissions jika Anda ingin lebih detail
        // Contoh: Permission::create(['name' => 'tanggapi pengaduan']);
        // $rolePetugas->givePermissionTo('tanggapi pengaduan');
        // $roleAdmin->givePermissionTo('tanggapi pengaduan');
        // $roleAdmin->givePermissionTo('manage users');

        // 2. Buat User Admin Default
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman
        ]);

        // 3. Tetapkan role 'admin' ke user tersebut
        $adminUser->assignRole($roleAdmin);

        // (Opsional) Buat User Petugas Default
        $petugasUser = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
        ]);
        $petugasUser->assignRole($rolePetugas);
    }
}
