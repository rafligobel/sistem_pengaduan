<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Seeder Roles dan User Admin/Petugas
        $this->call(RolesAndPermissionsSeeder::class);

        // (Opsional) Seed data lain jika perlu,
        // Misalnya, membuat kategori dummy
        \App\Models\Category::factory()->create(['name' => 'Infrastruktur']);
        \App\Models\Category::factory()->create(['name' => 'Pelayanan Publik']);
        \App\Models\Category::factory()->create(['name' => 'Lingkungan']);

        // (Opsional) Buat 10 user 'test'
        // User::factory(10)->create();

        // (Opsional) Buat data 'test' untuk factory user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
