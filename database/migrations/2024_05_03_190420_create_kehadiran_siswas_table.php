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
        Schema::create('kehadiran_siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('kehadiran_id');
            $table->foreign('kehadiran_id')->references('id')->on('kehadirans')->onDelete('restrict');
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('restrict');
            $table->String('kehadiran')->nullable();
            $table->String('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran_siswa');
    }
};
