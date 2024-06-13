<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\GuruService;
use App\Services\MataPelajaranService;
use App\Services\NilaiService;
use App\Services\RombelService;
use App\Services\SiswaService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NilaiController extends Controller
{
    private $rombel;
    private $auth;
    private $nilai;
    private $mapel;
    private $siswa;
    private $guru;

    public function __construct(
        RombelService $rombel,
        AuthService $auth,
        NilaiService $nilai,
        MataPelajaranService $mapel,
        SiswaService $siswa,
        GuruService $guru
    ) {
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->nilai = $nilai;
        $this->mapel = $mapel;
        $this->siswa = $siswa;
        $this->guru = $guru;
    }
    public function index()
    {
        $guru_id = $this->auth->getUser('guru')->id;
        return view('pages.guru.nilai.index', [
            'rombel' => $this->rombel->getByGuruId($guru_id),
        ]);
    }
    public function show_siswa($id)
    {
        $guru_id = $this->auth->getUser('guru')->id;
        $guru = $this->guru->getById($guru_id);
        return view('pages.guru.nilai.nilai', [
            'rombel' => $this->rombel->getOne('id', $id),
            'mapel' => $guru->mapels,
            'guru' => $this->auth->getUser('guru'),
        ]);
    }
    public function getNilai_guru(Request $request)
    {
        $guru = $this->auth->getUser('guru');
        $nilai = $this->nilai->get_nilai_with_rombel_id_and_mapel_id($request->rombel_id, $guru->mata_pelajaran_id)
            ->paginate(5);
        return response($nilai);
    }
    public function filter(Request $request)
    {
        $guru = auth()->guard('guru')->user();
        $nilai = $this->nilai->get_nilai_with_rombel_id_and_mapel_id_and_tipe_ujian(
            $request->rombel_id,
            $request->mapel_id,
            $request->tipe_ujian,
            $request->semester
        )->paginate(5);
        return response($nilai);
    }

    public function show_input($id)
    {
        $guru_id = $this->auth->getUser('guru')->id;
        $guru = $this->guru->getById($guru_id);
        return view('pages.guru.nilai.tambah_nilai', [
            'guru' => $guru,
            'rombel' => $this->rombel->getOne('id', $id),
            'mapel' => $guru->mapels,
            'siswas' => $this->siswa->getByRombelIdActive($id),
        ]);
    }

    public function store(Request $request)
    {
        $checkSiswa = $this->nilai->get_nilai_with_rombel_id_and_mapel_id_and_tipe_ujian(
            $request->rombel_id,
            $request->mata_pelajaran_id,
            $request->tipe_ujian,
            $request->semester
        )->get();

        if (count($checkSiswa) > 0) {
            return redirect()->back()
                ->with('error', 'Nilai dengan semester dan tipe ujian tersebut sudah dimasukan!');
        }
        if ($request->siswa_id == null) {
            return redirect()->back()
                ->with('error', 'Masukan semua nilai Siswa!');
        }
        if (count($request->siswa_id) != count($request->nilai)) {
            return redirect()->back()
                ->with('error', 'Masukan semua nilai Siswa!');
        }
        $this->nilai->store($request->all());
        return redirect()->route('guru.nilai.show_siswa', ['id' => $request->rombel_id])
            ->with('message', 'Berhasil menambah data nilai');
    }
    public function show_update($id, $rombel_id)
    {
        $nilai = $this->nilai->getNilaiByParams('id', $id)->first();
        return view('pages.guru.nilai.ubah-nilai', [
            'data' => $nilai,
            'rombel_id' => $rombel_id,
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $this->nilai->update($request->all(), $id);
            return redirect()->route('guru.nilai.show_siswa', ['id' => $request->rombel_id])
                ->with('message', 'Berhasil mengubah data nilai');
        } catch (QueryException $er) {
            return redirect()->route('guru.nilai.show_siswa', ['id' => $request->rombel_id])
                ->with('message', 'Gagal mengubah data nilai');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $this->nilai->destroy($request->all());
            return redirect()->back()->with('message', 'Berhasil menghapus data nilai');
        } catch (ValidationException $er) {
            return redirect()->back()->with('error', $er->getMessage());
        }
    }
}
