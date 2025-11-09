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

            // Step 1: Biodata
            $table->string('nama_pelapor');
            $table->string('email_pelapor');
            $table->string('telepon_pelapor');

            // Step 2: Pengaduan
            $table->string('title');
            $table->text('content'); // 'content' sudah benar

            // Relasi ke Kategori (Disempurnakan)
            $table->foreignId('category_id')->constrained('categories');

            $table->string('attachment')->nullable(); // Boleh kosong

            $table->string('token')->unique(); // 'token' harus unik dan di-index

            // 'status' dengan nilai default (Disempurnakan)
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
