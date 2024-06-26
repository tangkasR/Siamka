<?php

namespace App\Services;

use App\Interfaces\KehadiranGuruInterface;
use App\Services\DateService;
use Illuminate\Validation\ValidationException;

class KehadiranGuruService
{
    private $kehadiran_guru;
    private $date;
    private $tahun_ajaran;

    public function __construct(KehadiranGuruInterface $kehadiran_guru, DateService $date, TahunAjaranService $tahun_ajaran)
    {
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function getData($niy, $bulan, $tahun)
    {
        return $this->kehadiran_guru->getData($niy, $bulan, $tahun);
    }
    public function getYear()
    {
        return $this->kehadiran_guru->getYear();
    }
    public function rekapKehadiranGuru($niy, $tahun)
    {
        return $this->kehadiran_guru->rekapKehadiranGuru($niy, $tahun);
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
        if ($distance > 100) {
            throw ValidationException::withMessages(['error' => 'Anda diluar lingkungan sekolah, dan berada dijarak ' . $distance . ' m']);
        }

        $year = $this->date->getDate()->year;
        $month = $this->date->getDate()->month;
        if ($month < 7) {
            $tahun = $year - 1 . '-' . $year;
            $semester = 'genap';
        } else {
            $tahun = $year . '-' . $year + 1;
            $semester = 'ganjil';
        }
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return $this->kehadiran_guru->store($datas, $this->date->getDate(), $tahun_ajaran_id);
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
    public function AbsenKeluar()
    {
        $tanggal = $this->date->getDate();
        return $this->kehadiran_guru->AbsenKeluar($tanggal);
    }
    public function rataRataJamKerja()
    {
        return $this->kehadiran_guru->rataRataJamKerja();
    }
}
