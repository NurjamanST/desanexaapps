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
        Schema::create('submissiondocuments', function (Blueprint $table) {
            // Primary Key
            $table->id('id_subdoc'); // Kolom id otomatis dibuat sebagai primary key

            // Tanggal Pengajuan
            $table->dateTime('tanggal_pengajuan')->nullable();

            // Foreign Keys
            $table->unsignedBigInteger('id_doctype');
            $table->foreign('id_doctype')->references('id')->on('document_types')
                ->onDelete('restrict') // Jika doctype dihapus, tidak boleh menghapus subdoc
                ->onUpdate('cascade');

            $table->unsignedBigInteger('id_penduduk');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduks')
                ->onDelete('restrict') // Jika penduduk dihapus, tidak boleh menghapus subdoc
                ->onUpdate('cascade');

            // Data Dokumen
            $table->enum('status_pengajuan', [
                'Proses Pengajuan',
                'Reject Staff Desa',
                'Diverifikasi Staff Desa',
                'Ditinjau Kepdes',
                'Accept Kepdes',
                'Reject Kepdes'
            ])->default('Proses Pengajuan'); // Status default

            $table->string('file_dokumen')->nullable(); // Path atau URL file dokumen
            $table->boolean('status_unduh')->default(false); // Ya/Tidak (false = tidak, true = ya)
            $table->text('catatan')->nullable(); // Catatan tambahan

            // Timestamps (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissiondocuments');
    }
};
