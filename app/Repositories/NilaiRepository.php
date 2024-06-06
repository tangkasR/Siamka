<?php

namespace App\Repositories;

use App\Interfaces\NilaiInterface;
use App\Models\Nilai;
use App\Services\DateService;
use Illuminate\Support\Facades\DB;

class NilaiRepository implements NilaiInterface
{
    private $nilai;
    private $date;

    public function __construct(Nilai $nilai, DateService $date)
    {
        $this->nilai = $nilai;
        $this->date = $date;
    }
    public function getNilaiUasGroupByMapel($id)
    {
        return $this->nilai->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('nilais.siswa_id', $id)
            ->where('nilais.tipe_ujian', 'uas')
            ->select('mata_pelajarans.nama_mata_pelajaran', 'mata_pelajarans.id', 'nilais.tipe_ujian', 'nilais.semester', 'nilais.nilai')
            ->get()
            ->groupBy('nama_mata_pelajaran');
    }
    public function getTotalSemesterUts($id)
    {
        return $this->nilai->with('mapels')->where('siswa_id', $id)
            ->where('tipe_ujian', 'uts')
            ->select('semester')
            ->max('semester');
    }
    public function getTotalSemesterUas($id)
    {
        return $this->nilai->with('mapels')->where('siswa_id', $id)
            ->where('tipe_ujian', 'uas')
            ->select('semester')
            ->max('semester');
    }
    public function getNilaiUts($id, $semester)
    {
        return $this->nilai->with('mapels')->where('siswa_id', $id)
            ->where('tipe_ujian', 'uts')
            ->where('semester', $semester)
            ->get();
    }

    public function getNilaiUas($id, $semester)
    {
        return $this->nilai->with('mapels')->where('siswa_id', $id)
            ->where('tipe_ujian', 'uas')
            ->where('semester', $semester)
            ->get();
    }
    public function getByOneParams($conditional, $params)
    {
        return $this->nilai->with('mapels')
            ->where($conditional, $params);

    }
    public function getByThreeParams($conditional_1, $params_1, $conditional_2, $params_2, $conditional_3, $params_3)
    {
        return $this->nilai->with('mapels')
            ->where($conditional_1, $params_1)
            ->where($conditional_2, $params_2)
            ->where($conditional_3, $params_3);
    }
    public function getByRombelIdAndMapelId($rombel_id, $mapel_id)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $rombel_id)
            ->where('mata_pelajarans.id', '=', $mapel_id)
            ->where('rombel_siswa.tahun_awal', '=', $this->date->getDate()->year)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select('nilais.id', 'nilais.semester', 'siswas.nama', 'nilais.tipe_ujian', 'nilais.nilai', 'mata_pelajarans.nama_mata_pelajaran')
        ;
    }
    public function getByRombelIdAndMapelIdAndTipeUjian($rombel_id, $mapel_id, $tipe_ujian, $semester)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $rombel_id)
            ->where('mata_pelajarans.id', '=', $mapel_id)
            ->where('nilais.tipe_ujian', '=', $tipe_ujian)
            ->where('nilais.semester', '=', $semester)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select('nilais.id', 'nilais.semester', 'siswas.nama', 'nilais.tipe_ujian', 'nilais.nilai', 'mata_pelajarans.nama_mata_pelajaran')
        ;
    }
    public function store($siswa_id, $mapel_id, $tipe_ujian, $nilai, $semester)
    {
        return $this->nilai->create([
            'siswa_id' => $siswa_id,
            'mata_pelajaran_id' => $mapel_id,
            'tipe_ujian' => $tipe_ujian,
            'nilai' => $nilai,
            'semester' => $semester,
        ]);
    }
    public function update($data, $id)
    {
        $this->nilai->where('id', $id)->update([
            'tipe_ujian' => $data['tipe_ujian'],
            'nilai' => $data['nilai'],
        ]);
    }
    public function destroy($id)
    {
        return $this->nilai->where('id', $id)->delete();
    }

}
