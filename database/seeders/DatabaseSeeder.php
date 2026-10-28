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

        // Kategori Pengaduan Tindak Pidana Korupsi (UU Tipikor + Tidak Diketahui)
        $kategoriKorupsi = [
            'Kerugian Keuangan Negara',
            'Suap-menyuap',
            'Penggelapan dalam Jabatan',
            'Pemerasan',
            'Perbuatan Curang',
            'Benturan Kepentingan dalam Pengadaan',
            'Gratifikasi',
            'Tidak Diketahui',
        ];

        // Masukkan ke dalam database (jika belum ada)
        foreach ($kategoriKorupsi as $category) {
            \App\Models\Category::firstOrCreate(['name' => $category]);
        }

        // (Opsional) Buat 10 user 'test'
        // User::factory(10)->create();

        // (Opsional) Buat data 'test' untuk factory user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
