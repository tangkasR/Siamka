<?php

namespace App\Services;

use App\Interfaces\KehadiranInterface;
use App\Services\SiswaService;

class KehadiranService
{
    private $kehadiran;
    private $siswa;

    public function __construct(KehadiranInterface $kehadiran, SiswaService $siswa)
    {
        $this->kehadiran = $kehadiran;
        $this->siswa = $siswa;
    }
    public function getById($id)
    {
        return $this->kehadiran->getById($id);
    }
    public function getYear()
    {
        return $this->kehadiran->getYear();
    }
    public function getMonthlyAttendance($siswa_id, $tahun)
    {
        return $this->kehadiran->getMonthlyAttendance($siswa_id, $tahun);
    }
    public function getBySiswaId($siswa_id, $bulan, $tahun)
    {
        return $this->kehadiran->getBySiswaId($siswa_id, $bulan, $tahun);
    }
    public function getByRombelId($rombel_id, $tanggal)
    {
        return $this->kehadiran->getByRombelId($rombel_id, $tanggal);
    }

    public function store($datas)
    {
        return $this->handleStore($datas);
    }
    public function update($datas, $id)
    {
        return $this->handleUpdate($datas, $id);
    }
    public function destroy($rombel_id)
    {
        return $this->kehadiran->destroy($rombel_id);
    }
    private function handleStore($datas)
    {

        $data_kehadiran = [];
        foreach ($datas['daftar_kehadiran'] as $index => $kehadiran) {
            array_push($data_kehadiran, [
                'kehadiran' => $kehadiran,
                'siswa_id' => $datas['siswa_id'][$index],
            ]);
        }

        $kehadiran = $this->kehadiran->store($datas['rombel_id'], $datas['tanggal']);

        foreach ($data_kehadiran as $data) {
            $siswa = $this->siswa->getById($data['siswa_id']);
            if ($siswa) {
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $data['kehadiran'],
                ]);
            }
        }
    }
    private function handleUpdate($datas, $id)
    {
        $kehadiran = $this->kehadiran->getById($id);
        $siswa = $this->siswa->getByNama($datas['nama_siswa']);
        $kehadiran->siswas()->detach($siswa);
        $kehadiran->siswas()->attach($siswa, [
            'kehadiran' => $datas['daftar_kehadiran'],
        ]);
    }
    public function clearData($year)
    {
        return $this->kehadiran->clearData($year);
    }
}
