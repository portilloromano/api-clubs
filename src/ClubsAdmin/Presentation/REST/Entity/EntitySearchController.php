<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;


use Api\ClubsAdmin\Application\Entity\Search\EntitySearch;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EntitySearchController
{

    /**
     * @OA\Get(
     *     path="/api/v1/entity/{uuid}",
     *     tags={"ClubsAdmin"},
     *     description="Get entity by UUID",
     *     summary="Get entity by UUID",
     *     @OA\Parameter(
     *         description="Entity UUID",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Entity"
     *     )
     * )
     */

    use ApiResponse;

    private EntitySearch $entitySearch;

    public function __construct(EntitySearch $entitySearch)
    {
        $this->entitySearch = $entitySearch;
    }

    function __invoke(string $uuid): JsonResponse
    {
        try {
            $entity = app()->get(EntitySearch::class);
            $result = $entity($uuid);

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
