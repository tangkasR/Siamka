<?php

namespace App\Models;

use Throwable;
use App\Models\Guru;
use App\Traits\uuid;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Ekskul;
use App\Models\Rombel;
use App\Models\Kehadiran;
use App\Models\NilaiEkskul;
use App\Models\KehadiranGuru;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory, uuid;

    protected $fillable = [
        'tahun_ajaran',
        'semester',
    ];

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'tahun_ajaran_id', 'id');
    }
    public function gurus()
    {
        return $this->hasMany(Guru::class, 'tahun_ajaran_id', 'id');
    }
    public function kehadiran_gurus()
    {
        return $this->hasMany(KehadiranGuru::class, 'tahun_ajaran_id', 'id');
    }
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'tahun_ajaran_id', 'id');
    }
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'tahun_ajaran_id', 'id');
    }
    public function nilai_ekskuls()
    {
        return $this->hasMany(NilaiEkskul::class, 'tahun_ajaran_id', 'id');
    }
    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'tahun_ajaran_id', 'id');
    }
    public function rombels()
    {
        return $this->hasMany(Rombel::class, 'tahun_ajaran_id', 'id');
    }
    public function ekskuls()
    {
        return $this->hasMany(Ekskul::class, 'tahun_ajaran_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }

    public function getRouteKey()
    {
        return Crypt::encrypt($this->uuid);
    }
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $decrypted = Crypt::decrypt($value);
            $field = $field ?? $this->getRouteKeyName();

            return parent::resolveRouteBinding($decrypted, $field);
        } catch (Throwable $er) {
            abort(404);
        }
    }
}
