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
        Schema::create('submissionrequirements', function (Blueprint $table) {
            // Primary Key
            $table->id('id_subreq');
            // Foreign Keys
            $table->unsignedBigInteger('id_penduduk');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduks')
                ->onDelete('restrict') // Jika penduduk dihapus, tidak boleh menghapus subdoc
                ->onUpdate('cascade');
            // nama persyaratan
            $table->string('name'); // KTP, KK, dll
            // File Persyaratan
            $table->text('file_persyaratan')->nullable(); // File Persyaratan -> File 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissionrequirements');
    }
};
