<?php

namespace App\Interfaces;

interface SiswaInterface
{
    public function getById($siswa);
    public function getSiswa($id);
    public function getSiswaAdmin($id);
    public function getByNama($nama);
    public function getByRombelIdActive($id);
    public function getByRombelIdNextGrade($id);
    public function getByRombelIdNotActiveAccount($id);
    public function getNotActive($angkatan);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
    public function lulus($id);
    public function aktivasi($id);
    public function deaktivasi($id);
    public function update_profil($datas, $id);
    public function getPivotTahunPembelajaran($id);
    public function getAngkatan();
    public function keluar($id);
    public function getSiswaPerAngkatan();
}
