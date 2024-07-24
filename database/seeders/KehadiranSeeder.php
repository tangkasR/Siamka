<?php

namespace Database\Seeders;

use App\Models\Kehadiran;
use App\Services\SiswaService;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $siswa;

    public function __construct(SiswaService $siswa)
    {
        $this->siswa = $siswa;
    }
    public function run(): void
    {
        // // Data siswa angkatan 21 ganjil 21-22
        // $tahun_ajaran_id = 1;
        // $rombel_id = 1;
        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 100; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2021-07-01', '2021-12-31'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 21-22
        // $tahun_ajaran_id = 1;
        // $rombel_id = 2;
        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 100; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2021-07-01', '2021-12-31'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 genap 21-22
        // $tahun_ajaran_id = 2;
        // $rombel_id = 7;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-01-01', '2022-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }
        // // Data siswa angkatan 21 genap 21-22
        // $tahun_ajaran_id = 2;
        // $rombel_id = 8;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-01-01', '2022-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        //-----------------------------------------------------------------------------------------------------------

        // // Data siswa angkatan 21 ganjil 22-23
        // $tahun_ajaran_id = 3;
        // $rombel_id = 13;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-07-01', '2022-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }
        // $tahun_ajaran_id = 3;
        // $rombel_id = 14;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-07-01', '2022-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }
        // $tahun_ajaran_id = 3;
        // $rombel_id = 15;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-07-01', '2022-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }
        // $tahun_ajaran_id = 3;
        // $rombel_id = 16;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2022-07-01', '2022-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        //-----------------------------------------------------------------------------------------------------------

        // // Data siswa angkatan 21 genap 22-23
        // $tahun_ajaran_id = 4;
        // $rombel_id = 19;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-01-01', '2023-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 genap 22-23
        // $tahun_ajaran_id = 4;
        // $rombel_id = 20;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-01-01', '2023-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 genap 22-23
        // $tahun_ajaran_id = 4;
        // $rombel_id = 21;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-01-01', '2023-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 genap 22-23
        // $tahun_ajaran_id = 4;
        // $rombel_id = 22;

        // // Data siswa angkatan 21 genap

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-01-01', '2023-06-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        //-----------------------------------------------------------------------------------------------------------

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 25;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 26;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 27;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 28;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 29;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        // // Data siswa angkatan 21 ganjil 23-24
        // $tahun_ajaran_id = 5;
        // $rombel_id = 30;

        // // Data siswa angkatan 21 ganjil

        // $faker = Faker::create();
        // $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        // $siswas = $this->siswa->getSiswa($rombel_id);

        // for ($i = 0; $i < 50; $i++) {
        //     // Membuat data kehadiran
        //     $kehadiran = Kehadiran::create([
        //         'rombel_id' => $rombel_id,
        //         'tahun_ajaran_id' => $tahun_ajaran_id,
        //         'tanggal' => $faker->dateTimeBetween('2023-06-01', '2023-12-20'),
        //     ]);

        //     // Melampirkan siswa dengan status acak
        //     foreach ($siswas as $siswa) {
        //         $siswa = $this->siswa->getById($siswa->id);
        //         $kehadiran->siswas()->attach($siswa, [
        //             'kehadiran' => $faker->randomElement($statusList),
        //         ]);
        //     }
        // }

        //-----------------------------------------------------------------------------------------------------------

        // Data siswa angkatan 21 genap 23-24
        $tahun_ajaran_id = 6;
        $rombel_id = 31;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 6;
        $rombel_id = 32;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 6;
        $rombel_id = 33;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 6;
        $rombel_id = 34;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 6;
        $rombel_id = 35;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 6;
        $rombel_id = 36;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-01-01', '2024-06-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
    }
        //-----------------------------------------------------------------------------------------------------------

        // Data siswa angkatan 21 genap 23-24
        $tahun_ajaran_id = 7;
        $rombel_id = 37;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 7;
        $rombel_id = 38;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 7;
        $rombel_id = 39;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 7;
        $rombel_id = 40;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 7;
        $rombel_id = 41;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
        $tahun_ajaran_id = 7;
        $rombel_id = 42;

        // Data siswa angkatan 21 genap

        $faker = Faker::create();
        $statusList = ['hadir', 'izin', 'sakit', 'alpa'];
        $siswas = $this->siswa->getSiswa($rombel_id);

        for ($i = 0; $i < 50; $i++) {
            // Membuat data kehadiran
            $kehadiran = Kehadiran::create([
                'rombel_id' => $rombel_id,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $faker->dateTimeBetween('2024-06-01', '2024-12-20'),
            ]);

            // Melampirkan siswa dengan status acak
            foreach ($siswas as $siswa) {
                $siswa = $this->siswa->getById($siswa->id);
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $faker->randomElement($statusList),
                ]);
            }
        }
    }
}
