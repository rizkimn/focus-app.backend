<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\ImageService;
use App\DTO\ProfileImageData;

class UserRepository
{
    public function __construct(
        private readonly ImageService $imageService
    ) {}

    public function updateProfileImage(User $user, ProfileImageData $data): User
    {
        // Delete old image
        $this->imageService->deleteProfileImage($user->profile_image);

        // Upload new image
        $imageInfo = $this->imageService->uploadProfileImage($data);

        // Update user
        $user->update([
            'profile_image' => $imageInfo['path'],
        ]);

        return $user->fresh();
    }
}
