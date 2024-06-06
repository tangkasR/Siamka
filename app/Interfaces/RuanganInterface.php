<?php

namespace App\Interfaces;

interface RuanganInterface
{
    public function getAll();
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
