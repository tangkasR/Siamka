<?php

namespace App\Repositories;

use App\Interfaces\RombelInterface;
use App\Models\Rombel;
use App\Services\DateService;
use App\Services\SesiService;
use Illuminate\Support\Facades\DB;

class RombelRepository implements RombelInterface
{
    private $rombel;
    private $sesi;
    private $data;
    public function __construct(Rombel $rombel, SesiService $sesi, DateService $date)
    {
        $this->rombel = $rombel;
        $this->sesi = $sesi;
        $this->date = $date;
    }

    public function getAll($id)
    {
        return $this->rombel->with('guru')->where('tahun_ajaran_id', $id)->get();
    }
    public function getRombelGuru($niy, $tahun_ajaran_id)
    {
        return DB::table('rombels')
            ->join('guru_rombel', 'rombels.id', 'guru_rombel.rombel_id')
            ->join('gurus', 'guru_rombel.guru_id', 'gurus.id')
            ->where('gurus.nomor_induk_yayasan', $niy)
            ->where('rombels.tahun_ajaran_id', $tahun_ajaran_id)
            ->select('rombels.id', 'rombels.nama_rombel')
            ->get();
    }
    public function getOne($rombel)
    {
        if (is_object($rombel)) {
            return $rombel->with('siswas')->first();
        }
        return $this->rombel->with('siswas')->where('id', $rombel)->first();
    }

    public function rombelWithoutGuru($id, $tahun_ajaran_id)
    {
        return DB::table('rombels')
            ->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->leftJoin('guru_rombel', function ($join) use ($id) {
                $join->on('rombels.id', '=', 'guru_rombel.rombel_id')
                    ->where('guru_rombel.guru_id', '=', $id);
            })
            ->whereNull('guru_rombel.guru_id')
            ->select('rombels.*')
            ->get();
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
    public function store($guru_id, $nama_rombel, $tahun_ajaran_id)
    {
        return $this->rombel->create([
            'guru_id' => $guru_id,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'nama_rombel' => $nama_rombel,
        ]);
    }
    public function update($data, $rombel)
    {
        return $rombel->update([
            'guru_id' => $data['guru_id'],
            'nama_rombel' => $data['nama_rombel'],
        ]);
    }
    public function destroy($rombel)
    {
        return $rombel->delete();
    }
    public function getByNama($nama_rombel, $tahun_ajaran_id)
    {
        return $this->rombel->where('nama_rombel', $nama_rombel)->where('tahun_ajaran_id', $tahun_ajaran_id)->first();
    }
}
