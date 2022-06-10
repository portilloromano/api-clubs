<?php
declare(strict_types=1);

namespace Api\Common\Application\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * @param array|string $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse(array|string $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return \response()->json(['data' => $data], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse(array|string $data, int $code = Response::HTTP_BAD_GATEWAY): JsonResponse
    {
        return \response()->json(['error' => $data], $code);
    }
}
