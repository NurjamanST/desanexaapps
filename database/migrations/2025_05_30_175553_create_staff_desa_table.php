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
        Schema::create('staff_desas', function (Blueprint $table) {
            // Primary Key
            $table->id('id_staff'); // Kolom id otomatis dibuat sebagai primary key

            // Foreign Keys
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_desa');
            $table->foreign('id_desa')->references('id_desa')->on('desas')
                ->onDelete('restrict') // Jika desa dihapus, tidak boleh menghapus staff
                ->onUpdate('cascade'); // Jika ID desa diganti, update juga di kolom ini

            // Data Staff
            $table->string('nama'); // Nama staff
            $table->string('jabatan'); // Jabatan staff

            // Timestamps (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_desa');
    }
};
