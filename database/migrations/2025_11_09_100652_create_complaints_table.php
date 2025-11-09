<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users'); // Dibuat nullable
            $table->foreignId('category_id')->constrained('categories');

            // === Kolom untuk Biodata (dari Step 1) ===
            $table->string('nama_pelapor');
            $table->string('email_pelapor');
            $table->string('telepon_pelapor');
            // Tambahkan biodata lain jika perlu (mis: NIK, Alamat)

            // === Kolom untuk Pengaduan (dari Step 2) ===
            $table->string('title');
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->enum('status', ['pending', 'processed', 'finished', 'rejected'])->default('pending');
            // === Kolom untuk Pengecekan Status (Poin 3) ===
            $table->string('token')->unique(); // Sangat penting

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
