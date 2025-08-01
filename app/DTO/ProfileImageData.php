<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class ProfileImageData
{
    public function __construct(
        public readonly UploadedFile $image,
        public readonly string $storagePath = 'profile_images',
        public readonly int $resizeWidth = 300,
        public readonly int $resizeHeight = 300,
    ) {
    }
}
