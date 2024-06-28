<?php

namespace App\Interfaces;

interface NilaiEkskulInterface
{
    public function getAll($ekskul_id, $rombel);
    public function checkNilaiWithSemester($ekskul_id, $tahun_ajaran_id, $rombel);
    public function store($siswa_id, $ekskul_id, $nilai, $tahun_ajaran_id, $semester);
    public function update($datas, $id);
    public function destroy($condition, $params);
    public function getBySiswaNis($nis);
}
