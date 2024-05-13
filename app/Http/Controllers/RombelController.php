<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Rombel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RombelController extends Controller
{
    public function index()
    {
        $guruAll = Guru::select('id', 'nama')->get();
        $rombel = DB::table('rombels')
            ->join('gurus', 'rombels.guru_id', '=', 'gurus.id')
            ->select('rombels.id', 'rombels.nama_rombel', 'gurus.nama', 'rombels.guru_id')
            ->orderBy('nama_rombel')
            ->get();
        $guru_wali_kelas = [];
        $guru = [];
        foreach ($rombel as $item) {
            array_push($guru_wali_kelas, $item->guru_id);
        }
        foreach ($guruAll as $item) {
            if (!in_array($item->id, $guru_wali_kelas)) {
                array_push($guru, [
                    'id' => $item->id,
                    'nama' => $item->nama,
                ]);
            }
        }
        return view('pages.admin.rombel', ['rombel' => $rombel, 'guru' => $guru, 'guruAll' => $guruAll]);
    }

    public function store(Request $request)
    {
        $index = 0;
        foreach ($request->nama_rombel as $item) {
            Rombel::create([
                'guru_id' => $request->guru_id[$index],
                'nama_rombel' => $item,
            ]);
            $index++;
        };
        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        Rombel::where('id', $id)->update([
            'guru_id' => $request->guru_id,
            'nama_rombel' => $request->nama_rombel,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            $rombel = Rombel::where('id', $id)->select('id')->first();
            $rombel->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Data Rombel telah digunakan');
        }
        return back()->with('message', 'Berhasil menghapus data');
    }
}
