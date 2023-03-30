<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class BaseService
{
    public $status;

    public function uploadFile($file)
    {

        $file_path = Storage::disk('local')->put(
            'public/item',
            $file
        );
        $file_path = str_replace('public', 'storage', $file_path);

        return $file_path;
    }

    public function deleteFile($file)
    {
        if (file_exists($file)) {
            File::delete($file);
        }
    }
}
