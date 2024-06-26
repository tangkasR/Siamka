<?php

namespace App\Models;

use App\Models\Ekskul;
use App\Models\JadwalPelajaran;
use App\Models\KehadiranGuru;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class Guru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, uuid;

    protected $fillable = [
        'mata_pelajaran_id',
        'nama',
        'jabatan',
        'nomor_induk_yayasan',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'alamat',
        'pendidikan_terakhir',
        'no_hp',
        'profil',
        'ktp',
        'ijazah',
        'kartu_keluarga',
        'username',
        'password',
        'tahun_ajaran_id',
        'status_akun',
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

    public function mapels()
    {
        return $this->belongsToMany(MataPelajaran::class);
    }

    public function rombel()
    {
        return $this->hasOne(Rombel::class);
    }
    public function kehadiran_gurus()
    {
        return $this->hasMany(KehadiranGuru::class);
    }
    public function ekskuls()
    {
        return $this->hasMany(Ekskul::class, 'guru_id', 'id');
    }
    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'guru_id', 'id');
    }
    public function rombels()
    {
        return $this->belongsToMany(Rombel::class);
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
