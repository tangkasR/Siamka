<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Matematika',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Bahasa Indonesia',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Kimia',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Sejarah',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Biologi',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Seni Budaya',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Informatika',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Agama',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Bahasa Inggris',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Geografi',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Sosiologi',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Ekonomi',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'PPKN',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Olahraga',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Kewirausahaan',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Matematika Lanjut',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Kimia Lanjut',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Bahasa Ingris Lanjut',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Biologi Lanjut',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Ekonomi Lanjut',
        ]);
        MataPelajaran::create([
            'nama_mata_pelajaran' => 'Informatika Lanjut',
        ]);
    }
}
