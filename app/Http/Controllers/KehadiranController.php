<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\JadwalPelajaranService;
use App\Services\KehadiranService;
use App\Services\RombelService;
use App\Services\SiswaService;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KehadiranController extends Controller
{
    private $rombel;
    private $kehadiran;
    private $siswa;
    private $date;
    private $auth;
    private $tahun_ajaran;
    private $jadwal;

    public function __construct(
        RombelService $rombel,
        KehadiranService $kehadiran,
        SiswaService $siswa,
        DateService $date,
        AuthService $auth,
        TahunAjaranService $tahun_ajaran,
        JadwalPelajaranService $jadwal
    ) {
        $this->rombel = $rombel;
        $this->kehadiran = $kehadiran;
        $this->siswa = $siswa;
        $this->date = $date;
        $this->auth = $auth;
        $this->tahun_ajaran = $tahun_ajaran;
        $this->jadwal = $jadwal;
    }
    public function index($tahun, $semester)
    {
        $guru = $this->auth->getUser('guru');
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $jadwal = $this->jadwal->getByGuruIdSesiSatu($guru->id, $tahun_ajaran_id);
        $kehadirans = [];
        $rombel = null;
        if ($jadwal) {
            $rombel = $jadwal->rombels;
            $kehadirans = $this->kehadiran->getByRombelId($rombel->id, $this->date->getDate()->format('Y-m-d'))->get();
        }
        return view('pages.guru.kehadiran.kehadiran', [
            'rombel' => $rombel,
            'date' => $this->date->getDate()->format('d/m/Y'),
            'kehadirans' => $kehadirans,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
public function getKehadiran_guru(Request $request)
    {
        $kehadiran = $this->kehadiran
            ->getByRombelId($request->rombel_id, $this->date->getDate()->format('Y-m-d'))
            ->paginate(5);
        return response($kehadiran);
    }
    public function filter(Request $request)
    {
        $kehadiran = $this->kehadiran
            ->getByRombelId($request->rombel_id, $request->tanggal)
            ->paginate(5);
        return response($kehadiran);
    }
    public function show_input($tahun, $semester, $id)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return view('pages.guru.kehadiran.tambah_kehadiran', [
            'rombel' => $this->rombel->getOne($id),
            'date' => $this->date->getDate()->format('Y-m-d'),
            'siswas' => $this->siswa->getSiswa($id),
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);
    }

    public function store(Request $request)
    {
        $check_kehadiran = $this->kehadiran->checkKehadiran($request->tanggal, $request->rombel_id);

        if (count($check_kehadiran) != 0) {
            return redirect()->route('guru.kehadiran', ['tahun' => $request->tahun_ajaran, 'semester' => $request->semester, 'id' => $request->rombel_id])
                ->with('error', 'Data Kehadiran hari ini sudah ada!');
        }

        $this->kehadiran->store($request->all());
        return redirect()->route('guru.kehadiran', ['tahun' => $request->tahun_ajaran, 'semester' => $request->semester, 'id' => $request->rombel_id])
            ->with('message', 'Berhasil menambah kehadiran hari ini');
    }

    public function update(Request $request, $id)
    {

        $this->kehadiran->update($request->all(), $id);
        return redirect()->back()
            ->with('message', 'Berhasil mengubah data kehadiran');
    }
    public function destroy($rombel_id)
    {
        try {
            $this->kehadiran->destroy($rombel_id);
            return redirect()->back()
                ->with('message', 'Berhasil menghapus data kehadiran hari ini!');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }

    public function admin_show_kehadiran($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $rombel = $this->rombel->getAll($tahun_ajaran_id);
        return view('pages.admin.kehadiran.index', [
            'rombel' => $rombel,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function admin_detail_kehadiran($tahun, $semester, Rombel $rombel, Request $request)
    {
        $tanggal = $this->date->getDate();
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $rombel = $this->rombel->getOne($rombel->id);

        if ($request->has("tanggal")) {

            return view('pages.admin.kehadiran.detail_kehadiran', [
                'tahun' => $tahun,
                'semester' => $semester,
                'rombel' => $rombel,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'tanggal' => $tanggal->format('Y-m-d'),
                'kehadirans' => $this->kehadiran->getByRombelId($rombel->id, $request->tanggal)->get(),
            ]);
        }
        return view('pages.admin.kehadiran.detail_kehadiran', [
            'tahun' => $tahun,
            'semester' => $semester,
            'rombel' => $rombel,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'tanggal' => $tanggal->format('Y-m-d'),
            'kehadirans' => $this->kehadiran->getByRombelId($rombel->id, $tanggal)->get(),
        ]);
    }
    public function admin_get_kehadiran(Request $request)
    {
        $kehadirans =
        // return response($kehadirans);
        $rombel = $this->rombel->getOne($request->rombel_id);
        $view = view('pages.admin.kehadiran.data-kehadiran', [
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'rombel' => $rombel,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'tanggal' => $request->tanggal,
            'kehadirans' => $kehadirans,
        ])->render();

        return response()->json(['html' => $view], 200);

    }

    public function admin_show_input($tahun, $semester, $id)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return view('pages.admin.kehadiran.tambah_kehadiran', [
            'rombel' => $this->rombel->getOne($id),
            'date' => $this->date->getDate()->format('Y-m-d'),
            'siswas' => $this->siswa->getSiswa($id),
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);
    }

    public function admin_store(Request $request)
    {
        $check_kehadiran = $this->kehadiran->checkKehadiran($request->tanggal, $request->rombel_id);
        $rombel = $this->rombel->getOne($request->rombel_id);
        if (count($check_kehadiran) != 0) {
            return redirect()->route('admin.kehadiran.detail_kehadiran', ['tahun' => $request->tahun_ajaran, 'semester' => $request->semester, 'rombel' => $rombel])
                ->with('error', 'Data Kehadiran hari ini sudah ada!');
        }

        $this->kehadiran->store($request->all());
        return redirect()->route('admin.kehadiran.detail_kehadiran', ['tahun' => $request->tahun_ajaran, 'semester' => $request->semester, 'rombel' => $rombel])
            ->with('message', 'Berhasil menambah kehadiran hari ini');
    }
}
