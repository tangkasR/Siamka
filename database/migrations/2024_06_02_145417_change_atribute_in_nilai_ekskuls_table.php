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
        Schema::table('nilai_ekskuls', function (Blueprint $table) {
            $table->dropColumn('nama_ekskul');
            $table->unsignedBigInteger('ekskul_id')->after('siswa_id');
            $table->foreign('ekskul_id')->references('id')->on('ekskuls')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_ekskuls', function (Blueprint $table) {
            $table->dropForeign(['ekskul_id']);
            $table->dropColumn('ekskul_id');
        });
    }
};
