<?php

namespace App\Charts;

use App\Services\KehadiranGuruService;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class RataRataJamChart
{
    protected $chart;
    protected $kehadiran_guru;

    public function __construct(LarapexChart $chart, KehadiranGuruService $kehadiran_guru)
    {
        $this->chart = $chart;
        $this->kehadiran_guru = $kehadiran_guru;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $rataRata = $this->kehadiran_guru->rataRataJamKerja();
        $tahun_ajaran = [];
        $rataRataGanjil = [];
        $rataRataGenap = [];
        $tahun_ajaran_temp = '';
        foreach ($rataRata as $index => $data) {
            $formattedRataRata = number_format($data->rata_rata_jam_kerja, 2);
            if ($index == 0) {
                array_push($rataRataGanjil, 0);
                array_push($rataRataGenap, 0);
                array_push($tahun_ajaran, '');
            }
            if ($data->semester == 'ganjil') {
                array_push($rataRataGanjil, $formattedRataRata);
            }
            if ($data->semester == 'genap') {
                array_push($rataRataGenap, $formattedRataRata);
            }
            if ($data->tahun_ajaran != $tahun_ajaran_temp) {
                array_push($tahun_ajaran, 'Tahun Ajaran ' . $data->tahun_ajaran);
            }
            $tahun_ajaran_temp = $data->tahun_ajaran;
        }

        return $this->chart->areaChart()
            ->setTitle('Rata-Rata Jam Kerja Guru')
            ->setSubtitle('Rata-rata jam kerja guru berdasarkan Tahun Ajaran dan Semester.')
            ->addData('Semester Ganjil', $rataRataGanjil)
            ->addData('Semester Genap', $rataRataGenap)
            ->setXAxis($tahun_ajaran)
            ->setColors(['#00c6ff', '#0072ff']) // Gradient colors
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setGrid() // Remove grid lines
            ->setDataLabels(true)
            ->setOptions([
                'plotOptions' => [
                    'area' => [
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
                            return $val . " jam";
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
                        'text' => 'Rata-Rata Jam Kerja',
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
                                'area' => [
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
