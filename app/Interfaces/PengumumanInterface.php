<?php

namespace App\Interfaces;

interface PengumumanInterface
{
    public function get();
    public function store($datas);
    public function update($datas, $id);
    public function destroy($id);
}
