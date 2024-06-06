<?php

namespace App\Repositories;

use App\Interfaces\RombelInterface;
use App\Models\Rombel;
use Illuminate\Support\Facades\DB;

class RombelRepository implements RombelInterface
{
    private $rombel;
    public function __construct(Rombel $rombel)
    {
        $this->rombel = $rombel;
    }

    public function getAll()
    {
        return DB::table('rombels')
            ->join('gurus', 'rombels.guru_id', '=', 'gurus.id')
            ->select('rombels.id', 'rombels.nama_rombel', 'gurus.nama', 'rombels.guru_id')
            ->orderBy('nama_rombel')
            ->get();
    }
    public function getOne($condition, $params)
    {
        return $this->rombel->where($condition, $params)->with('siswas')->first();
    }
    public function getBySiswaId($id)
    {
        return DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->join('rombels', 'rombel_siswa.rombel_id', '=', 'rombels.id')
            ->where('siswas.id', '=', $id)
            ->select('rombels.nama_rombel', 'rombels.id')
            ->get();
    }
    public function store($guru_id, $nama_rombel)
    {
        return $this->rombel->create([
            'guru_id' => $guru_id,
            'nama_rombel' => $nama_rombel,
        ]);
    }
    public function update($data, $id)
    {
        return $this->rombel->where('id', $id)->update([
            'guru_id' => $data['guru_id'],
            'nama_rombel' => $data['nama_rombel'],
        ]);
    }
    public function destroy($id)
    {
        return $this->rombel->where('id', $id)->delete();
    }
}
