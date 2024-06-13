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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nis', 20)->unique();
            $table->string('nisn', 20)->unique();
            $table->string('nomor_id', 20)->unique();
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 5);
            $table->string('nik', 20);
            $table->string('tempat_tanggal_lahir', 100);
            $table->string('alamat', 100);
            $table->string('no_hp', 30);
            $table->string('kompetensi_keahlian', 30);
            $table->string('agama', 20);
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->string('pekerjaan_orang_tua', 100);
            $table->string('no_hp_orang_tua', 30);
            $table->string('asal_smp', 100);
            $table->string('tahun_lulus_smp', 10);
            $table->string('username', 20)->unique();
            $table->string('password', 20);
            $table->string('status_siswa', 20);
            $table->string('aktivasi_akun', 20);
            $table->string('profil', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
