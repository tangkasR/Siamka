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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('restrict');
            $table->string('nama', 100);
            $table->string('jabatan', 50);
            $table->string('nomor_induk_yayasan', 50);
            $table->string('jenis_kelamin', 5);
            $table->string('tempat_tanggal_lahir', 100);
            $table->string('alamat', 100);
            $table->string('pendidikan_terakhir', 50);
            $table->string('no_hp', 20);
            $table->string('profil', 255);
            $table->string('ktp', 255);
            $table->string('ijazah', 255);
            $table->string('kartu_keluarga', 255);
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
