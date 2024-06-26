<?php

namespace App\Charts;

use App\Services\GuruService;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TotalGuruChart
{
    protected $chart;
    protected $guru;

    public function __construct(LarapexChart $chart, GuruService $guru)
    {
        $this->chart = $chart;
        $this->guru = $guru;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $totalGurus = $this->guru->totalGuru();
        $total_ganjil = [];
        $total_genap = [];
        $tahun_ajaran = [];
        $tahun_ajaran_temp = '';
        foreach ($totalGurus as $data) {
            if ($data['semester'] == 'ganjil') {
                array_push($total_ganjil, $data['total_guru']);
            }
            if ($data['semester'] == 'genap') {
                array_push($total_genap, $data['total_guru']);
            }
            if ($data['tahun_ajaran'] != $tahun_ajaran_temp) {
                array_push($tahun_ajaran, $data['tahun_ajaran']);
            }
            $tahun_ajaran_temp = $data['tahun_ajaran'];
        }

        return $this->chart->barChart()
            ->setTitle('Total Guru per Tahun Ajaran')
            ->setSubtitle('Jumlah Guru berdasarkan Tahun Ajaran dan Semester')
            ->addData('Ganjil', $total_ganjil)
            ->addData('Genap', $total_genap)
            ->setXAxis($tahun_ajaran)
            ->setColors(['#00c6ff', '#0072ff']) // Gradient colors
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setGrid() // Remove grid lines
            ->setDataLabels(true)
            ->setOptions([
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'endingShape' => 'rounded',
                        'columnWidth' => '10%', // Adjust bar width
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
                            return $val . " guru";
                        },
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Tahun Ajaran',
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => ['#9aa0ac'],
                            'fontSize' => '12px',
                        ],
                    ],
                    'axisBorder' => [
                        'show' => false, // Hide axis border
                    ],
                    'axisTicks' => [
                        'show' => false, // Hide axis ticks
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Total Guru',
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => ['#9aa0ac'],
                            'fontSize' => '12px',
                        ],
                    ],
                    'axisBorder' => [
                        'show' => false, // Hide axis border
                    ],
                    'axisTicks' => [
                        'show' => false, // Hide axis ticks
                    ],
                ],
                'legend' => [
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'floating' => true,
                    'offsetY' => -25,
                    'offsetX' => -5,
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'responsive' => [
                    [
                        'breakpoint' => 600,
                        'options' => [
                            'plotOptions' => [
                                'bar' => [
                                    'horizontal' => true,
                                ],
                            ],
                            'legend' => [
                                'position' => 'bottom',
                            ],
                        ],
                    ],
                ],
            ]);
    }
}
