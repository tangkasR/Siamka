<?php

namespace App\Repositories;

use App\Interfaces\NilaiEkskulInterface;
use App\Models\NilaiEkskul;
use Illuminate\Support\Facades\DB;

class NilaiEkskulRepository implements NilaiEkskulInterface
{
    private $nilai_ekskul;
    public function __construct(NilaiEkskul $nilai_ekskul)
    {
        $this->nilai_ekskul = $nilai_ekskul;
    }

    public function getAll($ekskul_id, $rombel)
    {
        $siswas = DB::table('nilai_ekskuls')
            ->join('siswas', 'nilai_ekskuls.siswa_id', '=', 'siswas.id')
            ->join('ekskuls', 'nilai_ekskuls.ekskul_id', '=', 'ekskuls.id')
            ->join('ekskul_siswa', function ($join) use ($ekskul_id) {
                $join->on('nilai_ekskuls.siswa_id', '=', 'ekskul_siswa.siswa_id')->on('nilai_ekskuls.ekskul_id', '=', 'ekskul_siswa.ekskul_id')->where('ekskul_siswa.ekskul_id', '=', $ekskul_id);
            })
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->join('rombels', 'rombel_siswa.rombel_id', '=', 'rombels.id')
            ->whereRaw("SUBSTRING_INDEX(rombels.nama_rombel, ' ', 1) = ?", [$rombel])
            ->where('nilai_ekskuls.ekskul_id', $ekskul_id)
            ->select('siswas.nama', 'nilai_ekskuls.siswa_id', 'nilai_ekskuls.semester', 'nilai_ekskuls.nilai', 'nilai_ekskuls.id', 'ekskuls.nama_ekskul', 'rombels.nama_rombel')
            ->distinct()
            ->orderBy('rombels.nama_rombel')
            ->orderBy('siswas.nama')
            ->get();

        return collect($siswas);
    }
    public function getBySiswaNis($nis)
    {
        dd($nis);
        return $this->nilai_ekskul
            ->join('siswas', 'nilai_ekskuls.siswa_id', '=', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->select('nilai_ekskuls.*') // Memilih semua kolom dari tabel nilai_ekskul
            ->get();

        // return $this->nilai_ekskul->with(['siswas' => function ($query) use ($nis) {
        //     $query->where('nis', $nis);
        // }])->get();
    }
    public function checkNilaiWithSemester($ekskul_id, $tahun_ajaran_id, $rombel)
    {
        return $siswas = DB::table('nilai_ekskuls')
            ->join('siswas', 'nilai_ekskuls.siswa_id', '=', 'siswas.id')
            ->join('ekskuls', 'nilai_ekskuls.ekskul_id', '=', 'ekskuls.id')
            ->join('ekskul_siswa', function ($join) use ($ekskul_id) {
                $join->on('nilai_ekskuls.siswa_id', '=', 'ekskul_siswa.siswa_id')->on('nilai_ekskuls.ekskul_id', '=', 'ekskul_siswa.ekskul_id')->where('ekskul_siswa.ekskul_id', '=', $ekskul_id);
            })
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->join('rombels', 'rombel_siswa.rombel_id', '=', 'rombels.id')
            ->whereRaw("SUBSTRING_INDEX(rombels.nama_rombel, ' ', 1) = ?", [$rombel])
            ->where('nilai_ekskuls.ekskul_id', $ekskul_id)
            ->select('siswas.nama')
            ->distinct()
            ->orderBy('siswas.nama')
            ->get();
    }
    public function store($siswa_id, $ekskul_id, $nilai, $tahun_ajaran_id, $semester)
    {
        return $this->nilai_ekskul->create([
            'siswa_id' => $siswa_id,
            'ekskul_id' => $ekskul_id,
            'nilai' => $nilai,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'semester' => $semester,
        ]);
    }
    public function update($datas, $id)
    {
        return $this->nilai_ekskul->where('id', $id)->update([
            'nilai' => $datas['nilai'],
        ]);
    }
    public function destroy($nis)
    {
        return $this->nilai_ekskul->join('siswas', 'siswa_id', 'siswas.id')->where('siswas.nis', $nis)->delete();
    }

    public function getAllAdmin($ekskul_id)
    {
        $siswas = DB::table('nilai_ekskuls')
            ->join('siswas', 'nilai_ekskuls.siswa_id', '=', 'siswas.id')
            ->join('ekskuls', 'nilai_ekskuls.ekskul_id', '=', 'ekskuls.id')
            ->join('ekskul_siswa', function ($join) use ($ekskul_id) {
                $join->on('nilai_ekskuls.siswa_id', '=', 'ekskul_siswa.siswa_id')->on('nilai_ekskuls.ekskul_id', '=', 'ekskul_siswa.ekskul_id')->where('ekskul_siswa.ekskul_id', '=', $ekskul_id);
            })
            ->where('nilai_ekskuls.ekskul_id', $ekskul_id)
            ->select('siswas.nama', 'nilai_ekskuls.siswa_id', 'nilai_ekskuls.semester', 'nilai_ekskuls.nilai', 'nilai_ekskuls.id', 'ekskuls.nama_ekskul')
            ->distinct()
            ->orderBy('siswas.nama')
            ->get();

        return collect($siswas);
    }
}
