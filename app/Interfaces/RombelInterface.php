<?php

namespace App\Interfaces;

interface RombelInterface
{
    public function getAll();
    public function getOne($condition, $params);
    public function getByGuruIdSesiSatu($guru_id);
    public function rombelWithoutGuru($id);
    public function getBySiswaId($id);
    public function store($guru_id, $nama_rombel);
    public function update($data, $rombel);
    public function destroy($rombel);
    public function getByGuruId($id);
}
