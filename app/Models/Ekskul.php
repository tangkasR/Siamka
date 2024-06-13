<?php

namespace App\Models;

use App\Models\Guru;
use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\NilaiEkskul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekskul extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'guru_id',
        'nama_ekskul',
        'status',
    ];

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class);
    }
    public function nilai_ekskuls()
    {
        return $this->hasMany(NilaiEkskul::class, 'ekskul_id', 'id');
    }
    public function gurus()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
