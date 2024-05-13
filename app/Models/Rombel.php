<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'nama_rombel',
    ];

    public function gurus()
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
}
