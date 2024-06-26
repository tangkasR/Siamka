<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use App\Traits\uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Throwable;

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

    public function getRouteKey()
    {
        return Crypt::encrypt($this->uuid);
    }
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $decrypted = Crypt::decrypt($value);
            $field = $field ?? $this->getRouteKeyName();

            return parent::resolveRouteBinding($decrypted, $field);
        } catch (Throwable $er) {
            abort(404);
        }
    }
}
