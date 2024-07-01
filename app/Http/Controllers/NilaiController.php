<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Rombel;
use App\Services\AuthService;
use App\Services\GuruService;
use App\Services\MataPelajaranService;
use App\Services\NilaiService;
use App\Services\RombelService;
use App\Services\SiswaService;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class NilaiController extends Controller
{
    private $rombel;
    private $auth;
    private $nilai;
    private $mapel;
    private $siswa;
    private $guru;
    private $tahun_ajaran;

    public function __construct(
        RombelService $rombel,
        AuthService $auth,
        NilaiService $nilai,
        MataPelajaranService $mapel,
        SiswaService $siswa,
        GuruService $guru,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->nilai = $nilai;
        $this->mapel = $mapel;
        $this->siswa = $siswa;
        $this->guru = $guru;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function index($tahun, $semester)
    {

        $guru_ = $this->auth->getUser('guru');
        $guru = $this->guru->getById($guru_->id);
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return view('pages.guru.nilai.index', [
            'rombel' => $this->rombel->getRombelGuru($guru->nomor_induk_yayasan, $tahun_ajaran_id),
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function show_siswa($tahun, $semester, $rombel, Request $request)
    {
        $guru_ = $this->auth->getUser('guru');
        $guru = $this->guru->getById($guru_->id);
        if ($request->has("mapel_id") && $request->has('tipe_ujian')) {
            return view('pages.guru.nilai.nilai', [
                'rombel' => $this->rombel->getOne(Crypt::decrypt($rombel)),
                'mapel' => $guru->mapels,
                'guru' => $guru,
                'nilais' => $this->nilai->getNilaiByParams(
                    Crypt::decrypt($rombel), $request->mapel_id, $request->tipe_ujian, $request->semester, $this->tahun_ajaran->getId($tahun, $semester)
                )->get(),
                'tahun' => $tahun,
                'semester' => $semester,
                'tahun_ajaran_id' => $this->tahun_ajaran->getId($tahun, $semester),
            ]);
        }

        return view('pages.guru.nilai.nilai', [
            'rombel' => $this->rombel->getOne(Crypt::decrypt($rombel)),
            'mapel' => $guru->mapels,
            'guru' => $guru,
            'nilais' => $this->nilai->getNilai(Crypt::decrypt($rombel), $guru->mapels[0]->id, $this->tahun_ajaran->getId($tahun, $semester))->get(),
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran_id' => $this->tahun_ajaran->getId($tahun, $semester),
        ]);
    }
    public function getNilai_guru(Request $request)
    {
        $nilai = $this->nilai->getNilai($request->rombel_id, $request->mapel_id, $request->tahun_ajaran_id)
            ->paginate(5);
        return response($nilai);
    }
    public function filter(Request $request)
    {
        $guru = auth()->guard('guru')->user();
        $nilai = $this->nilai->getNilaiByParams(
            $request->rombel_id,
            $request->mapel_id,
            $request->tipe_ujian,
            $request->semester,
            $request->tahun_ajaran_id
        )->paginate(5);
        return response($nilai);
    }

    public function show_input($tahun, $semester, $tipe_ujian, Rombel $rombel)
    {
        // dd($this->siswa->getSiswa($rombel->id));
        $guru_ = $this->auth->getUser('guru');
        $guru = $this->guru->getById($guru_->id);
        return view('pages.guru.nilai.tambah_nilai', [
            'guru' => $guru,
            'rombel' => $this->rombel->getOne($rombel->id),
            'mapel' => $guru->mapels,
            'siswas' => $this->siswa->getSiswa($rombel->id),
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran_id' => $this->tahun_ajaran->getId($tahun, $semester),
            'tipe_ujian' => $tipe_ujian,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->nilai->store($request->all());
            return redirect()->route('guru.nilai.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => Crypt::encrypt($request->rombel_id)])
                ->with('message', 'Berhasil menambah data nilai');
        } catch (ValidationException $er) {
            return redirect()->route('guru.nilai.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => Crypt::encrypt($request->rombel_id)])
                ->with('error', $er->getMessage());
        }

    }

    public function update(Request $request, $nilai)
    {

        try {
            $this->nilai->update($request->all(), $nilai);
            return redirect()->route('guru.nilai.show_siswa', ['tahun' => $request->tahun_ajaran_, 'semester' => $request->semester_, 'rombel' => Crypt::encrypt($request->rombel_id)])
                ->with('message', 'Berhasil mengubah data nilai');
        } catch (QueryException $er) {
            return redirect()->route('guru.nilai.show_siswa', ['tahun' => $request->tahun_ajaran_, 'semester' => $request->semester_, 'rombel' => Crypt::encrypt($request->rombel_id)])
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

    public function admin_show_nilai($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $rombel = $this->rombel->getAll($tahun_ajaran_id);
        return view('pages.admin.nilai.index', [
            'rombel' => $rombel,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function admin_detail_nilai($tahun, $semester, Rombel $rombel)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $rombel = $this->rombel->getOne($rombel->id);
        return view('pages.admin.nilai.detail_nilai', [
            'tahun' => $tahun,
            'semester' => $semester,
            'rombel' => $rombel,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'gurus' => $rombel->gurus,
        ]);
    }
    public function admin_get_nilai(Request $request)
    {
        $mapel = MataPelajaran::where('nama_mata_pelajaran', $request->nama_mapel)->first();
        $nilai = $this->nilai->getNilaiByParams(
            $request->rombel_id,
            $mapel->id,
            $request->tipe_ujian,
            $request->semester,
            $request->tahun_ajaran_id
        )->get();
        return response($nilai);
    }
}
