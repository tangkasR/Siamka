<?php

namespace App\Interfaces;

interface NilaiEkskulInterface
{
    public function getAll($ekskul_id);
    public function checkNilaiWithSemester($ekskul_id, $semester);
    public function store($siswa_id, $ekskul_id, $nilai, $semester);
    public function update($datas, $id);
    public function destroy($condition, $params);
    public function getBySiswaId($siswa_id);
}
