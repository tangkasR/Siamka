<?php

namespace App\Interfaces;

interface EkskulInterface
{
    public function getAll($id, $tahun_ajaran_id);
    public function getAllDatas($tahun_ajaran_id);
    public function getById($ekskul);
    public function getSiswaNonMember($rombel, $ekskul);
    public function getMemberList($id);
    public function store($data, $guru_id, $tahun_ajaran_id);
    public function update($data, $id);
    public function getEkskulSiswa($nis);
    public function getRombel($id);
    public function getMemberListNilai($id, $rombel);
}
