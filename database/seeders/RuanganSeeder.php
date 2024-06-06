<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'nomor_ruangan' => '1',
        ]);
        Ruangan::create([
            'nomor_ruangan' => '2',
        ]);
        Ruangan::create([
            'nomor_ruangan' => '3',
        ]);
        Ruangan::create([
            'nomor_ruangan' => '4',
        ]);
        Ruangan::create([
            'nomor_ruangan' => '5',
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'Lab-1',
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'Lab-2',
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'Lab-3',
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'Lab-4',
        ]);
        Ruangan::create([
            'nomor_ruangan' => 'Lab-5',
        ]);
    }
}
