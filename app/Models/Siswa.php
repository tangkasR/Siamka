<?php

namespace App\Models;

use App\Models\Kehadiran;
use App\Models\Nilai;
use App\Models\Rombel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'password',
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
    public function kehadirans()
    {
        return $this->belongsToMany(Kehadiran::class);
    }
}
