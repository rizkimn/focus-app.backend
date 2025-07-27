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
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     securityScheme="bearerAuth",
 *     bearerFormat="JWT"
 * )
 */

abstract class Controller
{
    //
}
