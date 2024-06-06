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
        Schema::create('kehadiran_gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('restrict');
            $table->string('kehadiran', 100);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran_gurus');
    }
};
