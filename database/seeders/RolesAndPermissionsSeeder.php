<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // <-- INI WAJIB ADA
use App\Models\User;                 // <-- INI JUGA WAJIB ADA

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat role Admin
        $adminRole = Role::create(['name' => 'admin']);
        // Buat role lain
        Role::create(['name' => 'petugas']);
        Role::create(['name' => 'kepala_instansi']);

        // Buat user admin default
        $adminUser = User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        // Berikan role 'admin' ke user tersebut
        $adminUser->assignRole($adminRole);
    }
}
