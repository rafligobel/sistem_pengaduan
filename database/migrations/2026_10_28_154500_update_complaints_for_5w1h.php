<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Perubahan form pengaduan sesuai Perwako 2025:
     * - Menghapus field title & content
     * - Menambahkan unsur 5W+1H (What, Who, Where, When, Why, How)
     * - Kategori tetap menggunakan category_id (7 jenis + Tidak Diketahui)
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['title', 'content']);

            // --- UNSUR 5W+1H ---
            // What (Apa) - Jenis pelanggaran yang terjadi
            $table->text('what')->after('user_id')->comment('Apa: Jenis pelanggaran yang terjadi');
            
            // Who (Siapa) - Pihak-pihak yang terlibat
            $table->text('who')->after('what')->comment('Siapa: Pihak-pihak yang terlibat');
            
            // Where (Di mana) - Lokasi terjadinya pelanggaran
            $table->text('where_location')->after('who')->comment('Di mana: Lokasi terjadinya pelanggaran');
            
            // When (Kapan) - Waktu dan kronologi pelanggaran
            $table->text('when_time')->after('where_location')->comment('Kapan: Waktu dan kronologi pelanggaran');
            
            // Why (Mengapa) - Motivasi atau latar belakang pelanggaran
            $table->text('why')->nullable()->after('when_time')->comment('Mengapa: Motivasi/latar belakang pelanggaran (opsional)');
            
            // How (Bagaimana) - Modus operandi pelanggaran
            $table->text('how')->after('why')->comment('Bagaimana: Modus operandi pelanggaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Hapus kolom 5W+1H
            $table->dropColumn(['what', 'who', 'where_location', 'when_time', 'why', 'how']);

            // Kembalikan kolom lama
            $table->string('title')->after('user_id');
            $table->text('content')->after('title');
        });
    }
};
