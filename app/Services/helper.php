<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFilePath')) {
    function uploadFilePath($file, $existingPath = null, $folder)
    {
        // If no new file is uploaded
        if (!$file) {
            if ($existingPath && Storage::exists(str_replace('storage/', 'public/', $existingPath))) {
                return $existingPath;
            }
            return null;
        }

        // Delete old file if exists
        if ($existingPath && Storage::exists(str_replace('storage/', 'public/', $existingPath))) {
            Storage::delete(str_replace('storage/', 'public/', $existingPath));
        }

        // Ensure folder exists
        $storageFolder = "public/{$folder}";
        if (!Storage::exists($storageFolder)) {
            Storage::makeDirectory($storageFolder);
        }

        // Store new file
        $path = $file->store($storageFolder);

        return str_replace('public/', 'storage/', $path);
    }
}