<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\DateService;
use App\Services\GuruService;
use App\Services\KehadiranGuruService;
use App\Services\MataPelajaranService;
use App\Services\RombelService;
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

    public function __construct(
        GuruService $guru,
        MataPelajaranService $mapel,
        KehadiranGuruService $kehadiran_guru,
        DateService $date,
        RombelService $rombel,
        AuthService $auth
    ) {
        $this->guru = $guru;
        $this->mapel = $mapel;
        $this->kehadiran_guru = $kehadiran_guru;
        $this->date = $date;
        $this->rombel = $rombel;
        $this->auth = $auth;
    }
    public function index()
    {
        // dd($this->guru->getAll());
        return view('pages.admin.guru.guru', [
            'guru' => $this->guru->getAll(),
            'mapel' => $this->mapel->getAll(),
        ]);
    }

    public function detail_guru($id)
    {
        // dd($this->guru->getById($id));
        return view('pages.admin.guru.show-guru', [
            'guru' => $this->guru->getById($id),
        ]);
    }
    public function store(Request $request)
    {
        try {
            $this->guru->store($request->all());
            return redirect()->back()->with('message', 'Berhasil menambah data');
        } catch (ValidationException $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->guru->update($request->all(), $id);
            return redirect()->back()->with('message', 'Berhasil mengubah data');

        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }
    public function destroy(Request $request, $id)
    {
        try {
            $this->guru->destroy($id);
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
    public function cetak_kehadiran(Request $request, $id)
    {
        $guru = $this->guru->getById($id);
        $tahun = $this->date->getDate()->year;
        if ($request->ajax()) {
            $tahun = $request->tahun;
            return view('pages.admin.guru.data-kehadiran', [
                'guru' => $guru,
                'tanggal' => $this->date->getDate()->format('d-m-Y'),
                'bulan' => $this->date->getDate()->month,
                'tahun' => $this->date->getDate()->year,
                'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->id, $tahun),
                'years' => $this->kehadiran_guru->getYear(),
            ]);
        }
        return view('pages.admin.guru.rekap-kehadiran', [
            'guru' => $guru,
            'tanggal' => $this->date->getDate()->format('d-m-Y'),
            'bulan' => $this->date->getDate()->month,
            'tahun' => $this->date->getDate()->year,
            'rekaps' => $this->kehadiran_guru->rekapKehadiranGuru($guru->id, $tahun),
            'years' => $this->kehadiran_guru->getYear(),
        ]);
    }

    public function download_ktp(Request $request)
    {
        // Mendapatkan path file gambar terenkripsi
        $encryptedPath = storage_path('app/public/' . $request->ktp);

        // Mengecek apakah file terenkripsi ada
        if (!file_exists($encryptedPath)) {
            return response()->json(['error' => 'Encrypted image not found'], 404);
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Decryption failed'], 500);
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
            return response()->json(['error' => 'Encrypted image not found'], 404);
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Decryption failed'], 500);
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
            return response()->json(['error' => 'Encrypted image not found'], 404);
        }

        // Membaca konten gambar terenkripsi
        $encryptedImage = file_get_contents($encryptedPath);

        // Mendekripsi konten gambar
        try {
            $decryptedImage = Crypt::decrypt($encryptedImage);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Decryption failed'], 500);
        }

        // Menyimpan gambar terdekripsi sementara
        $tempDecryptedFileName = 'download_' . $request->kk;
        Storage::put('public/' . $tempDecryptedFileName, $decryptedImage);

        // Mengirimkan file gambar terdekripsi sebagai respon unduhan
        return response()->download(storage_path('app/public/' . $tempDecryptedFileName))->deleteFileAfterSend(true);
    }

    public function tambah_rombel()
    {
        $guru_id = $this->auth->getUser('guru')->id;
        return view('pages.guru.nilai.tambah_rombel', [
            'rombel' => $this->rombel->rombelWithoutGuru($guru_id),
        ]);
    }
    public function store_rombel(Request $request)
    {
        $guru_id = $this->auth->getUser('guru')->id;
        $guru = $this->guru->getById($guru_id);
        if ($request->rombel_ids) {
            foreach ($request->rombel_ids as $rombel_id) {
                $rombel = $this->rombel->getOne('id', $rombel_id);
                $guru->rombels()->attach($rombel);
            }
        }
        return redirect()->route('guru.nilai');
    }
}
