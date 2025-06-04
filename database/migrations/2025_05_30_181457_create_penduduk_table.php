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
        Schema::create('penduduks', function (Blueprint $table) {
            // Primary Key
            $table->id('id_penduduk'); // Kolom id otomatis dibuat sebagai primary key

            // Foreign Keys
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_rukunwarga')->nullable();
            $table->foreign('id_rukunwarga')->references('id_rukunwarga')->on('rukun_wargas')
                ->onDelete('set null') // Jika rukun warga dihapus, kolom ini jadi null
                ->onUpdate('cascade');

            // Data Penduduk
            $table->string('nik')->unique(); // Nomor Induk Kependudukan (unik)
            $table->string('nama'); // Nama penduduk
            $table->string('tempat_lahir'); // Tempat lahir
            $table->date('tanggal_lahir'); // Tanggal lahir
            $table->enum('kelamin', ['L', 'P']); // Jenis kelamin (L = Laki-laki, P = Perempuan)
            $table->integer('no_rt'); // Nomor RT
            $table->string('agama'); // Agama
            $table->string('status_perkawinan'); // Status perkawinan
            $table->string('pekerjaan'); // Pekerjaan
            $table->string('kewarganegaraan'); // Kewarganegaraan

            // Timestamps (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
