<?php

namespace App\Interfaces;

interface EkskulInterface
{
    public function getAll($id, $tahun_ajaran_id);
    public function getById($ekskul);
    public function store($data, $guru_id, $tahun_ajaran_id);
    public function update($data, $id);
    public function destroy($id);
    public function getMemberList($id);
    public function getSiswaNonMember($rombel, $ekskul);
    public function activate($id);
    public function getMemberListNotActive($id);
    public function getAllDatas($tahun_ajaran_id);
    public function getEkskulSiswa($nis);
}
