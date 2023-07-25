<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Image;

trait UploadImage
{

    private function resizeImage($file, $size)
    {
        $newFile = Image::make($file);
        $newFile->resize($size, $size, function ($constraint) {
            $constraint->aspectRatio();
        })->save($file);
    }

    public function storeImage($file, $path, $name, $sizes = null)
    {
        if ($name)
            $fileName = $name . "_" . time() . "." . $file->extension();
        else
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . "_" . time() . "." . $file->extension();
        // Store Image Original
        $file->storeAs('public/' . $path . '/original/', $fileName);
        if ($sizes) {
            // Generate Thumbnails
            foreach ($sizes as $size) {
                $file->storeAs("public/$path/thumbnail/$size/", $fileName);
                $image = public_path("storage/$path/thumbnail/$size/$fileName");
                $this->resizeImage($image, $size);
            }
        }
        return $fileName;
    }

    public function deleteImage($path, $filename, $sizes = null)
    {
        // Delete Image Original
        Storage::delete("public/$path/original/$filename");
        // Delete Image Thumbnails
        if ($sizes) {
            foreach ($sizes as $size) {
                Storage::delete("public/$path/thumbnail/$size/$filename");
            }
        }
    }
}
