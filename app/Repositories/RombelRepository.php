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
    private function translateDayToIndonesian($englishDay)
    {
        $days = [
            'Sunday' => 'minggu',
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
        ];

        return $days[$englishDay] ?? $englishDay;
    }
    public function getByGuruIdSesiSatu($guru_id)
    {
        $sesi = $this->sesi->getByNama('07:00-09:00');
        return DB::table('rombels')
            ->join('jadwal_pelajarans', 'rombels.id', '=', 'jadwal_pelajarans.rombel_id')
            ->join('gurus', 'jadwal_pelajarans.guru_id', '=', 'gurus.id')
            ->where('jadwal_pelajarans.sesi_id', $sesi->id)
            ->where('jadwal_pelajarans.hari', $this->translateDayToIndonesian($this->date->getDate()->format('l')))
            ->where('jadwal_pelajarans.guru_id', $guru_id)
            ->select('rombels.id', 'rombels.nama_rombel')
            ->orderBy('nama_rombel')
            ->first();
    }
    public function rombelWithoutGuru($id)
    {
        return DB::table('rombels')
            ->leftJoin('guru_rombel', function ($join) use ($id) {
                $join->on('rombels.id', '=', 'guru_rombel.rombel_id')
                    ->where('guru_rombel.guru_id', '=', $id);
            })
            ->whereNull('guru_rombel.guru_id')
            ->select('rombels.*')
            ->get();
    }
    public function getByGuruId($id)
    {
        return DB::table('rombels')
            ->leftJoin('guru_rombel', 'rombels.id', '=', 'guru_rombel.rombel_id')
            ->where('guru_rombel.guru_id', $id)
            ->select('rombels.*')
            ->orderBy('rombels.nama_rombel')
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
