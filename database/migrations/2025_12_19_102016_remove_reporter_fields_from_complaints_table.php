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
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'email_pelapor', 'telepon_pelapor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('nama_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
            $table->string('telepon_pelapor')->nullable();
        });
    }
};
