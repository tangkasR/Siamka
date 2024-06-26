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
            ->select('siswas.id', 'siswas.nama')
            ->orderBy('siswas.nama', 'asc')
            ->get();
    }
    public function getMemberList($id)
    {
        return DB::table('ekskuls')
            ->join('ekskul_siswa', 'ekskul_siswa.ekskul_id', '=', 'ekskuls.id')
            ->join('siswas', 'ekskul_siswa.siswa_id', '=', 'siswas.id')
            ->where('ekskuls.id', $id)
            ->select(
                'siswas.id',
                'siswas.nama',
            )
            ->orderBy('siswas.nama', 'asc')
            ->get();
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
        return $this->ekskul
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
            ->orderBy('tahun_ajarans.tahun_ajaran')
            ->orderBy('tahun_ajarans.semester')
            ->get();
    }
    // ---------------------------------------------------------------------------
    public function getMemberListNotActive($id)
    {
        $datas = DB::table('ekskuls')
            ->join('ekskul_siswa', 'ekskuls.id', '=', 'ekskul_siswa.ekskul_id')
            ->join('siswas', 'ekskul_siswa.siswa_id', '=', 'siswas.id')
            ->leftJoin('nilai_ekskuls', function ($join) {
                $join->on('ekskul_siswa.siswa_id', '=', 'nilai_ekskuls.siswa_id')
                    ->on('ekskul_siswa.ekskul_id', '=', 'nilai_ekskuls.ekskul_id');
            })
            ->where('ekskuls.id', '=', $id)
            ->select(
                'siswas.nama as nama_siswa',
                'ekskul_siswa.status',
                'nilai_ekskuls.nilai',
                'nilai_ekskuls.semester'
            )
            ->orderBy('siswas.nama', 'asc')
            ->get();

        // Mengelompokkan data berdasarkan nama siswa dan semester
        $siswas = $datas->groupBy('nama_siswa')->map(function ($item) {
            return $item->keyBy('semester');
        });

        // Mengambil semua semester yang ada di tabel nilai_ekskul
        $semesters = DB::table('nilai_ekskuls')
            ->select('semester')
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester');
        return [
            'siswas' => $siswas,
            'semesters' => $semesters,
        ];
    }

    public function destroy($id)
    {
        return $this->ekskul->where('id', $id)->update([
            'status' => 'tidak aktif',
        ]);
    }
    public function activate($id)
    {
        return $this->ekskul->where('id', $id)->update([
            'status' => 'aktif',
        ]);
    }
}
