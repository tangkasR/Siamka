<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sesi extends Model
{
    use HasFactory, uuid;

    protected $fillable = [
        'nama_sesi',

    ];

    public function jadwal_pelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'sesi_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
