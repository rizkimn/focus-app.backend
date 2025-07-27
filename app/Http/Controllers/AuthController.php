<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Registrasi user baru",
     *     tags={"Authentication"},
     *     operationId="registerUser",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data user yang akan diregistrasi",
     *         @OA\JsonContent(
     *             required={"username","email","password"},
     *             @OA\Property(property="username", type="string", example="john_doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Password123!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Registrasi berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Registrasi berhasil! Silakan cek email untuk verifikasi"),
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "email": {"The email field is required."},
     *                     "password": {"The password must be at least 8 characters."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        // Implementasi registrasi
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Login user",
     *     tags={"Authentication"},
     *     operationId="loginUser",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Kredensial login",
     *         @OA\JsonContent(
     *             required={"username","password"},
     *             @OA\Property(property="username", type="string", example="username"),
     *             @OA\Property(property="password", type="string", format="password", example="Password123!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="1|abcdefgh1234567890"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Kredensial tidak valid",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Email atau password salah")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Email belum terverifikasi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Email belum diverifikasi. Silakan cek email Anda")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        // Implementasi login
    }
}

/**
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="Model pengguna",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="username", type="string", example="john_doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="profile_image", type="string", nullable=true, example="https://example.com/profile.jpg"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-07-25T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-07-25T12:34:56Z"),
 *     @OA\Property(property="focus_sessions", type="array", @OA\Items(ref="#/components/schemas/FocusSession"))
 * )
 *
 * @OA\Schema(
 *     schema="FocusSession",
 *     title="Focus Session",
 *     description="Sesi fokus pengguna",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="duration", type="integer", example=25),
 *     @OA\Property(property="date", type="string", format="date", example="2023-07-25"),
 *     @OA\Property(property="time", type="string", format="time", example="14:30:00"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-07-25T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-07-25T12:34:56Z")
 * )
 */
