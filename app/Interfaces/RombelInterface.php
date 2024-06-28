<?php

namespace App\Interfaces;

interface RombelInterface
{
    public function getAll($id);
    public function getOne($rombel);
    public function rombelWithoutGuru($id, $tahun_ajaran_id);
    public function getBySiswaId($id);
    public function store($guru_id, $nama_rombel, $tahun_ajaran_id);
    public function update($data, $rombel);
    public function destroy($rombel);
    public function getRombelGuru($niy, $tahun_ajaran_id);
    public function getByNama($nama_rombel, $tahun_ajaran_id);
}
