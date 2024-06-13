<?php

namespace App\Models;

use App\Models\Guru;
use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rombel extends Model
{
    use HasFactory, uuid;

    protected $fillable = [
        'guru_id',
        'nama_rombel',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'rombel_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class);
    }

    public function gurus()
    {
        return $this->belongsToMany(Guru::class);
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
