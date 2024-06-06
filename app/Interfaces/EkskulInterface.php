<?php

namespace App\Interfaces;

interface EkskulInterface
{
    public function getAll($id);
    public function getById($id);
    public function store($data, $guru_id);
    public function update($data, $id);
    public function destroy($id);
    public function getMemberList($id);
    public function getSiswaNonMember($rombel_id, $ekskul_id);
    public function activate($id);
}
