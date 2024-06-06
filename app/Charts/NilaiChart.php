<?php

namespace App\Charts;

use App\Services\AuthService;
use App\Services\NilaiService;
use App\Services\SiswaService;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class NilaiChart
{
    protected $chart;
    private $nilai;
    private $auth;
    private $siswa;

    public function __construct(
        LarapexChart $chart,
        NilaiService $nilai,
        AuthService $auth,
        SiswaService $siswa
    ) {
        $this->chart = $chart;
        $this->nilai = $nilai;
        $this->auth = $auth;
        $this->siswa = $siswa;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $user = $this->auth->getUser('siswa');

        if ($user) {
            return $this->chart->areaChart()
                ->setTitle('Pencapaian Nilai')
                ->setSubtitle('Rata-Rata UTS dan UAS')
                ->addData('UTS', $this->nilai->getDataUts_chart($user->id))
                ->addData('UAS', $this->nilai->getDataUas_chart($user->id))
                ->setXAxis(['',
                    'Semester 1',
                    'Semester 2',
                    'Semester 3',
                    'Semester 4',
                    'Semester 5',
                    'Semester 6',
                ]);
        }

        return $this->chart->areaChart();

    }
}
