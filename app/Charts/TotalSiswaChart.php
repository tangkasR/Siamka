<?php

namespace App\Charts;

use App\Services\SiswaService;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TotalSiswaChart
{
    protected $chart;
    protected $siswa;

    public function __construct(LarapexChart $chart, SiswaService $siswa)
    {
        $this->chart = $chart;
        $this->siswa = $siswa;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $totalSiswa_ = $this->siswa->getSiswaPerAngkatan();
        // dd($totalSiswa_);s
        $angkatans = [];
        $totalSiswaL = [];
        $totalSiswaP = [];
        foreach ($totalSiswa_ as $data) {
            array_push($angkatans, 'Angkatan ' . $data->angkatan);
            array_push($totalSiswaL, $data->total_laki_laki);
            array_push($totalSiswaP, $data->total_perempuan);
        }

        return $this->chart->barChart()
            ->setTitle('Total Siswa per Angkatan')
            ->setSubtitle('Jumlah Siswa berdasarkan Angkatan dan Jenis Kelamin')
            ->addData('Laki-Laki', $totalSiswaL)
            ->addData('Perempuan', $totalSiswaP)
            ->setXAxis($angkatans)
            ->setColors(['#00c6ff', '#0072ff']) // Gradient colors
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setGrid()
            ->setDataLabels(true)
            ->setOptions([
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'offsetY' => -20,
                    'style' => [
                        'fontSize' => '12px',
                        'colors' => ['#304758'],
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => function ($val) {
                            return $val . " students";
                        },
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Angkatan',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Total Siswa',
                    ],
                ],
            ]);
    }
}
