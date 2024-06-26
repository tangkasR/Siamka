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

        // Default data for 6 semesters
        $defaultData = [0, 0, 0, 0, 0, 0, 0];

        if ($user) {
            // Get UTS and UAS data
            $utsData = $this->nilai->getDataUts_chart($user->nis);
            $uasData = $this->nilai->getDataUas_chart($user->nis);

            // Ensure $utsData and $uasData are arrays with default values for missing semesters
            $utsData = is_array($utsData) ? array_replace($defaultData, $utsData) : $defaultData;
            $uasData = is_array($uasData) ? array_replace($defaultData, $uasData) : $defaultData;

            return $this->chart->areaChart()
                ->setTitle('Pencapaian Nilai Mata Pelajaran')
                ->setSubtitle('Rata-Rata UTS dan UAS')
                ->addData('UTS', $utsData)
                ->addData('UAS', $uasData)
                ->setXAxis([
                    '',
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
