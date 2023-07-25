<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function storeFile($file, $path, $fileName = null)
    {
        if ($fileName)
            $fileName = $fileName . "." . $file->extension();
        else
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . "." . $file->extension();

        $file->move($path, $fileName);
        return $fileName;
    }

    public function deleteFile($path, $filename)
    {
        Storage::delete("$path/$filename");
        return true;
    }
}
