<?php

namespace App\Interfaces;

interface KehadiranInterface
{
    public function getById($id);
    public function getBySiswaId($nis, $bulan, $tahun);
    public function getByRombelId($rombel_id, $tanggal);
    public function store($rombel_id, $tahun_ajaran_id, $tanggal);
    public function getMonthlyAttendance($nis, $tahun);
    public function destroy($rombel_id);
    public function getYear();
    public function clearData($year);
    public function checkKehadiran($tanggal, $rombel_id);
    public function getTahunAjaranNow();
}
