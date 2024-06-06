<?php

namespace App\Repositories;

use App\Interfaces\KehadiranInterface;
use App\Models\Kehadiran;
use App\Services\DateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KehadiranRepository implements KehadiranInterface
{
    private $kehadiran;
    private $date;

    public function __construct(Kehadiran $kehadiran, DateService $date)
    {
        $this->kehadiran = $kehadiran;
        $this->date = $date;
    }
    public function getById($id)
    {
        return $this->kehadiran->with('siswas')->where('id', $id)->first();
    }
    public function getMonthlyAttendance($siswa_id, $tahun)
    {
        return DB::table('kehadirans')
            ->join('kehadiran_siswa', 'kehadirans.id', '=', 'kehadiran_siswa.kehadiran_id')
            ->join('siswas', 'siswas.id', '=', 'kehadiran_siswa.siswa_id')
            ->select(
                DB::raw('YEAR(kehadirans.tanggal) as year'),
                DB::raw('MONTH(kehadirans.tanggal) as month'),
                DB::raw('SUM(CASE WHEN kehadiran_siswa.kehadiran = "hadir" THEN 1 ELSE 0 END) as hadir'),
                DB::raw('SUM(CASE WHEN kehadiran_siswa.kehadiran = "sakit" THEN 1 ELSE 0 END) as sakit'),
                DB::raw('SUM(CASE WHEN kehadiran_siswa.kehadiran = "izin" THEN 1 ELSE 0 END) as izin'),
                DB::raw('SUM(CASE WHEN kehadiran_siswa.kehadiran = "alpa" THEN 1 ELSE 0 END) as alpa')
            )
            ->where('kehadiran_siswa.siswa_id', '=', $siswa_id)
            ->whereYear('kehadirans.tanggal', $tahun)
            ->groupBy(DB::raw('YEAR(kehadirans.tanggal)'), DB::raw('MONTH(kehadirans.tanggal)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }
    public function getYear()
    {
        return $this->kehadiran->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->get();
    }
    public function getBySiswaId($siswa_id, $bulan, $tahun)
    {
        return DB::table('kehadirans')
            ->join('kehadiran_siswa', 'kehadirans.id', '=', 'kehadiran_siswa.kehadiran_id')
            ->join('siswas', 'siswas.id', '=', 'kehadiran_siswa.siswa_id')
            ->where('kehadiran_siswa.siswa_id', '=', $siswa_id)
            ->whereYear('kehadirans.tanggal', '=', $tahun)
            ->whereMonth('kehadirans.tanggal', '=', $bulan)
            ->select(
                'siswas.nama',
                'kehadiran_siswa.kehadiran',
                'kehadirans.tanggal',
                'kehadiran_siswa.siswa_id',
                'kehadirans.id'
            );
    }
    public function getByRombelId($rombel_id, $tanggal)
    {
        return DB::table('kehadirans')
            ->join('kehadiran_siswa', 'kehadirans.id', '=', 'kehadiran_siswa.kehadiran_id')
            ->join('siswas', 'siswas.id', '=', 'kehadiran_siswa.siswa_id')
            ->where('kehadirans.rombel_id', '=', $rombel_id)
            ->where('kehadirans.tanggal', '=', $tanggal)
            ->select(
                'siswas.nama',
                'kehadiran_siswa.kehadiran',
                'kehadirans.tanggal',
                'kehadiran_siswa.siswa_id',
                'kehadirans.id'
            );
    }

    public function store($rombel_id, $tanggal)
    {
        return $this->kehadiran->create([
            'rombel_id' => $rombel_id,
            'tanggal' => $tanggal,
        ]);
    }
    public function destroy($rombel_id)
    {
        $tanggal = $this->date->getDate();
        $kehadiran = $this->kehadiran
            ->where('rombel_id', $rombel_id)
            ->where('tanggal', $tanggal)->first();
        if ($kehadiran == null) {
            throw ValidationException::withMessages(['error' => 'Data kehadiran hari ini tidak ada!']);
        }
        $kehadiran->siswas()->detach();
        return $this->kehadiran
            ->where('rombel_id', $rombel_id)
            ->where('tanggal', $tanggal)
            ->delete();
    }
    public function clearData($year)
    {
        return $this->kehadiran->whereYear('tanggal', '<', $year)->delete();
    }
}
