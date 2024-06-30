<?php

namespace App\Interfaces;

interface KehadiranGuruInterface
{

    public function getData($niy, $bulan, $tahun);
    public function getYear();
    public function rekapKehadiranGuru($niy, $tahun);
    public function checkAbsensi($guru_id, $tanggal);
    public function setLatLongSekolah();
    public function store($datas, $tanggal, $tahun_ajaran_id);
    public function AbsenKeluar($tanggal, $datas);
    public function rataRataJamKerja();
}
