<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="ClubsAdmin API",
 *    version="1.0.0",
 * )
 *
 * @OA\Server(
 *      url="http://localhost",
 *      description="API Server"
 * )
 *
 * @OA\Tag(
 *     name="ClubsAdmin",
 *     description="API Endpoints of Projects"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
