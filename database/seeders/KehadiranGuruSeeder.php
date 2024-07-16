<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\KehadiranGuru;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KehadiranGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // 2021-2022 semester ganjil
        // $tahun_ajaran_id = 1;
        // $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // $faker = Faker::create();

        // foreach ($gurus as $guru) {
        //     for ($i = 0; $i < 100; $i++) {
        //         $tanggal = $faker->dateTimeBetween('2021-07-01', '2021-12-31')->format('Y-m-d');

        //         // Generate random times for jam_masuk and jam_keluar
        //         $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
        //         $jamKeluar = $faker->dateTimeBetween('16:00:00', '20:00:00')->format('H:i:s');

        //         // Ensure jam_keluar is after jam_masuk
        //         if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
        //             $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
        //         }

        //         $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

        //         KehadiranGuru::create([
        //             'guru_id' => $guru->id,
        //             'tahun_ajaran_id' => $tahun_ajaran_id,
        //             'kehadiran' => 'hadir',
        //             'tanggal' => $tanggal,
        //             'jam_masuk' => $jamMasuk,
        //             'jam_keluar' => $jamKeluar,
        //             'total_jam' => $totalJam,
        //         ]);
        //     }
        // }

        // // 2021-2022 semester genap
        // $tahun_ajaran_id = 2;
        // $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // $faker = Faker::create();

        // foreach ($gurus as $guru) {
        //     for ($i = 0; $i < 50; $i++) {
        //         $tanggal = $faker->dateTimeBetween('2022-01-01', '2022-06-20')->format('Y-m-d');

        //         // Generate random times for jam_masuk and jam_keluar
        //         $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
        //         $jamKeluar = $faker->dateTimeBetween('16:00:00', '18:00:00')->format('H:i:s');

        //         // Ensure jam_keluar is after jam_masuk
        //         if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
        //             $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
        //         }

        //         $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

        //         KehadiranGuru::create([
        //             'guru_id' => $guru->id,
        //             'tahun_ajaran_id' => $tahun_ajaran_id,
        //             'kehadiran' => 'hadir',
        //             'tanggal' => $tanggal,
        //             'jam_masuk' => $jamMasuk,
        //             'jam_keluar' => $jamKeluar,
        //             'total_jam' => $totalJam,
        //         ]);
        //     }
        // }

        // // 2022-2023 semester ganjil
        // $tahun_ajaran_id = 3;
        // $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // $faker = Faker::create();

        // foreach ($gurus as $guru) {
        //     for ($i = 0; $i < 50; $i++) {
        //         $tanggal = $faker->dateTimeBetween('2022-07-01', '2022-12-31')->format('Y-m-d');

        //         // Generate random times for jam_masuk and jam_keluar
        //         $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
        //         $jamKeluar = $faker->dateTimeBetween('16:00:00', '18:00:00')->format('H:i:s');

        //         // Ensure jam_keluar is after jam_masuk
        //         if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
        //             $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
        //         }

        //         $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

        //         KehadiranGuru::create([
        //             'guru_id' => $guru->id,
        //             'tahun_ajaran_id' => $tahun_ajaran_id,
        //             'kehadiran' => 'hadir',
        //             'tanggal' => $tanggal,
        //             'jam_masuk' => $jamMasuk,
        //             'jam_keluar' => $jamKeluar,
        //             'total_jam' => $totalJam,
        //         ]);
        //     }
        // }

        // 2022-2023 semester genap
        $tahun_ajaran_id = 4;
        $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $faker = Faker::create();

        foreach ($gurus as $guru) {
            for ($i = 0; $i < 50; $i++) {
                $tanggal = $faker->dateTimeBetween('2023-01-01', '2023-06-31')->format('Y-m-d');

                // Generate random times for jam_masuk and jam_keluar
                $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
                $jamKeluar = $faker->dateTimeBetween('16:00:00', '18:00:00')->format('H:i:s');

                // Ensure jam_keluar is after jam_masuk
                if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
                    $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
                }

                $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

                KehadiranGuru::create([
                    'guru_id' => $guru->id,
                    'tahun_ajaran_id' => $tahun_ajaran_id,
                    'kehadiran' => 'hadir',
                    'tanggal' => $tanggal,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'total_jam' => $totalJam,
                ]);
            }
        }

        // // 2023-2024 semester ganjil
        // $tahun_ajaran_id = 5;
        // $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // $faker = Faker::create();

        // foreach ($gurus as $guru) {
        //     for ($i = 0; $i < 50; $i++) {
        //         $tanggal = $faker->dateTimeBetween('2023-07-01', '2023-12-31')->format('Y-m-d');

        //         // Generate random times for jam_masuk and jam_keluar
        //         $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
        //         $jamKeluar = $faker->dateTimeBetween('16:00:00', '18:00:00')->format('H:i:s');

        //         // Ensure jam_keluar is after jam_masuk
        //         if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
        //             $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
        //         }

        //         $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

        //         KehadiranGuru::create([
        //             'guru_id' => $guru->id,
        //             'tahun_ajaran_id' => $tahun_ajaran_id,
        //             'kehadiran' => 'hadir',
        //             'tanggal' => $tanggal,
        //             'jam_masuk' => $jamMasuk,
        //             'jam_keluar' => $jamKeluar,
        //             'total_jam' => $totalJam,
        //         ]);
        //     }
        // }

        // // 2023-2024 semester genap
        // $tahun_ajaran_id = 6;
        // $gurus = Guru::where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // $faker = Faker::create();

        // foreach ($gurus as $guru) {
        //     for ($i = 0; $i < 50; $i++) {
        //         $tanggal = $faker->dateTimeBetween('2024-01-01', '2024-05-31')->format('Y-m-d');

        //         // Generate random times for jam_masuk and jam_keluar
        //         $jamMasuk = $faker->dateTimeBetween('07:00:00', '09:00:00')->format('H:i:s');
        //         $jamKeluar = $faker->dateTimeBetween('16:00:00', '18:00:00')->format('H:i:s');

        //         // Ensure jam_keluar is after jam_masuk
        //         if (strtotime($jamKeluar) <= strtotime($jamMasuk)) {
        //             $jamKeluar = date('H:i:s', strtotime($jamMasuk) + 8 * 3600); // Add 8 hours
        //         }

        //         $totalJam = (strtotime($jamKeluar) - strtotime($jamMasuk)) / 3600; // Convert seconds to hours

        //         KehadiranGuru::create([
        //             'guru_id' => $guru->id,
        //             'tahun_ajaran_id' => $tahun_ajaran_id,
        //             'kehadiran' => 'hadir',
        //             'tanggal' => $tanggal,
        //             'jam_masuk' => $jamMasuk,
        //             'jam_keluar' => $jamKeluar,
        //             'total_jam' => $totalJam,
        //         ]);
        //     }
        // }
    }
}
