<?php

namespace App\Models;

use App\Traits\uuid;
use App\Models\Siswa;
use App\Models\Rombel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kehadiran extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'rombel_id',
        'tanggal',
    ];

    public function rombels()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class)->withPivot('kehadiran');
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
