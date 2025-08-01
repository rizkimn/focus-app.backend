<?php

namespace App\Services;

use App\DTO\ProfileImageData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function uploadProfileImage(ProfileImageData $data): array
    {
        $file = $data->image;
        $fileName = $this->generateFileName($file);
        $path = $data->storagePath . "/" . $fileName;

        Storage::disk('public')->put($path, $file->getContent());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'disk' => 'public',
        ];
    }

    public function deleteProfileImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function generateFileName(UploadedFile $file): string
    {
        return 'profile-' . Str::uuid(). '.' . $file->extension();
    }
}
