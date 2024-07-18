<?php

namespace App\Http\Controllers;

use App\Charts\NilaiChart;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\EkskulService;
use App\Services\JadwalPelajaranService;
use App\Services\KehadiranService;
use App\Services\NilaiEkskulService;
use App\Services\NilaiService;
use App\Services\RombelService;
use App\Services\SesiService;
use App\Services\SiswaService;
use App\Services\TahunAjaranService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class SiswaController extends Controller
{
    private $siswa;
    private $rombel;
    private $auth;
    private $sesi;
    private $jadwal;
    private $nilai;
    private $chart;
    private $kehadiran;
    private $nilai_ekskul;
    private $date;
    private $tahun_ajaran;
    private $ekskul;

    public function __construct(
        SiswaService $siswa,
        RombelService $rombel,
        AuthService $auth,
        SesiService $sesi,
        JadwalPelajaranService $jadwal,
        NilaiService $nilai,
        NilaiChart $chart,
        KehadiranService $kehadiran,
        NilaiEkskulService $nilai_ekskul,
        DateService $date,
        TahunAjaranService $tahun_ajaran,
        EkskulService $ekskul
    ) {
        $this->siswa = $siswa;
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->sesi = $sesi;
        $this->jadwal = $jadwal;
        $this->nilai = $nilai;
        $this->chart = $chart;
        $this->kehadiran = $kehadiran;
        $this->nilai_ekskul = $nilai_ekskul;
        $this->date = $date;
        $this->tahun_ajaran = $tahun_ajaran;
        $this->ekskul = $ekskul;
    }
    public function show_siswa($tahun, $semester, Rombel $rombel)
    {

        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $tahun_ajaran = $this->tahun_ajaran->getById($tahun_ajaran_id);

        return view('pages.admin.siswa.siswa', [
            'siswa' => $this->siswa->getSiswaAdmin($rombel->id),
            'rombel' => $rombel,
            'rombels' => $this->rombel->getAll($tahun_ajaran_id),
            'admin' => $this->auth->getUser('admin')->username,
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'tahun_ajaran' => $tahun_ajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);
    }
    public function detail_siswa($tahun, $semester, Rombel $rombel, $id)
    {

        try {
            return view('pages.admin.siswa.show-siswa', [
                'siswa' => $this->siswa->getById(Crypt::decrypt($id)),
                'tahun' => $tahun,
                'semester' => $semester,
                'rombel' => $rombel,
            ]);
        } catch (DecryptException $err) {
            return abort(404);
        }
    }
    public function store(Request $request)
    {
        $rombel = $this->rombel->getOne($request->rombel_id);
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        try {
            $this->siswa->store($request->all());
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('message', 'Berhasil menambah data');
        } catch (ValidationException $er) {
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('error', $er->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            if ($request->status_siswa != 'belum lulus') {
                $checkStatusAkun = $this->siswa->getById($id);
                if ($checkStatusAkun->aktivasi_akun == 'aktif') {
                    return redirect()->back()->with('error', 'Sebelum mengubah status siswa tolong non aktifkan akun dulu!');
                }
            }
            $this->siswa->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function move_class(Request $request, $id)
    {
        try {
            $this->siswa->moveClass($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil memindahkan siswa');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal memindahkan siswa');
        }
    }
    public function destroy($id)
    {
        try {
            $this->siswa->destroy($id);
            return back()->with('message', 'Berhasil menghapus data');
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }

    public function profil()
    {
        $siswa = $this->siswa->getById($this->auth->getUser('siswa')->id);
        return view('pages.siswa.profil', [
            'siswa' => $siswa,
            'rombel' => $siswa->rombels->last(),
        ]);
    }

    public function show_jadwal()
    {
        $siswa = $this->siswa->getById($this->auth->getUser('siswa')->id);
        return view('pages.siswa.jadwal_pelajaran', [
            'jadwal_pelajaran' => $this->jadwal->getByRombelId($siswa->rombels->last()->id),
            'sesi_perhari' => $this->sesi->getAll(),
        ]);
    }
    public function show_kehadiran(Request $request)
    {
        $tahun = $this->date->getDate()->year;
        $listBulan = [
            ['i' => '1', 'bulan' => 'Januari'],
            ['i' => '2', 'bulan' => 'Februari'],
            ['i' => '3', 'bulan' => 'Maret'],
            ['i' => '4', 'bulan' => 'April'],
            ['i' => '5', 'bulan' => 'Mei'],
            ['i' => '6', 'bulan' => 'Juni'],
            ['i' => '7', 'bulan' => 'Juli'],
            ['i' => '8', 'bulan' => 'Agustus'],
            ['i' => '9', 'bulan' => 'September'],
            ['i' => '10', 'bulan' => 'Oktober'],
            ['i' => '11', 'bulan' => 'November'],
            ['i' => '12', 'bulan' => 'Desember'],
        ];
        $siswa = $this->auth->getUser('siswa');

        $bulan = $this->date->getDate()->month;
        foreach ($listBulan as $i) {
            if ($i['i'] == $bulan) {
                $bulan = $i['bulan'];
            }
        }
        if ($request->ajax()) {
            if ($request->tahun) {
                $tahun = $request->tahun;
                return view('pages.siswa.data-kehadiran', [
                    'bulan' => $bulan,
                    'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->nis, $tahun),
                    'siswa' => $siswa,
                    'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
                    'listBulan' => $listBulan,
                    'years' => $this->kehadiran->getYear(),
                    'tahun_ajaran' => $this->kehadiran->getTahunAjaranNow(),
                ]);
            }
        }

        return view('pages.siswa.kehadiran', [
            'bulan' => $bulan,
            'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->nis, $tahun),
            'siswa' => $siswa,
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'listBulan' => $listBulan,
            'years' => $this->kehadiran->getYear(),
            'tahun_ajaran' => $this->kehadiran->getTahunAjaranNow(),
        ]);
    }
    public function get_kehadiran(Request $request)
    {
        $kehadiran = $this->kehadiran->getBySiswaId(
            $request->nis,
            $this->date->getDate()->month,
            $this->date->getDate()->year)
            ->paginate(5);
        return response($kehadiran);
    }
    public function filter_kehadiran(Request $request)
    {
        $kehadiran = $this->kehadiran->getBySiswaId(
            $request->nis,
            $request->month,
            $request->year)
            ->paginate(5);
        return response($kehadiran);
    }
    public function show_nilai()
    {
        $siswa = $this->auth->getUser('siswa');
        $nilais = $this->nilai->getByNisSiswa($siswa->nis);

        // Inisialisasi array data
        $data = [];
        $semesters = [];

        // Grupkan data berdasarkan mata pelajaran
        foreach ($nilais as $nilai) {
            $mataPelajaranNama = $nilai->nama_mata_pelajaran;
            $tipeUjian = $nilai->tipe_ujian;
            $semester = $nilai->semester;
            $nilaiValue = $nilai->nilai;

            // Tambahkan semester ke array semesters jika belum ada
            if (!in_array($semester, $semesters)) {
                $semesters[] = $semester;
            }

            if (!isset($data[$mataPelajaranNama])) {
                $data[$mataPelajaranNama] = [
                    'uts' => [],
                    'uas' => [],
                ];
            }

            $data[$mataPelajaranNama][$tipeUjian][$semester] = $nilaiValue;
        }
        // Urutkan semesters
        sort($semesters);

        return view('pages.siswa.nilai', [
            'chart' => $this->chart->build(),
            'siswa' => $siswa,
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'nilai_ekskuls' => $this->nilai_ekskul->rekap($siswa->nis),
            'nilais' => $data,
            'semesters' => $semesters,
        ]);
    }
    public function getNilai(Request $request)
    {
        $nilai = $this->nilai->getNilaiBySiswa($request->semester, $request->tipe_ujian, $request->nis)->paginate(10);

        return response($nilai);
    }
    public function filter_nilai(Request $request)
    {
        $nilai = $this->nilai->getNilaiBySiswa($request->semester, $request->tipe_ujian, $request->nis)->paginate(10);
        return response($nilai);

    }

    public function aktivasi(Request $request)
    {
        try {
            $this->siswa->aktivasi($request->all());
            return redirect()->back()
                ->with('message', 'Berhasil mengaktivasi siswa');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
    public function update_profil(Request $request)
    {
        $validator = $request->validate([
            'profil' => 'required|max:10000|mimes:jpg,png,jpeg',
        ], [
            'profil.max' => 'File foto harus kurang dari 200kb!',
            'profil.required' => 'File foto harus dimasukan!',
            'profil.mimes' => 'Format File foto harus jpg atau png atau jpeg!',
        ]);
        $this->siswa->update_profil($request->all());
        return back()->with('message', 'Berhasil mengubah profil siswa');

    }
    public function aktivasiAll(Rombel $rombel)
    {
        try {
            $this->siswa->aktivasiAll($rombel);
            return redirect()->back()
                ->with('message', 'Berhasil aktivasi semua siswa');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
    public function deaktivasiAll(Rombel $rombel)
    {
        try {
            $this->siswa->deaktivasiAll($rombel);
            return redirect()->back()
                ->with('message', 'Berhasil deaktivasi semua siswa');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
    public function deaktivasi($id)
    {
        try {
            $this->siswa->deaktivasi($id);
            return redirect()->back()
                ->with('message', 'Berhasil deaktivasi siswa');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }

    public function rekap_kehadiran($tahun, $semester, Rombel $rombel, Request $request, $id)
    {
        $tahun_ = $tahun;
        $semester_ = $semester;
        $siswa = $this->siswa->getById(Crypt::decrypt($id));
        $bulan = $this->date->getDate()->month;

        $listBulan = [
            ['i' => '1', 'bulan' => 'Januari'],
            ['i' => '2', 'bulan' => 'Februari'],
            ['i' => '3', 'bulan' => 'Maret'],
            ['i' => '4', 'bulan' => 'April'],
            ['i' => '5', 'bulan' => 'Mei'],
            ['i' => '6', 'bulan' => 'Juni'],
            ['i' => '7', 'bulan' => 'Juli'],
            ['i' => '8', 'bulan' => 'Agustus'],
            ['i' => '9', 'bulan' => 'September'],
            ['i' => '10', 'bulan' => 'Oktober'],
            ['i' => '11', 'bulan' => 'November'],
            ['i' => '12', 'bulan' => 'Desember'],
        ];

        foreach ($listBulan as $i) {
            if ($i['i'] == $bulan) {
                $bulan = $i['bulan'];
            }
        }
        $month_ = $this->date->getDate()->format('Y-m');
        return view('pages.admin.siswa.rekap-kehadiran', [
            'bulan' => $bulan,
            'kehadirans' => [],
            'siswa' => $siswa,
            'listBulan' => $listBulan,
            'years' => $this->kehadiran->getYear(),
            'tahun_ajaran' => $this->kehadiran->getTahunAjaranNow(),
            'tahun' => $tahun_,
            'semester' => $semester_,
            'rombel' => $rombel,
            'month_val' => $month_,
        ]);
    }
    public function getDataRekapKehadiran(Request $request)
    {
        $bulan = $this->date->getDate()->month;

        $listBulan = [
            ['i' => '1', 'bulan' => 'Januari'],
            ['i' => '2', 'bulan' => 'Februari'],
            ['i' => '3', 'bulan' => 'Maret'],
            ['i' => '4', 'bulan' => 'April'],
            ['i' => '5', 'bulan' => 'Mei'],
            ['i' => '6', 'bulan' => 'Juni'],
            ['i' => '7', 'bulan' => 'Juli'],
            ['i' => '8', 'bulan' => 'Agustus'],
            ['i' => '9', 'bulan' => 'September'],
            ['i' => '10', 'bulan' => 'Oktober'],
            ['i' => '11', 'bulan' => 'November'],
            ['i' => '12', 'bulan' => 'Desember'],
        ];

        foreach ($listBulan as $i) {
            if ($i['i'] == $bulan) {
                $bulan = $i['bulan'];
            }
        }
        return view('pages.siswa.data-kehadiran', [
            'kehadirans' => $this->kehadiran->getMonthlyAttendance($request->nis, $request->tahun),
            'listBulan' => $listBulan,
        ]);
    }
    public function rekap_nilai($tahun, $semester, Rombel $rombel, $id)
    {
        $tahun_ = $tahun;
        $semester_ = $semester;
        $siswa = $this->siswa->getById(Crypt::decrypt($id));
        $nilais = $this->nilai->getByNisSiswa($siswa->nis);

        // Inisialisasi array data
        $data = [];
        $semesters = [];

        // Grupkan data berdasarkan mata pelajaran
        foreach ($nilais as $nilai) {
            $mataPelajaranNama = $nilai->nama_mata_pelajaran;
            $tipeUjian = $nilai->tipe_ujian;
            $semester = $nilai->semester;
            $nilaiValue = $nilai->nilai;

            // Tambahkan semester ke array semesters jika belum ada
            if (!in_array($semester, $semesters)) {
                $semesters[] = $semester;
            }

            if (!isset($data[$mataPelajaranNama])) {
                $data[$mataPelajaranNama] = [
                    'uts' => [],
                    'uas' => [],
                ];
            }

            $data[$mataPelajaranNama][$tipeUjian][$semester] = $nilaiValue;
        }
        // Urutkan semesters
        sort($semesters);

        return view('pages.admin.siswa.rekap-nilai', [
            'siswa' => $siswa,
            'nilai_ekskuls' => $this->nilai_ekskul->rekap($siswa->id),
            'nilais' => $data,
            'semesters' => $semesters,
            'tahun' => $tahun_,
            'semester' => $semester_,
            'rombel' => $rombel,
        ]);
    }

    public function clear_data($angkatan, $nama_rombel)
    {
        try {
            $siswas = $this->siswa->getNotActive($angkatan, $nama_rombel);
            // dd($siswas);
            if (count($siswas) > 0) {
                foreach ($siswas as $data) {
                    $path = storage_path('app/public/' . $data->profil);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $siswas_ = Siswa::where('nis', $data->nis)->get();
                    foreach ($siswas_ as $item) {
                        if (!is_null($item->ekskuls)) {
                            $item->ekskuls()->detach();
                        }
                        if (!is_null($item->kehadirans)) {
                            $item->kehadirans()->detach();
                        }
                        $this->nilai->clearDataNilai($item->nis);
                        $this->nilai_ekskul->destroy($item->nis);

                        $this->siswa->destroy($item->id);
                    }
                }

                $message = 'Berhasil menghapus semua data siswa di angkatan ' . $angkatan;
                return redirect()->route('admin.siswa.siswa_not_active')
                    ->with('message', $message);
            }
            $message = 'Data siswa di angkatan ' . $angkatan . ' kosong!';
            return redirect()->route('admin.siswa.siswa_not_active')
                ->with('error', $message);
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
    public function show_ekskul()
    {
        $siswa = $this->auth->getUser('siswa');
        return view('pages.siswa.ekskul', [
            'ekskuls' => $this->ekskul->getEkskulSiswa($siswa->nis),
        ]);
    }

    public function show_next_grade($tahun, $semester, Rombel $rombel)
    {
        list($tahun_awal, $tahun_akhir) = explode('-', $tahun);
        $tahun_awal = (int) $tahun_awal + 1;
        $tahun_akhir = (int) $tahun_akhir + 1;
        $tahun_ = $tahun_awal . '-' . $tahun_akhir;
        $semester_ = 'ganjil';
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun_, $semester_);
        if ($tahun_ajaran_id == null) {
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel])
                ->with('error', 'Rombel tujuan di tahun ajaran baru belum dibuat!');
        }
        $rombels = $this->rombel->getAll($tahun_ajaran_id);
        if (count($rombels) == 0) {
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel])
                ->with('error', 'Rombel tujuan di tahun ajaran baru belum dibuat!');
        }
        try {
            return view('pages.admin.siswa.naik_kelas', [
                'siswas' => $this->siswa->getSiswa($rombel->id),
                'tahun' => $tahun_,
                'semester' => $semester_,
                'rombel' => $rombel,
                'tahun_ajaran_id' => $tahun_ajaran_id,
                'rombels' => $rombels,
            ]);
        } catch (ValidationException $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function next_grade(Request $request)
    {
        $rombel = $this->rombel->getOne($request->id_next);
        try {
            $this->siswa->nextGrade($request->all());
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('message', 'Berhasil menaikan kelas');
        } catch (ValidationException $err) {
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $rombel])->with('error', $err->getMessage());
        }
    }
    public function show_lulus($tahun, $semester, Rombel $rombel)
    {
        try {
            return view('pages.admin.siswa.lulus', [
                'siswas' => $this->siswa->getSiswa($rombel->id),
                'rombel' => $this->rombel->getOne($rombel->id),
                'tahun' => $tahun,
                'semester' => $semester,
            ]);
        } catch (ValidationException $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function lulus(Request $request)
    {
        $siswa = $this->siswa->getById($request->siswa_id[0]);
        $last_rombel = $siswa->rombels->last();
        try {
            $this->siswa->lulus($request->all());
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $last_rombel])->with('message', 'Berhasil menaikan kelas');
        } catch (ValidationException $err) {
            return redirect()->route('admin.siswa.show_siswa', ['tahun' => $request->tahun, 'semester' => $request->semester, 'rombel' => $last_rombel])->with('error', $err->getMessage());
        }
    }

    public function tambah_data($tahun, $semester, Rombel $rombel)
    {
        $datas = [];
        return view('pages.admin.siswa.import_data', [
            'tahun' => $tahun,
            'semester' => $semester,
            'datas' => $datas,
            'rombel' => $rombel,
        ]);
    }

    public function keluar($id)
    {
        $this->siswa->keluar($id);
        return back()->with('message', 'Berhasil mengeluarkan siswa');
    }
    public function migrasi(Request $request)
    {
        try {
            $this->siswa->migrasi($request->all());
            return back()->with('message', 'Berhasil mengirim data!');
        } catch (ValidationException $err) {
            return back()->with('error', $er->getMessage());
        }
    }

    public function siswa_not_active_index()
    {
        return view('pages.admin.siswa.siswa_not_active.index', [
            'angkatans' => $this->siswa->getAngkatan(),
        ]);
    }
    public function siswa_not_active_rombel($angkatan)
    {
        // dd($this->siswa->getNotActiveRombel($angkatan));
        return view('pages.admin.siswa.siswa_not_active.daftar_rombel', [
            'angkatan' => $angkatan,
            'rombels' => $this->siswa->getNotActiveRombel($angkatan),
        ]);
    }
    public function siswa_not_active($angkatan, $nama_rombel)
    {
        return view('pages.admin.siswa.siswa_not_active.not_active', [
            'siswas' => $this->siswa->getNotActive($angkatan, $nama_rombel),
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'angkatan' => $angkatan,
            'nama_rombel' => $nama_rombel,
        ]);
    }
}
