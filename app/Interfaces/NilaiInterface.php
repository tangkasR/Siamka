<?php

namespace App\Interfaces;

interface NilaiInterface
{
    public function getNilaiById($id);
    public function getNilai($rombel_id, $mapel_id, $tahun_ajaran_id);
    public function getNilaiByParams($rombel_id, $mapel_id, $tipe_ujian, $semester, $tahun_ajaran_id);
    public function store($siswa_id, $mapel_id, $tipe_ujian, $nilai, $semester, $tahun_ajaran_id);
    public function update($data, $nilai);
    public function destroy($id);
    public function getNilaiUts($id, $semester);
    public function getNilaiUas($id, $semester);
    public function getNilaiBySiswa($semester, $tipe_ujian, $nis);
    public function getByNisSiswa($nis);
    public function getTotalSemesterUts($id);
    public function getTotalSemesterUas($id);

}
