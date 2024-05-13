<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Rombel;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{
    public function index()
    {
        $rombel = Rombel::select('id', 'nama_rombel')->get();

        return view('pages.guru.kehadiran.index', ['rombel' => $rombel]);
    }
    public function show_siswa($id)
    {
        $date = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $kehadirans = Kehadiran::with('siswas')->get();
        $tanggal = Kehadiran::where('rombel_id', $id)->select('tanggal')->distinct()->get();
        $kehadiran = DB::table('kehadirans')
            ->join('kehadiran_siswa', 'kehadirans.id', '=', 'kehadiran_siswa.kehadiran_id')
            ->join('siswas', 'siswas.id', '=', 'kehadiran_siswa.siswa_id')
            ->where('kehadirans.rombel_id', '=', $id)
            ->select(
                'siswas.nama',
                'kehadiran_siswa.kehadiran',
                'kehadiran_siswa.keterangan',
                'kehadirans.tanggal',
                'kehadiran_siswa.siswa_id',
                'kehadirans.id'
            )
            ->get();
        return view('pages.guru.kehadiran.absensi', [
            'rombel_id' => $id,
            'kehadiran' => $kehadiran,
            'kehadirans' => $kehadirans,
            'tanggal' => $tanggal,
            'date' => $date,
        ]);
    }
    public function filter(Request $request)
    {
        $tanggal = Kehadiran::where('rombel_id', $request->rombel_id)->select('tanggal')->distinct()->get();
        $kehadiran = DB::table('kehadirans')
            ->join('kehadiran_siswa', 'kehadirans.id', '=', 'kehadiran_siswa.kehadiran_id')
            ->join('siswas', 'siswas.id', '=', 'kehadiran_siswa.siswa_id')
            ->where('kehadirans.rombel_id', '=', $request->rombel_id)
            ->where('kehadirans.tanggal', '=', $request->tanggal)
            ->select(
                'siswas.nama',
                'kehadiran_siswa.kehadiran',
                'kehadiran_siswa.keterangan',
                'kehadirans.tanggal',
                'kehadiran_siswa.siswa_id',
                'kehadirans.id'
            )
            ->get();

        return response($kehadiran);
    }
    public function show_input($id)
    {
        $rombel = Rombel::where('id', $id)->with('siswas')->first();
        $date = Carbon::now()->isoFormat('dddd, D MMMM Y');
        return view('pages.guru.kehadiran.tambah_kehadiran', ['rombel' => $rombel, 'date' => $date]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data_kehadiran = [];
        $kehadiran = Kehadiran::where('tanggal', $request->tanggal)->where('rombel_id', $request->rombel_id)->first();
        if ($kehadiran != null) {
            return redirect()->route('guru.kehadiran.show_siswa', ['id' => $request->rombel_id])
                ->with('error', 'Data Kehadiran hari ini sudah ada!');
        }
        if ($request->daftar_kehadiran == null) {
            return back()->with('error', 'Masukan kehadiran semua Siswa!');
        }
        if (count($request->daftar_kehadiran) != count($request->keterangan)) {
            return back()->with('error', 'Masukan kehadiran semua Siswa!');
        }

        foreach ($request->keterangan as $index => $keterangan) {
            array_push($data_kehadiran, [
                'kehadiran' => $request->daftar_kehadiran[$index],
                'siswa_id' => $request->siswa_id[$index],
                'keterangan' => $keterangan,
            ]);
        }

        $kehadiran = Kehadiran::create([
            'rombel_id' => $request->rombel_id,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($data_kehadiran as $data) {
            $siswa = Siswa::where('id', $data['siswa_id'])->first(); // Use find() to get the Siswa model
            if ($siswa) {
                $kehadiran->siswas()->attach($siswa, [
                    'kehadiran' => $data['kehadiran'],
                    'keterangan' => $data['keterangan'],
                ]);
            }
        }
        return redirect()->route('guru.kehadiran.show_siswa', ['id' => $request->rombel_id])
            ->with('message', 'Berhasil menambah kehadiran hari ini');
    }

    public function update(Request $request, $id)
    {
        if ($request->daftar_kehadiran == null) {
            return redirect()->back()->with('error', 'Gagal mengubah kehadiran');
        }
        $kehadiran = Kehadiran::where('id', $id)->first();
        $siswa = Siswa::where('nama', $request->nama_siswa)->first();
        $kehadiran->siswas()->detach($siswa);
        $kehadiran->siswas()->attach($siswa, [
            'kehadiran' => $request->daftar_kehadiran,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('message', 'Berhasil mengubah kehadiran');
    }
}
