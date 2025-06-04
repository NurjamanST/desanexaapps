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
        Schema::create('desas', function (Blueprint $table) {
            $table->id('id_desa');
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->string('nama_lurah_desa');
            $table->string('kecamatan');
            $table->string('kota_kabupaten');
            $table->string('provinsi');
            $table->string('nama_kepdes')->nullable();
            $table->string('ttd_kepdes')->nullable();
            $table->string('nama_sekdes')->nullable();
            $table->string('ttd_sekdes')->nullable();
            $table->string('logo_desa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
