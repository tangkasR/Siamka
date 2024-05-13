<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::select('id', 'nama_mata_pelajaran')->get();
        $guru = DB::table('gurus')
            ->join('mata_pelajarans', 'gurus.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->select('gurus.id', 'gurus.jenis_kelamin', 'gurus.nama', 'gurus.nomor_induk', 'gurus.email', 'mata_pelajarans.nama_mata_pelajaran')
            ->get();
        return view('pages.admin.guru.guru', ['guru' => $guru, 'mapel' => $mapel]);
    }

    public function store(Request $request)
    {
        Excel::import(new GuruImport, $request->file);
        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        Guru::where('id', $id)->update([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            Guru::where('id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Data Guru telah digunakan');
        }
        return back()->with('message', 'Berhasil menghapus data');
    }
    public function profil()
    {
        $guru = auth()->guard('guru')->user();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->select('nama_mata_pelajaran')->first();
        return view('pages.guru.profil', ['guru' => $guru, 'mapel' => $mapel]);
    }

}
