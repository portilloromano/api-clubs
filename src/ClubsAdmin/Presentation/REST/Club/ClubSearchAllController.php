<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Club;


use Api\ClubsAdmin\Application\Club\SearchAll\ClubSearchAll;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ClubSearchAllController
{

    /**
     * @OA\Get(
     *     path="/api/v1/club",
     *     tags={"ClubsAdmin"},
     *     description="Get all clubs",
     *     summary="Get all clubs",
     *     @OA\Response(
     *          response=200,
     *          description="All clubs"),
     * )
     */

    use ApiResponse;

    function __invoke(): JsonResponse
    {
        try {
            $clubs = app()->get(ClubSearchAll::class);
            $result = $clubs();

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
