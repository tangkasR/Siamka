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

    public function getNilaiById($id)
    {
        return $this->nilai->where('id', $id)->first();
    }
    public function getNilai($rombel_id, $mapel_id, $tahun_ajaran_id)
    {
        return $this->nilai->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('nilais.tahun_ajaran_id', '=', $tahun_ajaran_id)
            ->where('rombel_siswa.rombel_id', '=', $rombel_id)
            ->where('mata_pelajarans.id', '=', $mapel_id)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select(
                'nilais.id',
                'nilais.semester',
                'siswas.nama',
                'nilais.tipe_ujian',
                'nilais.nilai',
                'mata_pelajarans.nama_mata_pelajaran'
            );
    }
    public function getNilaiByParams($rombel_id, $mapel_id, $tipe_ujian, $semester, $tahun_ajaran_id)
    {
        return $this->nilai->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('nilais.tahun_ajaran_id', '=', $tahun_ajaran_id)
            ->where('rombel_siswa.rombel_id', '=', $rombel_id)
            ->where('nilais.mata_pelajaran_id', '=', $mapel_id)
            ->where('nilais.tipe_ujian', '=', $tipe_ujian)
            ->where('nilais.semester', '=', $semester)
            ->where('siswas.status_siswa', '=', 'belum lulus')
            ->select(
                'nilais.id',
                'nilais.semester',
                'siswas.nama',
                'nilais.tipe_ujian',
                'nilais.nilai',
                'mata_pelajarans.nama_mata_pelajaran'
            );
    }

    public function store($siswa_id, $mapel_id, $tipe_ujian, $nilai, $semester, $tahun_ajaran_id)
    {
        return $this->nilai->create([
            'siswa_id' => $siswa_id,
            'mata_pelajaran_id' => $mapel_id,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'tipe_ujian' => $tipe_ujian,
            'nilai' => $nilai,
            'semester' => $semester,
        ]);
    }

    public function update($data, $nilai)
    {
        return $nilai->update([
            'tipe_ujian' => $data['tipe_ujian'],
            'nilai' => $data['nilai'],
        ]);
    }

    public function destroy($id)
    {
        return $this->nilai->where('id', $id)->delete();
    }

    public function getNilaiUts($nis, $semester)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->where('nilais.semester', $semester)
            ->where('nilais.tipe_ujian', 'uts')
            ->select(
                'nilais.tipe_ujian',
                'nilais.semester',
                'nilais.nilai',
            )->get();
    }

    public function getNilaiUas($nis, $semester)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->where('nilais.semester', $semester)
            ->where('nilais.tipe_ujian', 'uas')
            ->select(
                'nilais.tipe_ujian',
                'nilais.semester',
                'nilais.nilai',
            )->get();
    }

    public function getTotalSemesterUts($nis)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->where('nilais.tipe_ujian', 'uts')
            ->select(
                'nilais.semester',
            )->max('semester');
    }
    public function getTotalSemesterUas($nis)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->where('nilais.tipe_ujian', 'uas')
            ->select(
                'nilais.semester',
            )->max('semester');
    }

    public function getNilaiBySiswa($semester, $tipe_ujian, $nis)
    {
        $nilais = DB::table('nilais')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('siswas', 'nilais.siswa_id', 'siswas.id')
            ->where('siswas.nis', $nis)
            ->where('nilais.semester', $semester)
            ->where('nilais.tipe_ujian', $tipe_ujian)
            ->select(
                'mata_pelajarans.nama_mata_pelajaran',
                'nilais.tipe_ujian',
                'nilais.semester',
                'nilais.nilai',
            );
        return $nilais;
    }
    public function getByNisSiswa($nis)
    {
        return DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('siswas.nis', $nis)
            ->select(
                'mata_pelajarans.nama_mata_pelajaran as nama_mata_pelajaran',
                'nilais.tipe_ujian',
                'nilais.semester',
                'nilais.nilai'
            )->get();
    }
    
}
