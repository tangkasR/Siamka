<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sesi',

    ];

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'sesi_id', 'id');
    }
}
