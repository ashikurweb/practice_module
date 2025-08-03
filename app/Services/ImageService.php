<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageService
{
    protected string $disk = 'public'; 

    /**
     * Store image in dynamic nested folders and return relative path.
     *
     * @param UploadedFile $file
     * @param string|null $folderPrefix E.g. user ID, date segment, etc.
     * @return string Path relative to disk root, e.g. "1/uniqfilename.png"
     */
    public function storeImage(UploadedFile $file, ?string $folderPrefix = null): string
    {
        $folder = $folderPrefix ? trim($folderPrefix, '/') : '';
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $folder ? ($folder . '/' . $filename) : $filename;
        Storage::disk($this->disk)->putFileAs($folder, $file, $filename);

        return $path;
    }

    /**
     * Delete an old image if exists.
     *
     * @param string|null $path Relative path like "1/file.png"
     * @return void
     */
    public function deleteImage(?string $path): void
    {
        if ($path && Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->delete($path);
        }
    }
}
