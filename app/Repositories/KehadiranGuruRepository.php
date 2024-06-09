<?php

namespace App\Repositories;

use App\Interfaces\KehadiranGuruInterface;
use App\Models\KehadiranGuru;

class KehadiranGuruRepository implements KehadiranGuruInterface
{
    private $kehadiran_guru;
    public function __construct(KehadiranGuru $kehadiran_guru)
    {
        $this->kehadiran_guru = $kehadiran_guru;
    }

    public function getData($guru_id, $bulan, $tahun)
    {
        return $this->kehadiran_guru->where('guru_id', $guru_id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->paginate(5);
    }
    public function rekapKehadiranGuru($guru_id, $tahun)
    {
        $rekapKehadiran = $this->kehadiran_guru
            ->selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, COUNT(*) as total_kehadiran')
            ->where('guru_id', $guru_id)
            ->whereYear('tanggal', $tahun)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->get();

        return $rekapKehadiran;
    }
    public function getYear()
    {
        return $this->kehadiran_guru->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->get();
    }
    public function checkAbsensi($guru_id, $tanggal)
    {
        return $this->kehadiran_guru->where('guru_id', $guru_id)
            ->where('tanggal', $tanggal)->get();
    }
    public function setLatLongSekolah()
    {
        // Salah
        // return $lokasi = [
        //     'latitude' => -7.825418618406336,
        //     'longitude' => 110.39078129170166,
        // ];

        // benar
        return $lokasi = [
            'latitude' => -7.768509545633629,
            'longitude' => 110.41372473676195,
        ];

    }
    public function store($datas, $tanggal)
    {
        return $this->kehadiran_guru->create([
            'guru_id' => $datas['guru_id'],
            'kehadiran' => 'hadir',
            'tanggal' => $tanggal,
        ]);
    }

}
