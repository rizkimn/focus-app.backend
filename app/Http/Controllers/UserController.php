<?php

namespace App\Http\Controllers;

use App\DTO\ProfileImageData;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * @OA\Get(
     *     path="/user",
     *     operationId="getAuthenticatedUser",
     *     tags={"User"},
     *     summary="Get authenticated user's profile",
     *     description="Retrieve the profile information of the currently authenticated user",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully retrieved user profile",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully retrieved user profile"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="user",
     *                     ref="#/components/schemas/User"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function me(Request $request)
    {
        if (!$user = $request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'message' => 'Successfully retrieved user profile',
            'data' => [
                'user' => new UserResource($user),
            ],
        ]);
    }

    /**
     * @OA\Post(
     *     path="/user/profile-image",
     *     operationId="uploadProfileImage",
     *     tags={"User"},
     *     summary="Upload user profile image",
     *     description="Upload a profile image for authenticated user",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Image file to upload",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"profile_image"},
     *                 @OA\Property(
     *                     property="profile_image",
     *                     description="Profile image file (max 2MB, min 100x100)",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile image uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Profile image uploaded successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="user",
     *                     ref="#/components/schemas/User"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="profile_image",
     *                     type="array",
     *                     @OA\Items(type="string", example="The profile image must be an image.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function uploadProfileImage(UpdateProfileImageRequest $request)
    {
        $user = $request->user();

        $imageData = new ProfileImageData(
            image: $request->file('profile_image')
        );

        $user = $this->userRepository->updateProfileImage($user, $imageData);

        return response()->json([
            'message' => 'Profile image uploaded successfully',
            'data' => [
                'user' => new UserResource($user),
            ],
        ]);
    }
}
