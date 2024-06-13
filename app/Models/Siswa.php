<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\Nilai;
use App\Models\Ekskul;
use App\Models\Rombel;
use App\Models\Kehadiran;
use App\Models\NilaiEkskul;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
}
