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
        Schema::create('rukun_wargas', function (Blueprint $table) {
            // Primary Key
            $table->id('id_rukunwarga'); // Kolom id otomatis dibuat sebagai primary key

            // Foreign Keys
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_desa');
            $table->foreign('id_desa')->references('id_desa')->on('desas')
                ->onDelete('restrict') // Jika desa dihapus, tidak boleh menghapus rukun warga
                ->onUpdate('cascade');

            // Data Rukun Warga
            $table->string('nama'); // Nama rukun warga
            $table->string('nama_wilayah'); // Nama wilayah
            $table->integer('no'); // Nomor urut

            // Timestamps (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rukun_warga');
    }
};
