<?php

namespace App\Http\Controllers;

use App\Imports\JadwalImport;
use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $rombel = Rombel::select('id', 'nama_rombel')->get();
        return view('pages.admin.jadwal_pelajaran.index', [
            'rombel' => $rombel,
        ]);
    }

    public function show_jadwal($id)
    {
        $jadwal_pelajaran = JadwalPelajaran::with('ruangans', 'mata_pelajarans', 'sesis')
            ->where('rombel_id', $id)
            ->get();

        $ruangan = Ruangan::select('id', 'nomor_ruangan')->select('id', 'nomor_ruangan')->get();
        $mapel = MataPelajaran::select('id', 'nama_mata_pelajaran')->select('id', 'nama_mata_pelajaran')->get();
        $sesi = Sesi::select('id', 'nama_sesi')->select('id', 'nama_sesi')->get();
        $rombel = Rombel::where('id', $id)->first();
        $hari = [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
        ];
        $templates = [];
        $temp_hari = '';
        foreach ($hari as $data) {
            if ($temp_hari != $data) {
                foreach ($sesi as $item_sesi) {
                    array_push($templates, [
                        'hari' => $data,
                        'sesi' => $item_sesi->nama_sesi,
                        'rombel' => $rombel->nama_rombel,
                    ]);
                }
            }
            $temp_hari = $data;
        }
        // dd($templates);

        return view('pages.admin.jadwal_pelajaran.jadwal_pelajaran', [
            'jadwal_pelajaran' => $jadwal_pelajaran,
            'ruangan' => $ruangan,
            'rombel' => $rombel,
            'mapel' => $mapel,
            'sesi' => $sesi,
            'templates' => $templates,
        ]);

    }

    public function store(Request $request)
    {
        Excel::import(new JadwalImport, $request->file);
        return back()->with('message', 'Berhasil menambah data');
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        JadwalPelajaran::where('id', $id)->update([
            'ruangan_id' => $request->ruangan_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
        ]);
        return back()->with('message', 'Berhasil mengubah data');
    }
    public function destroy(Request $request, $id)
    {
        try {
            JadwalPelajaran::where('rombel_id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal menghapus semua data');
        }
        return back()->with('message', 'Berhasil menghapus semua data');
    }
}
