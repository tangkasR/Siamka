<?php

namespace App\Services;

use App\Interfaces\PengumumanInterface;
use DOMDocument;
use Illuminate\Validation\ValidationException;

class PengumumanService
{
    private $pengumuman;

    public function __construct(PengumumanInterface $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }
    public function getAll()
    {
        return $this->pengumuman->get()->get();
    }
    public function getById($id)
    {
        return $this->pengumuman->get()->where('id', $id)->first();
    }
    public function paginate($limit)
    {
        return $this->pengumuman->get()->paginate($limit);
    }
    public function store($datas)
    {
        if (isset($datas['image'])) {
            $datas['image'] = $this->handleStoreAs('pengumuman', $datas['image']);
        } else {
            $datas['image'] = '-';
        }
        $datas['deskripsi'] = $this->handleImgDescription($datas);
        return $this->pengumuman->store($datas);
    }
    public function update($datas, $id)
    {
        $data = $this->pengumuman->get()->where('id', $id)->first();
        $oldDescription = $data->deskripsi;
        $newDescription = $datas['deskripsi'];

        if ($oldDescription !== $newDescription) {
            $dom = new DOMDocument();
            @$dom->loadHTML($oldDescription, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $oldImages = $dom->getElementsByTagName('img');
            $oldImagePaths = [];

            foreach ($oldImages as $img) {
                $oldImagePaths[] = public_path($img->getAttribute('src'));
            }

            $datas['deskripsi'] = $this->handleImgDescription($datas);

            // Check if new description contains new images
            @$dom->loadHTML($datas['deskripsi'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $newImages = $dom->getElementsByTagName('img');
            $newImagePaths = [];

            foreach ($newImages as $img) {
                $newImagePaths[] = public_path($img->getAttribute('src'));
            }

            // Delete old images if not present in the new images
            foreach ($oldImagePaths as $oldImagePath) {
                if (!in_array($oldImagePath, $newImagePaths) && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $oldPath = storage_path('app/public/pengumuman/' . $datas['old_image']);
        if (file_exists($oldPath)) {
            if (isset($datas['image'])) {
                unlink($oldPath);
                $datas['image'] = $this->handleStoreAs('pengumuman', $datas['image']);
            } else {
                $datas['image'] = $datas['old_image'];
            }
        } else {
            if (isset($datas['image'])) {
                $datas['image'] = $this->handleStoreAs('pengumuman', $datas['image']);
            } else {
                $datas['image'] = '-';
            }
        }

        return $this->pengumuman->update($datas, $id);
    }

    public function destroy($id)
    {
        $data = $this->pengumuman->get()->where('id', $id)->first();

        $dom = new DOMDocument();
        @$dom->loadHTML($data->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $path = $img->getAttribute('src');
            $path_ = public_path($path);

            if (file_exists($path_)) {
                unlink($path_);
            }
        }
        $oldPath = storage_path('app/public/pengumuman/' . $data->image);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
        return $this->pengumuman->destroy($id);
    }
    private function handleStoreAs($new_path, $new_file)
    {
        $ext = $new_file->getClientOriginalExtension();
        $new_file_name = $new_path . '-' . rand(0, 9999999) . '.' . $ext;
        $new_file->storeAs('public/' . $new_path, $new_file_name);
        return $new_file_name;
    }
    private function handleImgDescription($datas)
    {
        $description = $datas['deskripsi'];
        $dom = new DOMDocument();
        @$dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        $publicPath = public_path('assets/img/deskripsi_img');

        $maxFileSize = 2 * 500 * 500; // 500KB

        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0755, true);
        }

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');

            // Check if the src is a base64 encoded image
            if (preg_match('/^data:image\/(jpeg|png|gif|bmp);base64,/', $src)) {
                $data = base64_decode(preg_replace('/^data:image\/(jpeg|png|gif|bmp);base64,/', '', $src));

                $fileSize = strlen($data); // Get the size of the decoded data

                if ($fileSize > $maxFileSize) {
                    throw ValidationException::withMessages(['error' => 'File image deskripsi harus kurang dari 500kb']);
                }

                $image_name = "/assets/img/deskripsi_img/" . time() . $key . '.png';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        return $dom->saveHTML();
    }
}
