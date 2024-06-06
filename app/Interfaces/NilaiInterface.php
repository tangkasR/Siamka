<?php

namespace App\Interfaces;

interface NilaiInterface
{
    public function getNilaiUasGroupByMapel($id);
    public function getTotalSemesterUts($id);
    public function getTotalSemesterUas($id);
    public function getNilaiUts($id, $semester);
    public function getNilaiUas($id, $semester);
    public function getByRombelIdAndMapelId($rombel_id, $mapel_id);
    public function getByRombelIdAndMapelIdAndTipeUjian($rombel_id, $mapel_id, $tipe_ujian, $semester);
    public function store($siswa_id, $mapel_id, $tipe_ujian, $nilai, $semester);
    public function update($data, $id);
    public function destroy($id);
    public function getByOneParams($conditional, $params);
    public function getByThreeParams($conditional_1, $params_1, $conditional_2, $params_2, $conditional_3, $params_3);
}
