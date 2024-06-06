<?php

namespace Database\Seeders;

use App\Models\Sesi;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sesi::create([
            'nama_sesi' => '07:00-09:00',
        ]);
        Sesi::create([
            'nama_sesi' => '09:00-11:00',
        ]);
        Sesi::create([
            'nama_sesi' => '11:00-13:00',
        ]);
        Sesi::create([
            'nama_sesi' => '13:00-15:00',
        ]);
    }
}
