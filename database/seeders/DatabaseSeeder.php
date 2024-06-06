<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\AdminSeeder;
use Database\Seeders\GuruSeeder;
use Database\Seeders\MapelSeeder;
use Database\Seeders\RombelSeeder;
use Database\Seeders\RuanganSeeder;
use Database\Seeders\SesiSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(RuanganSeeder::class);
        $this->call(SesiSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(RombelSeeder::class);
    }
}
