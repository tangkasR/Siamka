<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::select('id', 'nomor_ruangan')->get();
        return view('pages.admin.ruangan', ['ruangan' => $ruangan]);
    }

    public function store(Request $request)
    {
        foreach ($request->nomor_ruangan as $data) {
            Ruangan::create([
                'nomor_ruangan' => $data,
            ]);
        };

        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        Ruangan::where('id', $id)->update([
            'nomor_ruangan' => $request->nomor_ruangan,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            Ruangan::where('id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Data Ruangan digunakan di Jadwal Pelajaran');
        }
        return back()->with('message', 'Berhasil menghapus data');
    }
}
