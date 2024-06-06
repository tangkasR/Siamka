<?php

namespace App\Interfaces;

interface KehadiranInterface
{
    public function getById($id);
    public function getBySiswaId($siswa_id, $bulan, $tahun);
    public function getByRombelId($rombel_id, $tanggal);
    public function store($rombel_id, $tanggal);
    public function getMonthlyAttendance($siswa_id, $tahun);
    public function destroy($rombel_id);
    public function getYear();
    public function clearData($year);
}
