<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            // --- TAMBAHAN PENTING (RELASI USER) ---
            // Ini wajib ada agar relasi $user->complaints bisa berjalan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // -------------------------------------

            // Data pelapor manual (opsional jika sudah ada user_id, tapi bisa disimpan untuk backup)
            // Saya buat nullable agar tidak error jika data diambil dari user login
            $table->string('nama_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
            $table->string('telepon_pelapor')->nullable();

            // Step 2: Pengaduan
            $table->string('title');
            $table->text('content');

            // Relasi ke Kategori
            $table->foreignId('category_id')->constrained('categories');

            $table->string('attachment')->nullable();

            $table->string('token')->unique();

            $table->string('status')->default('pending'); // pending, processed, finished, rejected

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
