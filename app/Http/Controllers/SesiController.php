<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SesiController extends Controller
{

    public function index()
    {
        $sesi = Sesi::select('id', 'nama_sesi')->get();
        return view('pages.admin.sesi', ['sesi' => $sesi]);
    }

    public function store(Request $request)
    {

        foreach ($request->nama_sesi as $data) {
            Sesi::create([
                'nama_sesi' => $data,
            ]);
        };

        return back()->with('message', 'Berhasil menambah data');
    }

    public function update(Request $request, $id)
    {
        Sesi::where('id', $id)->update([
            'nama_sesi' => $request->nama_sesi,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            Sesi::where('id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Data Sesi telah digunakan di Jadwal Pelajaran');
        }
        return back()->with('message', 'Berhasil menghapus data');
    }
}
