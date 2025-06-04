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
        Schema::create('laporan_penduduk', function (Blueprint $table) {
            // Primary Key
            $table->id('id_laporan'); // Kolom id otomatis dibuat sebagai primary key

            // Foreign Key
            $table->unsignedBigInteger('id_penduduk');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduks')
                ->onDelete('restrict') // Jika penduduk dihapus, tidak boleh menghapus laporan
                ->onUpdate('cascade');

            // Data Laporan
            $table->date('tanggal_laporan'); // Tanggal pelaporan
            $table->string('nama_laporan'); // Nama laporan
            $table->text('bukti_laporan')->nullable(); // Bukti laporan (opsional)

            // Timestamps (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penduduk');
    }
};
