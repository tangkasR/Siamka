<?php

namespace App\Models;

use App\Models\Guru;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KehadiranGuru extends Model
{
    use HasFactory, uuid;
    protected $fillable = [
        'guru_id',
        'kehadiran',
        'tanggal',
    ];

    public function gurus()
    {
        return $this->belongsTo(Guru::class);
    }

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
