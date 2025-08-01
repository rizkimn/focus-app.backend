<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Focus App API",
 *     version="1.0.0",
 *     description="API untuk aplikasi manajemen fokus"
 * )
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Local Server"
 * )
 *
 * @OA\Schema(
 *     schema="UnauthenticatedError",
 *     @OA\Property(property="message", type="string", example="Unauthenticated")
 * )
 *
 * @OA\Schema(
 *     schema="ValidationError",
 *     @OA\Property(property="message", type="string", example="The given data was invalid"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         @OA\AdditionalProperties(
 *             type="array",
 *             @OA\Items(type="string")
 *         )
 *     )
 * )
 */

abstract class Controller
{
    //
}
