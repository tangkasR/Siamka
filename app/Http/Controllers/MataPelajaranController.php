<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::select('id', 'nama_mata_pelajaran')->get();
        return view('pages.admin.mata_pelajaran', ['mapel' => $mapel]);
    }

    public function store(Request $request)
    {
        foreach ($request->nama_mata_pelajaran as $data) {
            MataPelajaran::create([
                'nama_mata_pelajaran' => $data,
            ]);
        }
        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        MataPelajaran::where('id', $id)->update([
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            MataPelajaran::where('id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Data Mata Pelajaran telah digunakan');
        }
        return back()->with('message', 'Berhasil menghapus data');
    }
}
