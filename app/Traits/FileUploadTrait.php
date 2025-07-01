<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile($file, $path = 'uploads')
    {
        if ($file) {
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $fileName);
            return $path . '/' . $fileName;
        }
        return null;
    }

    public function updateFile($file, $oldFile, $path = 'uploads')
    {
        if ($file) {
            if ($oldFile && file_exists(public_path($oldFile))) {
                unlink(public_path($oldFile));
            }
            return $this->uploadFile($file, $path);
        }
        return $oldFile;
    }
}
