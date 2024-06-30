<?php

namespace App\Repositories;

use App\Interfaces\EkskulInterface;
use App\Models\Ekskul;
use App\Services\DateService;
use Illuminate\Support\Facades\DB;

class EkskulRepository implements EkskulInterface
{
    private $ekskul;
    private $date;

    public function __construct(Ekskul $ekskul, DateService $date)
    {
        $this->ekskul = $ekskul;
        $this->date = $date;
    }

    public function getAll($id, $tahun_ajaran_id)
    {
        return $this->ekskul
            ->join('gurus', 'guru_id', 'gurus.id')
            ->where('gurus.nomor_induk_yayasan', $id)
            ->where('ekskuls.tahun_ajaran_id', $tahun_ajaran_id)
            ->select('ekskuls.id', 'ekskuls.nama_ekskul', 'gurus.nama')
            ->get();
    }
    public function getAllDatas($tahun_ajaran_id)
    {
        return $this->ekskul->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
    }
    public function getById($ekskul)
    {
        if (is_object($ekskul)) {
            return $ekskul->with('gurus')->first();
        }
        return $this->ekskul->with('gurus')->where('id', $ekskul)->first();
    }
    public function getSiswaNonMember($rombel, $ekskul)
    {
        $ekskul_id = $ekskul->id;
        return DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', 'rombel_siswa.siswa_id')
            ->where('rombel_siswa.rombel_id', $rombel->id)
            ->leftJoin('ekskul_siswa', function ($join) use ($ekskul_id) {
                $join->on('siswas.id', '=', 'ekskul_siswa.siswa_id')
                    ->where('ekskul_siswa.ekskul_id', '=', $ekskul_id);
            })
            ->whereNull('ekskul_siswa.siswa_id')
            ->where('siswas.status_siswa', 'belum lulus')
            ->select('siswas.id', 'siswas.nama')
            ->orderBy('siswas.nama', 'asc')
            ->get();
    }
    public function getMemberList($id)
    {
        $ekskul = $this->ekskul->where('id', $id)->with('siswas', 'siswas.rombels')->first();
        return $ekskul->siswas;
    }
    public function store($data, $guru_id, $tahun_ajaran_id)
    {
        return $this->ekskul->create([
            'guru_id' => $guru_id,
            'nama_ekskul' => $data,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);
    }

    public function update($data, $id)
    {
        return $this->ekskul->where('id', $id)->update([
            'nama_ekskul' => $data,
        ]);
    }

    public function getEkskulSiswa($nis)
    {
        $ekskuls = $this->ekskul
            ->join('ekskul_siswa', 'ekskuls.id', '=', 'ekskul_siswa.ekskul_id')
            ->join('siswas', 'ekskul_siswa.siswa_id', '=', 'siswas.id')
            ->join('gurus', 'ekskuls.guru_id', '=', 'gurus.id')
            ->join('tahun_ajarans', 'ekskuls.tahun_ajaran_id', '=', 'tahun_ajarans.id')
            ->where('siswas.nis', $nis)
            ->select(
                'ekskuls.nama_ekskul',
                'gurus.nama as nama_guru',
                'tahun_ajarans.tahun_ajaran',
                'tahun_ajarans.semester'
            )
            ->orderBy('ekskuls.nama_ekskul')
            ->orderBy('tahun_ajarans.tahun_ajaran')
            ->orderBy('tahun_ajarans.semester')
            ->get();

        $formattedEkskuls = $ekskuls->groupBy('nama_ekskul')->map(function ($grouped) {
            $data = $grouped->map(function ($item) {
                return [
                    'nama_guru' => $item->nama_guru,
                    'tahun_ajaran' => $item->tahun_ajaran,
                    'semester' => $item->semester,
                ];
            });
            return [
                'nama_ekskul' => $grouped->first()->nama_ekskul,
                'data' => $data,
            ];
        });

        return $formattedEkskuls->values();
    }
    public function getRombel($id)
    {
        $ekskul = $this->ekskul->where('id', $id)
            ->with(['siswas' => function ($query) {
                $query->with(['rombels' => function ($subQuery) {
                    $subQuery->select('rombels.id', 'rombels.nama_rombel');
                }]);
            }])
            ->first();

        // Extract unique class levels from 'nama_rombel' values
        $uniqueClassLevels = collect();

        if ($ekskul && $ekskul->siswas) {
            foreach ($ekskul->siswas as $siswa) {
                if ($siswa->rombels) {
                    foreach ($siswa->rombels as $rombel) {
                        // Extract the class level (e.g., 'X', 'XI', 'XII') from 'nama_rombel'
                        $classLevel = preg_replace('/\s.*$/', '', $rombel->nama_rombel);
                        $uniqueClassLevels->push($classLevel);
                    }
                }
            }
        }

        $uniqueClassLevels = $uniqueClassLevels->unique()->values();
        return $uniqueClassLevels;
    }

    public function getMemberListNilai($id, $rombel)
    {
        $ekskul = $this->ekskul->where('id', $id)->with('siswas.rombels')->first();

        // Filter siswas based on the given rombel
        $filteredSiswas = $ekskul->siswas->filter(function ($siswa) use ($rombel) {
            return $siswa->rombels->contains(function ($rombelInstance) use ($rombel) {
                // Extract the class level (e.g., 'X', 'XI', 'XII') from 'nama_rombel'
                $classLevel = preg_replace('/\s.*$/', '', $rombelInstance->nama_rombel);
                return $classLevel == $rombel;
            });
        });

        return $filteredSiswas->values();
    }
}
