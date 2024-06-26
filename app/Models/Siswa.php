<?php

namespace App\Models;

use App\Models\Ekskul;
use App\Models\Kehadiran;
use App\Models\Nilai;
use App\Models\NilaiEkskul;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, uuid;

    protected $fillable = [
        'nis',
        'nisn',
        'nomor_id',
        'nama',
        'jenis_kelamin',
        'nik',
        'tempat_tanggal_lahir',
        'alamat',
        'no_hp',
        'kompetensi_keahlian',
        'agama',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_orang_tua',
        'no_hp_orang_tua',
        'asal_smp',
        'tahun_lulus_smp',
        'username',
        'password',
        'status_siswa',
        'aktivasi_akun',
        'profil',
        'tahun_ajaran_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }
    public function rombels()
    {
        return $this->belongsToMany(Rombel::class);
    }
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'siswa_id', 'id');
    }
    public function nilai_ekskuls()
    {
        return $this->hasMany(NilaiEkskul::class, 'siswa_id', 'id');
    }
    public function kehadirans()
    {
        return $this->belongsToMany(Kehadiran::class);
    }
    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class);
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
