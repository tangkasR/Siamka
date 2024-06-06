<?php

namespace App\Repositories;

use App\Interfaces\NilaiEkskulInterface;
use App\Models\NilaiEkskul;

class NilaiEkskulRepository implements NilaiEkskulInterface
{
    private $nilai_ekskul;
    public function __construct(NilaiEkskul $nilai_ekskul)
    {
        $this->nilai_ekskul = $nilai_ekskul;
    }

    public function getAll($ekskul_id)
    {
        return $this->nilai_ekskul
            ->join('siswas', 'nilai_ekskuls.siswa_id', '=', 'siswas.id')
            ->join('ekskul_siswa', 'siswas.id', '=', 'ekskul_siswa.siswa_id')
            ->join('ekskuls', 'nilai_ekskuls.ekskul_id', '=', 'ekskuls.id')
            ->select('siswas.nama', 'nilai_ekskuls.siswa_id', 'nilai_ekskuls.semester', 'nilai_ekskuls.nilai', 'nilai_ekskuls.id', 'ekskuls.nama_ekskul')
            ->where('nilai_ekskuls.ekskul_id', $ekskul_id)
            ->where('ekskul_siswa.status', 'aktif')
            ->orderBy('siswas.nama')
            ->with('siswas')
            ->get();
    }
    public function getBySiswaId($siswa_id)
    {
        return $this->nilai_ekskul->with('ekskuls')->where('siswa_id', $siswa_id)->get();
    }
    public function checkNilaiWithSemester($ekskul_id, $semester)
    {
        return $this->nilai_ekskul
            ->where('ekskul_id', $ekskul_id)
            ->where('semester', $semester)
            ->get();
    }
    public function store($siswa_id, $ekskul_id, $nilai, $semester)
    {
        return $this->nilai_ekskul->create([
            'siswa_id' => $siswa_id,
            'ekskul_id' => $ekskul_id,
            'nilai' => $nilai,
            'semester' => $semester,
        ]);
    }
    public function update($datas, $id)
    {
        return $this->nilai_ekskul->where('id', $id)
            ->update([
                'nilai' => $datas['nilai'],
                'semester' => $datas['semester'],
            ]);
    }
    public function destroy($condition, $params)
    {
        return $this->nilai_ekskul->where($condition, $params)->delete();
    }
}
