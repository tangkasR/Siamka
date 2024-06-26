<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruPreview implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $test = 'test';
        foreach ($rows as $index => $row) {

        }
        return $test;
    }
}
