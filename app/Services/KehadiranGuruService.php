<?php

namespace App\Services;

use App\Interfaces\KehadiranGuruInterface;
use App\Services\DateService;
use Illuminate\Validation\ValidationException;

class KehadiranGuruService
{
    private $kehadiran_guru;
    private $date;

    public function __construct(KehadiranGuruInterface $kehadiran_guru, DateService $date)
    {
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
    }
    public function getData($guru_id, $bulan, $tahun)
    {
        return $this->kehadiran_guru->getData($guru_id, $bulan, $tahun);
    }
    public function getYear()
    {
        return $this->kehadiran_guru->getYear();
    }
    public function rekapKehadiranGuru($guru_id, $tahun)
    {
        return $this->kehadiran_guru->rekapKehadiranGuru($guru_id, $tahun);
    }
    public function checkAbsensi($guru_id)
    {
        return $this->kehadiran_guru->checkAbsensi($guru_id, $this->date->getDate());
    }
    public function setLatLongSekolah()
    {
        return $this->kehadiran_guru->setLatLongSekolah();
    }
    public function store($datas)
    {
        $distance = round($this->distance($datas));
        if ($distance > 40) {
            throw ValidationException::withMessages(['error' => 'Anda diluar lingkungan sekolah, dan berada dijarak ' . $distance . ' m']);
        }

        return $this->kehadiran_guru->store($datas, $this->date->getDate());
    }

    private function distance($datas)
    {
        $lokasiSekolah = $this->kehadiran_guru->setLatLongSekolah();
        $latSekolah = $lokasiSekolah['latitude'];
        $longSekolah = $lokasiSekolah['longitude'];
        $latUser = $datas['latitude'];
        $longUser = $datas['longitude'];

        // Konversi derajat ke radian
        $latSekolahRad = deg2rad($latSekolah);
        $longSekolahRad = deg2rad($longSekolah);
        $latUserRad = deg2rad($latUser);
        $longUserRad = deg2rad($longUser);

        // Haversine formula
        $latDelta = $latUserRad - $latSekolahRad;
        $longDelta = $longUserRad - $longSekolahRad;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
        cos($latSekolahRad) * cos($latUserRad) *
        sin($longDelta / 2) * sin($longDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $earthRadius = 6371;

        $distance = $earthRadius * $c;

        return $distance * 1000;
    }
}
