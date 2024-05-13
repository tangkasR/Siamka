<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use App\Models\Rombel;
use App\Models\Sesi;
use App\Models\Siswa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $rombel = Rombel::select('id', 'nama_rombel')->get();
        return view('pages.admin.siswa.index', ['rombel' => $rombel]);
    }
    public function show_siswa($id)
    {
        $rombels = Rombel::select('id', 'nama_rombel')->get();
        $rombel = Rombel::where('id', '=', $id)
            ->select('id', 'nama_rombel')->first();
        $siswa = DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->where('rombel_id', '=', $id)
            ->select('siswas.id', 'siswas.jenis_kelamin', 'rombel_siswa.tahun_pembelajaran', 'siswas.nama', 'siswas.nik', 'siswas.tanggal_lahir', 'siswas.email', 'siswas.password')
            ->get();

        return view('pages.admin.siswa.siswa', [
            'siswa' => $siswa,
            'rombel' => $rombel,
            'rombels' => $rombels,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        Excel::import(new SiswaImport, $request->file);
        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $siswa = Siswa::where('id', $id)->first();
        $siswa->rombels()->detach();
        $rombel = Rombel::where('id', $request->rombel_id)->first();
        $siswa->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $siswa->rombels()->attach($rombel, [
            'tahun_pembelajaran' => $request->tahun_pembelajaran,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            $siswa = Siswa::where('id', $id)->first();
            $siswa->rombels()->detach();
            $siswa->delete();
        } catch (QueryException $e) {
            return back()->with('message', 'Berhasil menghapus data');
        }

        return back()->with('message', 'Berhasil menghapus data');
    }

    public function profil()
    {
        $siswa = auth()->guard('siswa')->user();
        $rombel = DB::table('siswas')
            ->join('rombel_siswa', 'siswas.id', '=', 'rombel_siswa.siswa_id')
            ->join('rombels', 'rombel_siswa.rombel_id', '=', 'rombels.id')
            ->where('siswas.id', '=', $siswa->id)
            ->select('rombels.nama_rombel')
            ->first();
        // dd($rombel);
        return view('pages.siswa.profil', ['siswa' => $siswa, 'rombel' => $rombel]);
    }

    public function show_jadwal()
    {
        $id = auth()->guard('siswa')->user();
        $siswa = Siswa::where('id', $id->id)->with('rombels')->first();
        $rombel_id = $siswa->rombels[0]->id;
        $jadwal = JadwalPelajaran::with('sesis')->where('rombel_id', $rombel_id)->get();

        $sesi_perhari = Sesi::select('nama_sesi')->get();

        return view('pages.siswa.jadwal_pelajaran', [
            'jadwal_pelajaran' => $jadwal,
            'sesi_perhari' => $sesi_perhari,
        ]);
    }
    public function show_kehadiran()
    {
        return view('pages.siswa.kehadiran');
    }
    public function show_nilai()
    {
        $id = auth()->guard('siswa')->user();
        $nilai = Nilai::with('mapels')->where('siswa_id', $id->id)
            ->where('tipe_ujian', 'uts')
            ->get();
        $tipe_ujian = $nilai[0]->tipe_ujian;
        return view('pages.siswa.nilai', [
            'nilai' => $nilai,
            'tipe_ujian' => $tipe_ujian,
        ]);
    }
    public function filter_nilai(Request $request)
    {
        $id = auth()->guard('siswa')->user();
        $nilai = Nilai::with('mapels')->where('siswa_id', $id->id)
            ->where('tipe_ujian', $request->tipe_ujian)
            ->get();
        return response($nilai);
    }
}
