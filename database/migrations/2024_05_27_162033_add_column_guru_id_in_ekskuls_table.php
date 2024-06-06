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
        Schema::table('ekskuls', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_id')->after('id');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('restrict');
            $table->string('status')->after('nama_ekskul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekskuls', function (Blueprint $table) {
            $table->dropColumn('guru_id');
        });
    }
};
