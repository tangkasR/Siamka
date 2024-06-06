<?php

namespace App\Repositories;

use App\Interfaces\PengumumanInterface;
use App\Models\Pengumuman;

class PengumumanRepository implements PengumumanInterface
{
    private $pengumuman;

    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    public function get()
    {
        return $this->pengumuman->orderBy('created_at', 'desc');
    }

    public function store($datas)
    {

        return $this->pengumuman->create([
            'image' => $datas['image'],
            'judul' => $datas['judul'],
            'deskripsi' => $datas['deskripsi'],
        ]);
    }
    public function update($datas, $id)
    {
        return $this->pengumuman->where('id', $id)->update([
            'image' => $datas['image'],
            'judul' => $datas['judul'],
            'deskripsi' => $datas['deskripsi'],
        ]);
    }
    public function destroy($id)
    {
        return $this->pengumuman->where('id', $id)->delete();
    }
}
