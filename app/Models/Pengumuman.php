<?php

namespace App\Models;

use App\Traits\uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory, uuid;
    protected $table = 'pengumumans';
    protected $fillable = [
        'image',
        'judul',
        'deskripsi',
    ];

    public function getRouteKeyName(): String
    {
        return 'uuid';
    }
}
