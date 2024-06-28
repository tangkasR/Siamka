<?php

namespace App\Console\Commands;

use App\Models\KehadiranGuru;
use App\Services\DateService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyAbsenKeluar extends Command
{
    protected $date, $kehadiran_guru;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-absen-keluar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function __construct(DateService $date, KehadiranGuru $kehadiran_guru)
    {
        parent::__construct();
        $this->date = $date;
        $this->kehadiran_guru = $kehadiran_guru;
    }

    public function handle()
    {
        $tanggal = $this->date->getDate();

        $jam_keluar = Carbon::now()->setTime(17, 0, 0);
        $kehadiran_gurus = $this->kehadiran_guru->where('tanggal', $tanggal)->get();
        foreach ($kehadiran_gurus as $data) {
            if ($data->total_jam == 0) {
                $jam_masuk = Carbon::parse($data->jam_masuk);
                $total_jam = $jam_keluar->diffInMinutes($jam_masuk);
                $total_jam_in_hours = $jam_keluar->diffInHours($jam_masuk) + ($jam_keluar->diffInMinutes($jam_masuk) % 60) / 60;
                $total_jam_formatted = number_format($total_jam_in_hours, 2);
                $this->kehadiran_guru->where('id', $data->id)->update([
                    'jam_keluar' => $jam_keluar,
                    'total_jam' => $total_jam_formatted,
                ]);
            }
        }
        return 0;
    }
}
