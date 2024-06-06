<?php

namespace App\Interfaces;

interface KehadiranGuruInterface
{

    public function getData($guru_id, $bulan, $tahun);
    public function getYear();
    public function rekapKehadiranGuru($guru_id, $tahun);
    public function checkAbsensi($guru_id, $tanggal);
    public function setLatLongSekolah();
    public function store($datas, $tanggal);
}
