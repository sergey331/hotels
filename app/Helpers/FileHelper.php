<?php

namespace App\Helpers;

class FileHelper
{
    public static function upload($file, $path)
    {
        $name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs($path, $name);

        return $name;
    }
}