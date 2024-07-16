<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Rombel;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\GuruService;
use App\Services\KehadiranGuruService;
use App\Services\MataPelajaranService;
use App\Services\RombelService;
use App\Services\SiswaService;
use App\Services\TahunAjaranService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    private $guru;
    private $mapel;
    private $kehadiran_guru;
    private $date;
    private $rombel;
    private $auth;
    private $siswa;
    private $tahun_ajaran;

    public function __construct(
        GuruService $guru,
        MataPelajaranService $mapel,
        KehadiranGuruService $kehadiran_guru,
        DateService $date,
        RombelService $rombel,
        AuthService $auth,
        SiswaService $siswa,
        TahunAjaranService $tahun_ajaran
    ) {
        $this->guru = $guru;
        $this->mapel = $mapel;
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
        $this->rombel = $rombel;
        $this->auth = $auth;
        $this->siswa = $siswa;
        $this->tahun_ajaran = $tahun_ajaran;
    }
    public function index($tahun, $semester)
    {
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $tahun_ajaran = $this->tahun_ajaran->getById($tahun_ajaran_id);
        return view('pages.admin.guru.guru', [
            'guru' => $this->guru->getAll($tahun_ajaran_id),
            'mapels' => $this->mapel->getAll(),
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ]);
    }

    public function detail_guru($tahun, $semester, Guru $guru)
    {
        return view('pages.admin.guru.show-guru', [
            'guru' => $this->guru->getById($guru->id),
            'tahun' => $tahun,
            'semester' => $semester,

        ]);
    }
    public function store(Request $request)
    {
        if ($request->file == null) {
            return back()->with('error', 'Masukan file excel');
        }
        try {
            $this->guru->store($request->all());
            return redirect()->route('admin.guru', ['tahun' => $request->tahun, 'semester' => $request->semester])->with('message', 'Berhasil menambah data');
        } catch (ValidationException $err) {
            return redirect()->route('admin.guru', ['tahun' => $request->tahun, 'semester' => $request->semester])->with('error', $err->getMessage());
        }
    }
    public function update(Request $request, Guru $guru)
    {
        try {
            $this->guru->update($request->all(), $guru);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Request $request, Guru $guru)
    {
        try {
            $this->guru->destroy($guru);
            return redirect()->back()->with('message', 'Berhasil menghapus data');

        } catch (QueryException $er) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
    public function profil()
    {
        return view('pages.guru.profil', [
            'guru' => $this->guru->profil('guru'),
        ]);
    }
    public function update_profil(Request $request)
    {
        $validator = $request->validate([
            'profil' => 'max:500|mimes:jpg, png, jpeg',
            'ktp' => 'max:500|mimes:jpg, png, jpeg',
            'ijazah' => 'max:500|mimes:jpg, png, jpeg',
            'kartu_keluarga' => 'max:500|mimes:jpg, png, jpeg',
        ], [
            'profil.max' => 'File foto harus kurang dari 500kb!',
            'ktp.max' => 'File KTP harus kurang dari 500kb!',
            'ijazah.max' => 'File ijazah harus kurang dari 500kb!',
            'kartu_keluarga.max' => 'File kartu keluarga harus kurang dari 500kb!',
            'profil.mimes' => 'Format File foto harus jpg atau jpeg atau png!',
            'ktp.mimes' => 'Format File KTP harus jpg atau jpeg atau png!',
            'ijazah.mimes' => 'Format File Ijazah harus jpg atau jpeg atau png!',
            'kartu_keluarga.mimes' => 'Format Kartu Keluarga harus jpg atau jpeg atau png!',
        ]);
        $this->guru->updateProfil($request->all());
        return redirect()->route('guru.profil')->with('message', 'Berhasil mengubah profil!');

    }
    public function cetak_kehadiran($tahun, $semester, Request $request, Guru $guru)
    {
        $tahun_ = $this->date->getDate()->year;
        return view('pages.admin.guru.rekap-kehadiran', [
            'guru' => $guru,
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'bulan' => $this->date->getDate()->month,
            'tahun' => $this->date->getDate()->year,
            'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->nomor_induk_yayasan, $tahun_),
            'years' => $this->kehadiran_guru->getYear(),
            'semester' => $semester,
            'tahun_ajaran' => $tahun,
        ]);
    }
    public function filter_kehadiran($tahun, $semester, Request $request)
    {
        $tahun = $request->tahun;
        $niy = $request->niy;
        return view('pages.admin.guru.data-kehadiran', [
            'guru' => $this->guru->getById($request->guru_id),
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'bulan' => $this->date->getDate()->month,
            'tahun' => $this->date->getDate()->year,
            'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($niy, $tahun),
            'years' => $this->kehadiran_guru->getYear(),
            'semester' => $semester,
            'tahun_ajaran' => $tahun,
        ]);
    }

    public function download_ktp(Request $request)
    {
        // Mendapatkan path file gambar terenkripsi
        $encryptedPath = storage_path('app/public/' . $request->ktp);

        // Mengecek apakah file terenkripsi ada
        if (!file_exists($encryptedPath)) {
            return redirect()->back()->with('error', 'File belum ada!');
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return redirect()->back();
        }

        // Menyimpan gambar terdekripsi sementara
        $tempDecryptedFileName = 'download_' . $request->ktp;
        Storage::put('public/' . $tempDecryptedFileName, $decryptedImage);

        // Mengirimkan file gambar terdekripsi sebagai respon unduhan
        return response()->download(storage_path('app/public/' . $tempDecryptedFileName))->deleteFileAfterSend(true);
    }
    public function download_ijazah(Request $request)
    {
        // Mendapatkan path file gambar terenkripsi
        $encryptedPath = storage_path('app/public/' . $request->ijazah);

        // Mengecek apakah file terenkripsi ada
        if (!file_exists($encryptedPath)) {
            return redirect()->back()->with('error', 'File belum ada!');
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return redirect()->back();
        }

        // Menyimpan gambar terdekripsi sementara
        $tempDecryptedFileName = 'download_' . $request->ijazah;
        Storage::put('public/' . $tempDecryptedFileName, $decryptedImage);

        // Mengirimkan file gambar terdekripsi sebagai respon unduhan
        return response()->download(storage_path('app/public/' . $tempDecryptedFileName))->deleteFileAfterSend(true);
    }
    public function download_kk(Request $request)
    {
        // Mendapatkan path file gambar terenkripsi
        $encryptedPath = storage_path('app/public/' . $request->kk);

        // Mengecek apakah file terenkripsi ada
        if (!file_exists($encryptedPath)) {
            return redirect()->back()->with('error', 'File belum ada!');
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return redirect()->back();
        }

        // Menyimpan gambar terdekripsi sementara
        $tempDecryptedFileName = 'download_' . $request->kk;
        Storage::put('public/' . $tempDecryptedFileName, $decryptedImage);

        // Mengirimkan file gambar terdekripsi sebagai respon unduhan
        return response()->download(storage_path('app/public/' . $tempDecryptedFileName))->deleteFileAfterSend(true);
    }

    public function show_rombel_admin($tahun, $semester, Guru $guru)
    {
        $guru = $this->guru->getById($guru->id);
        return view('pages.admin.guru.daftar-rombel', [
            'guru' => $guru,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }

    public function tambah_rombel($tahun, $semester, Guru $guru)
    {
        $guru = $this->guru->getById($guru->id);
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        return view('pages.admin.guru.tambah_rombel', [
            'rombel' => $this->rombel->rombelWithoutGuru($guru->id, $tahun_ajaran_id),
            'guru' => $guru,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }
    public function store_rombel(Request $request, Guru $guru)
    {
        $guru = $this->guru->getById($guru->id);
        if (isset($request->rombel_ids)) {
            foreach ($request->rombel_ids as $rombel_id) {
                $rombel = $this->rombel->getOne($rombel_id);
                $guru->rombels()->attach($rombel);
            }
        }
        return redirect()->route('admin.guru.show_rombel', ['tahun' => $request->tahun_ajaran, 'semester' => $request->semester, 'guru' => $guru])->with('message', 'Berhasil menambah data!');
    }
    public function detach_rombel(Rombel $rombel, Guru $guru)
    {
        $guru = $this->guru->getById($guru->id);
        $rombel = $this->rombel->getOne($rombel->id);
        $guru->rombels()->detach($rombel);
        return redirect()->back()->with('message', 'Berhasil mengeluarkan data!');
    }

    public function wali_kelas($tahun, $semester)
    {
        $guru_ = $this->auth->getUser('guru');
        $tahun_ajaran_id = $this->tahun_ajaran->getId($tahun, $semester);
        $guru = $this->guru->getByNiy($guru_->nomor_induk_yayasan, $tahun_ajaran_id);
        $siswa = null;
        if ($guru->rombel) {
            $siswa = $this->siswa->getSiswa($guru->rombel->id);
        }
        return view('pages.guru.wali_kelas.index', [
            'siswa' => $siswa,
            'rombel' => $guru->rombel,
            'tahun' => $tahun,
            'semester' => $semester,
        ]);
    }

    public function aktivasi($id)
    {
        $this->guru->aktivasi($id);
        return back();
    }
    public function deaktivasi($id)
    {
        $this->guru->deaktivasi($id);
        return back();
    }
    public function aktivasi_all($id)
    {
        $this->guru->aktivasi_all($id);
        return back();
    }
    public function deaktivasi_all($id)
    {
        $this->guru->deaktivasi_all($id);
        return back();
    }
    public function tambah_data($tahun, $semester)
    {
        $datas = [];
        return view('pages.admin.guru.import_data', [
            'tahun' => $tahun,
            'semester' => $semester,
            'datas' => $datas,
        ]);
    }
    public function migrasi(Request $request)
    {
        try {
            $this->guru->migrasi($request->all());
            return back()->with('message', 'Berhasil mengirim data!');
        } catch (ValidationException $er) {
            return back()->with('error', $er->getMessage());
        }
    }
    public function jadwal_mengajar($tahun, $semester)
    {
        dd($this->guru->getById($this->auth->getUser('guru')->id)->jadwal_pelajarans->sortBy('hari'));
        return view('pages.guru.jadwal_mengajar', []);
    }
}
