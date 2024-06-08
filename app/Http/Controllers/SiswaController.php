<?php

namespace App\Http\Controllers;

use App\Charts\NilaiChart;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\JadwalPelajaranService;
use App\Services\KehadiranService;
use App\Services\NilaiEkskulService;
use App\Services\NilaiService;
use App\Services\RombelService;
use App\Services\SesiService;
use App\Services\SiswaService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
    }
    public function index()
    {
        return view('pages.admin.siswa.index', [
            'rombel' => $this->rombel->getAll(),
        ]);
    }
    public function show_siswa(Request $request, $id)
    {
        $tahun_awal = $this->date->getDate()->year;
        $tahun_akhir = $tahun_awal + 1;
        $tahun_pembelajaran = $tahun_awal . '/' . $tahun_akhir;

        return view('pages.admin.siswa.siswa', [
            'siswa' => $this->siswa->getByRombelIdActive($id),
            'rombel' => $this->rombel->getOne('id', $id),
            'rombels' => $this->rombel->getAll(),
            'admin' => $this->auth->getUser('admin')->username,
            'tahun_pembelajaran' => $tahun_pembelajaran,
        ]);
    }
    public function detail_siswa($id)
    {
        return view('pages.admin.siswa.show-siswa', [
            'siswa' => $this->siswa->getById($id),
        ]);
    }
    public function store(Request $request)
    {
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        try {
            $this->siswa->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');
        } catch (QueryException $er) {
            dd($er);
            return redirect()->back()->with('error', 'Gagal menambah data');
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
                return view('pages.Siswa.data-kehadiran', [
                    'bulan' => $bulan,
                    'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->id, $tahun),
                    'siswa' => $siswa,
                    'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
                    'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
                    'listBulan' => $listBulan,
                    'years' => $this->kehadiran->getYear(),
                ]);
            }
        }

        return view('pages.siswa.kehadiran', [
            'bulan' => $bulan,
            'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->id, $tahun),
            'siswa' => $siswa,
            'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'listBulan' => $listBulan,
            'years' => $this->kehadiran->getYear(),
        ]);
    }
    public function get_kehadiran(Request $request)
    {
        $siswa = $this->auth->getUser('siswa');
        $kehadiran = $this->kehadiran->getBySiswaId(
            $siswa->id,
            $this->date->getDate()->month,
            $this->date->getDate()->year)
            ->paginate(5);
        return response($kehadiran);
    }
    public function filter_kehadiran(Request $request)
    {
        $siswa = $this->auth->getUser('siswa');
        $kehadiran = $this->kehadiran->getBySiswaId(
            $siswa->id,
            $request->month,
            $request->year)
            ->paginate(5);
        return response($kehadiran);
    }
    public function show_nilai()
    {
        $siswa = $this->auth->getUser('siswa');

        $tipe_ujian = '';
        if (count($this->nilai->getNilaiByParams('siswa_id', $siswa->id)->get()) != 0) {
            $tipe_ujian = $this->nilai->getNilaiByParams('siswa_id', $siswa->id)->first()->tipe_ujian;
        }

        $data = $this->nilai->getNilaiUasGroupByMapel($siswa->id);
        $formattedData = [];
        $semesters = [];
        foreach ($data as $subject => $records) {
            foreach ($records as $record) {
                $semesters["SEMESTER {$record->semester}"] = true;
            }
        }
        $semesters = array_keys($semesters);

        foreach ($data as $subject => $records) {
            $row = ['MATA PELAJARAN' => $subject];
            foreach ($semesters as $semester) {
                $row[$semester] = null;
            }
            foreach ($records as $record) {
                $row["SEMESTER {$record->semester}"] = $record->nilai;
                $row["tipe_ujian"] = 'UAS';
            }
            $formattedData[] = $row;
        }
        return view('pages.siswa.nilai', [
            'nilai' => [],
            'tipe_ujian' => $tipe_ujian,
            'chart' => $this->chart->build(),
            'semesters' => $semesters,
            'formattedData' => $formattedData,
            'siswa' => $siswa,
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
            'nilai_ekskuls' => $this->nilai_ekskul->rekap($siswa->id),
        ]);
    }
    public function getNilai(Request $request)
    {
        $siswa = $this->auth->getUser('siswa');
        $nilai = $this->nilai->getNilaiByParams('siswa_id', $siswa->id)->paginate(10);

        return response($nilai);
    }
    public function filter_nilai(Request $request)
    {
        $siswa = $this->auth->getUser('siswa');
        $nilai = $this->nilai->getNilaiByThreeParams(
            'siswa_id', $siswa->id,
            'tipe_ujian', $request->tipe_ujian,
            'semester', $request->semester
        )->paginate(10);
        return response($nilai);

    }
    public function next_grade(Request $request, $rombel_id)
    {
        try {
            $this->siswa->nextGrade($request->all(), $rombel_id);
            return back()->with('message', 'Berhasil menaikan kelas');
        } catch (ValidationException $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function lulus($rombel_id)
    {
        try {
            $this->siswa->lulus($rombel_id);
            return back()->with('message', 'Berhasil meluluskan siswa');
        } catch (ValidationException $err) {
            return back()->with('error', $err->getMessage());
        }
    }
    public function tambah_aktivasi($rombel_id)
    {
        return view('pages.admin.siswa.aktivasi', [
            'siswas' => $this->siswa->getByRombelIdNotActiveAccount($rombel_id),
            'rombel' => $this->rombel->getOne('id', $rombel_id),
        ]);
    }
    public function aktivasi(Request $request)
    {
        try {
            $this->siswa->aktivasi($request->all());
            return redirect()->route('admin.siswa.show_siswa', ['id' => $request->rombel_id])
                ->with('message', 'Berhasil mengaktivasi siswa');
        } catch (ValidationException $err) {
            return redirect()->route('admin.siswa.show_siswa', ['id' => $request->rombel_id])
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
    public function deaktivasiAll($id)
    {
        try {
            $this->siswa->deaktivasiAll($id);
            return redirect()->route('admin.siswa.show_siswa', ['id' => $id])
                ->with('message', 'Berhasil deaktivasi semua siswa');
        } catch (ValidationException $err) {
            return redirect()->route('admin.siswa.show_siswa', ['id' => $id])
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
    public function rekap_kehadiran(Request $request, $id)
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
        $siswa = $this->siswa->getById($id);

        $bulan = $this->date->getDate()->month;
        foreach ($listBulan as $i) {
            if ($i['i'] == $bulan) {
                $bulan = $i['bulan'];
            }
        }
        if ($request->ajax()) {
            if ($request->tahun) {
                $tahun = $request->tahun;
                return view('pages.admin.siswa.data-kehadiran', [
                    'bulan' => $bulan,
                    'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->id, $tahun),
                    'siswa' => $siswa,
                    'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
                    'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
                    'listBulan' => $listBulan,
                    'years' => $this->kehadiran->getYear(),
                ]);
            }
        }
        return view('pages.admin.siswa.rekap-kehadiran', [
            'bulan' => $bulan,
            'kehadirans' => $this->kehadiran->getMonthlyAttendance($siswa->id, $tahun),
            'siswa' => $siswa,
            'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'listBulan' => $listBulan,
            'years' => $this->kehadiran->getYear(),
        ]);
    }
    public function rekap_nilai($id)
    {
        $data = $this->nilai->getNilaiUasGroupByMapel($id);
        $formattedData = [];
        $semesters = [];
        foreach ($data as $subject => $records) {
            foreach ($records as $record) {
                $semesters["Semester {$record->semester}"] = true;
            }
        }
        $semesters = array_keys($semesters);

        foreach ($data as $subject => $records) {
            $row = ['Mata Pelajaran' => $subject];
            foreach ($semesters as $semester) {
                $row[$semester] = null;
            }
            foreach ($records as $record) {
                $row["Semester {$record->semester}"] = $record->nilai;
                $row["tipe_ujian"] = 'UAS';
            }
            $formattedData[] = $row;
        }

        $siswa = $this->siswa->getById($id);
        return view('pages.admin.siswa.rekap-nilai', [
            'semesters' => $semesters,
            'formattedData' => $formattedData,
            'siswa' => $siswa,
            'rombel' => $this->rombel->getBySiswaId($siswa->id)->last(),
            'tahun_pembelajaran' => $this->siswa->getPivotTahunPembelajaran($siswa->id),
            'nilai_ekskuls' => $this->nilai_ekskul->rekap($siswa->id),
        ]);
    }
    public function siswa_not_active()
    {
        return view('pages.admin.siswa.not_active', [
            'siswas' => $this->siswa->getNotActive(),
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
        ]);
    }
    public function clear_data()
    {
        try {
            $siswas = $this->siswa->getNotActiveClear($this->date->getDate()->year);
            // dd($siswas);
            if (count($siswas) > 0) {
                foreach ($siswas as $data) {
                    $path = storage_path('app/public/' . $data->profil);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $siswa = $this->siswa->getById($data->id);
                    $siswa->ekskuls()->detach();
                    $siswa->kehadirans()->detach();
                    $this->nilai->getNilaiByParams('siswa_id', $data->id)->delete();
                    $this->nilai_ekskul->destroy('siswa_id', $data->id);
                }
                foreach ($siswas as $data) {
                    $this->siswa->destroy($data->id);
                }
                return redirect()->back()
                    ->with('message', 'Berhasil menghapus semua data siswa yang sudah tidak aktif lebih dari 5 tahun');
            }
            return redirect()->back()
                ->with('error', 'Sudah tidak data siswa yang tidak aktif lebih dari 5 tahun');
        } catch (ValidationException $err) {
            return redirect()->back()
                ->with('error', $err->getMessage());
        }
    }
    public function show_ekskul()
    {
        $siswa = $this->auth->getUser('siswa');
        return view('pages.siswa.ekskul', [
            'ekskuls' => $this->siswa->getById($siswa->id)->ekskuls,
        ]);
    }
}
