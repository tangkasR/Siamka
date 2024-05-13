<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $rombel = Rombel::select('id', 'nama_rombel')->get();
        return view('pages.guru.nilai.index', ['rombel' => $rombel]);
    }
    public function show_siswa(Request $request, $id)
    {
        $rombel = Rombel::select('nama_rombel')->where('id', $id)->first();
        $guru = auth()->guard('guru')->user();
        $nilai = DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $id)
            ->where('mata_pelajarans.id', '=', $guru->mata_pelajaran_id)
            ->select('nilais.id', 'siswas.nama', 'nilais.tipe_ujian', 'nilais.nilai', 'mata_pelajarans.nama_mata_pelajaran')
            ->get();
        $mapel = MataPelajaran::select('id', 'nama_mata_pelajaran')->get();

        return view('pages.guru.nilai.nilai', [
            'nilai' => $nilai,
            'rombel_id' => $id,
            'rombel' => $rombel,
            'mapel' => $mapel,
        ]);
    }
    public function filter(Request $request)
    {
        $rombel_id = $request->rombel_id;
        $tipe_ujian = $request->tipe_ujian;
        $guru = auth()->guard('guru')->user();
        $nilai = DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $rombel_id)
            ->where('mata_pelajarans.id', '=', $guru->mata_pelajaran_id)
            ->where('nilais.tipe_ujian', '=', $tipe_ujian)
            ->select('nilais.id', 'siswas.nama', 'nilais.tipe_ujian', 'nilais.nilai', 'mata_pelajarans.nama_mata_pelajaran')
            ->get();

        return response($nilai);

    }

    public function show_input($id)
    {
        $guru = auth()->guard('guru')->user();
        $mapel = MataPelajaran::select('id', 'nama_mata_pelajaran')->get();
        $rombel = Rombel::where('id', $id)->with('siswas')->first();
        return view('pages.guru.nilai.tambah_nilai', ['guru' => $guru, 'rombel' => $rombel, 'mapel' => $mapel]);
    }

    public function store(Request $request)
    {
        $data_siswa = [];
        $index = 0;
        $nilai = DB::table('nilais')
            ->join('siswas', 'nilais.siswa_id', '=', 'siswas.id')
            ->join('mata_pelajarans', 'nilais.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $request->rombel_id)
            ->where('mata_pelajarans.id', '=', $request->mata_pelajaran_id)
            ->where('nilais.tipe_ujian', '=', $request->tipe_ujian)
            ->select('nilais.id', 'siswas.nama', 'nilais.tipe_ujian', 'nilais.nilai', 'mata_pelajarans.nama_mata_pelajaran')
            ->get();
        // dd($nilai);

        if (count($nilai) > 0) {
            return redirect()->back()
                ->with('error', 'Gagal memasukan data. Data nilai dengan tipa ujian tersebut sudah dimasukan!');
        }
        if (count($request->siswa_id) != count($request->nilai)) {
            return redirect()->back()
                ->with('error', 'Masukan semua nilai Siswa!');
        }
        foreach ($request->siswa_id as $id) {
            array_push($data_siswa, [
                'siswa_id' => $id,
                'nilai' => $request->nilai[$index],
            ]);
            $index++;
        };
        foreach ($data_siswa as $siswa) {
            Nilai::create([
                'siswa_id' => $siswa['siswa_id'],
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'tipe_ujian' => $request->tipe_ujian,
                'nilai' => $siswa['nilai'],
            ]);
        };
        return redirect()->route('guru.nilai.show_siswa', ['id' => $request->rombel_id])
            ->with('message', 'Berhasil menambah data nilai');

    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('nama', $request->nama_siswa)->select('id')->first();
        Nilai::where('id', $id)->update([
            'tipe_ujian' => $request->tipe_ujian,
            'nilai' => $request->nilai,
        ]);
        return redirect()->back()->with('message', 'Berhasil mengubah data nilai');
    }
    public function destroy(Request $request, $id)
    {
        Nilai::where('id', $id)->delete();
        return redirect()->back();
    }
}
