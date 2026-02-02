# Sistem Layanan Pengaduan Masyarakat (SiDumas)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

## 📖 Deskripsi Proyek

**Sistem Pengaduan Masyarakat** adalah platform berbasis web yang dirancang untuk memfasilitasi masyarakat dalam menyampaikan aspirasi, pengaduan, atau laporan kejadian kepada instansi terkait secara transparan dan akuntabel.

Sistem ini menjembatani komunikasi antara publik dan pemerintah/instansi dengan menyediakan fitur pelacakan status pengaduan (tracking), publikasi berita terkini, serta dokumentasi kegiatan melalui galeri. Dibangun dengan framework Laravel yang handal dan antarmuka modern menggunakan Tailwind CSS.

## 🚀 Fitur Utama

Aplikasi ini dibagi menjadi dua modul utama: **Public (Masyarakat)** dan **Admin/Petugas**.

### 1. Portal Masyarakat (Public)
* **Pengajuan Pengaduan:** Formulir pengaduan interaktif dengan dukungan lampiran bukti (foto/dokumen).
* **Tracking Sistem:** Fitur "Lacak Pengaduan" untuk memantau progres tindak lanjut laporan secara real-time.
* **Informasi Publik:** Akses ke berita terbaru dan galeri kegiatan instansi.
* **Cek Status:** Transparansi alur penyelesaian masalah dari 'Pending' hingga 'Selesai'.

### 2. Panel Admin & Petugas
* **Dashboard Statistik:** Ringkasan jumlah pengaduan masuk, diproses, dan selesai.
* **Manajemen Pengaduan:**
    * Validasi laporan masuk.
    * Pemberian tanggapan/respon resmi.
    * Update status pengaduan.
* **Manajemen Konten (CMS):**
    * Kelola Berita/Artikel (`NewsController`).
    * Kelola Galeri Foto (`GalleryController`).
* **Manajemen Master Data:**
    * Kategori Pengaduan (`CategoryController`).
    * Manajemen Pengguna & Role (`UserController`).
* **Pengaturan Sistem:** Konfigurasi aplikasi melalui panel admin (`SystemController`).

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel Framework (PHP)
* **Frontend:** Blade Templating, Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Breeze / Jetstream (Inferred based on routes)
* **Role Management:** Spatie Laravel Permission (Inferred from seeders structure)

## 🔐 Hak Akses (Role & Permissions)

Sistem mendukung *Multi-Role Authorization*:

1.  **Super Admin:** Akses penuh ke seluruh fitur, termasuk pengaturan sistem dan manajemen user.
2.  **Petugas:** Fokus pada validasi, verifikasi, dan memberikan tanggapan terhadap pengaduan.
3.  **Masyarakat:** User umum yang melaporkan dan memantau pengaduan mereka sendiri.

## 💻 Instalasi & Penggunaan

Ikuti langkah berikut untuk menjalankan proyek di local environment:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/sistem-pengaduan.git](https://github.com/username/sistem-pengaduan.git)
    cd sistem-pengaduan
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file konfigurasi dan atur kredensial database.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Setup Database**
    Jalankan migrasi database dan seeder untuk data awal (Roles, Permissions, Admin User).
    ```bash
    php artisan migrate --seed
    ```

5.  **Compile Assets**
    ```bash
    npm run dev
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://localhost:8000`.

## 📂 Struktur Folder Utama

* `app/Http/Controllers/Admin`: Logika untuk panel admin (Pengaduan, Berita, Galeri).
* `app/Http/Controllers/Public`: Logika untuk frontend publik.
* `app/Models`: Model data (Complaint, Response, News, Gallery).
* `resources/views/admin`: Tampilan panel dashboard.
* `resources/views/public`: Tampilan landing page dan form pengaduan.
* `routes/web.php`: Definisi seluruh rute aplikasi.

## 🤝 Kontribusi

Kontribusi sangat dihargai! Jika Anda ingin berkontribusi:
1.  Fork repositori ini.
2.  Buat branch fitur baru (`git checkout -b fitur-keren`).
3.  Commit perubahan Anda (`git commit -m 'Menambahkan fitur keren'`).
4.  Push ke branch (`git push origin fitur-keren`).
5.  Buat Pull Request.

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---
*Dibuat dengan ❤️ oleh Rafli Ananda Rizkillah Gobel*
