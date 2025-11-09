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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();

            // Relasi ke Complaint (Disempurnakan)
            // onDelete('cascade') berarti jika pengaduan dihapus, tanggapannya ikut terhapus.
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');

            // Relasi ke User (Petugas) (Disempurnakan)
            // onDelete('set null') berarti jika petugas dihapus, tanggapannya tetap ada
            // tapi user_id nya jadi NULL.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->text('content'); // 'content' sudah benar

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
