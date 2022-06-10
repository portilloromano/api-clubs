<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;


use Api\ClubsAdmin\Application\Entity\SearchAll\EntitySearchAll;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EntitySearchAllController
{

    /**
     * @OA\Get(
     *     path="/api/v1/entity",
     *     tags={"ClubsAdmin"},
     *     description="Get all entities",
     *     summary="Get all entities",
     *     @OA\Response(
     *          response=200,
     *          description="All entities"),
     * )
     */

    use ApiResponse;

    function __invoke(): JsonResponse
    {
        try {
            $entities = app()->get(EntitySearchAll::class);
            $result = $entities();

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
