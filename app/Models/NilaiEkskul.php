<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\Ekskul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiEkskul extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'siswa_id',
        'ekskul_id',
        'nilai',
        'semester',
    ];
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function ekskuls()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id', 'id');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
