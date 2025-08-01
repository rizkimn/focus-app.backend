<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User Type Model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier for the user type"
 *     ),
 *     @OA\Property(
 *         property="username",
 *         type="string",
 *         description="Name of the user type"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Email of the user type"
 *     ),
 *     @OA\Property(
 *         property="profile_image",
 *         type="string",
 *         description="Profile Image of the user type"
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         type="timestamp",
 *         description="Datetime of the user email verified at"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="Password of the user type"
 *     ),
 *     @OA\Property(
 *         property="remember_token",
 *         type="string",
 *         description="Remember Token of the user type"
 *     ),
 * )
 */

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the focus_sessions for the user.
     */
    public function focusSessions(): HasMany
    {
        return $this->hasMany(FocusSession::class);
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
