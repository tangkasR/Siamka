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

    public function getAll($id)
    {
        return $this->ekskul->where('guru_id', $id)->get();
    }
    public function getById($id)
    {
        return $this->ekskul->with('gurus')->where('id', $id)->first();
    }
    public function getSiswaNonMember($rombel_id, $ekskul_id)
    {
        return DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->leftJoin('ekskul_siswa', function ($join) use ($ekskul_id) {
                $join->on('siswas.id', '=', 'ekskul_siswa.siswa_id')
                    ->where('ekskul_siswa.ekskul_id', '=', $ekskul_id);
            })
            ->whereNull('ekskul_siswa.siswa_id')
            ->where('rombel_siswa.rombel_id', '=', $rombel_id)
            ->where('rombel_siswa.tahun_awal', '=', $this->date->getDate()->year)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select(
                'siswas.id',
                'siswas.nama',
                'siswas.nis',
                'siswas.nisn',
                'siswas.nomor_id',
                'siswas.jenis_kelamin',
                'siswas.status_siswa',
                'siswas.aktivasi_akun',
                'siswas.username',
                'siswas.password',
                'rombel_siswa.tahun_awal',
                'rombel_siswa.tahun_akhir'
            )
            ->orderBy('siswas.nama', 'asc')
            ->get();
    }
    public function getMemberList($id)
    {
        return DB::table('ekskuls')
            ->join('ekskul_siswa', 'ekskuls.id', '=', 'ekskul_siswa.ekskul_id')
            ->join('siswas', 'ekskul_siswa.siswa_id', '=', 'siswas.id')
            ->where('ekskuls.id', '=', $id)
            ->where('ekskul_siswa.status', '=', 'aktif')
            ->select(
                'siswas.id',
                'siswas.nama',
                'ekskul_siswa.status',
            )
            ->orderBy('siswas.nama', 'asc')
            ->get();
    }
    public function store($data, $guru_id)
    {
        return $this->ekskul->create([
            'guru_id' => $guru_id,
            'nama_ekskul' => $data,
            'status' => 'aktif',
        ]);
    }
    public function update($data, $id)
    {
        return $this->ekskul->where('id', $id)->update([
            'nama_ekskul' => $data,
        ]);
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
