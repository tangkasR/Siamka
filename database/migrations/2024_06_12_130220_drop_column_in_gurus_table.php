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
        // drop the keys
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropForeign(['mata_pelajaran_id']);
        });

        // drop the actual columns
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('mata_pelajaran_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            //
        });
    }
};
