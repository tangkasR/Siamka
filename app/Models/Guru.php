<?php

namespace App\Models;

use App\Models\Ekskul;
use App\Models\KehadiranGuru;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mata_pelajarans()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }

    public function rombels()
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
}
