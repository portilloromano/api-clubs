<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Club;


use Api\ClubsAdmin\Application\Club\Search\ClubSearch;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ClubSearchController
{

    /**
     * @OA\Get(
     *     path="/api/v1/club/{uuid}",
     *     tags={"ClubsAdmin"},
     *     description="Get club by UUID",
     *     summary="Get club by UUID",
     *     @OA\Parameter(
     *         description="Club UUID",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Club"
     *     )
     * )
     */

    use ApiResponse;

    function __invoke(string $uuid): JsonResponse
    {
        try {
            $club = app()->get(ClubSearch::class);
            $result = $club($uuid);

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
