<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;

use Api\ClubsAdmin\Application\Entity\EntityDisassociateClub;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EntityDisassociateClubController
{

    /**
     * @OA\Patch(
     *     path="/api/v1/entity/disassociate/{uuid}",
     *     tags={"ClubsAdmin"},
     *     description="Disassociate entity to a Club",
     *     summary="Disassociate entity to a Club",
     *     @OA\Parameter(
     *         description="Entity UUID",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Disassociate entity to a Club"
     *     )
     * )
     */

    use ApiResponse;

    function __invoke(string $uuid, Request $request): JsonResponse
    {
        try {
            $entity = app()->get(EntityDisassociateClub::class);
            $result = $entity($uuid);

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
