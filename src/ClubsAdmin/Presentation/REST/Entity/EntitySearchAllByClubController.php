<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;


use Api\ClubsAdmin\Application\Entity\SearchAll\EntitySearchAllByClub;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator as ValidatorObject;
use Illuminate\Support\Facades\Validator;

class EntitySearchAllByClubController
{

    /**
     * @OA\Get(
     *     path="/api/v1/entity/club/{uuidClub}",
     *     tags={"ClubsAdmin"},
     *     description="Get all entities by club UUID",
     *     summary="Get all entities by club UUID",
     *     @OA\Parameter(
     *         description="Club UUID",
     *         in="path",
     *         name="uuidClub",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         description="Entity type",
     *         in="query",
     *         name="type",
     *         @OA\Schema(type="enum['PLAYER', 'TRAINER']")
     *     ),
     *     @OA\Parameter(
     *         description="Entity surname content",
     *         in="query",
     *         name="surname",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Filtered and paginated entities"
     *     )
     * )
     */

    use ApiResponse;

    function __invoke(string $uuidClub, Request $request): JsonResponse
    {
        try {
            $validator = $this->Validator($request);
            if ($validator->fails()) return
                throw new EntityException('Validation Error->' . $validator->errors()->__toString(), Response::HTTP_BAD_REQUEST);

            $page = $request->get('page');
            if (!is_null($page) && !is_numeric($page))
                throw new EntityException('Page number is invalid', Response::HTTP_BAD_REQUEST);

            $filters = [
                'type' => $request->get('type'),
                'surname' => $request->get('surname')
            ];

            $currentPage = is_null($page) ? null : (int)$page;

            $entities = app()->get(EntitySearchAllByClub::class);
            $result = $entities($uuidClub, $filters, $currentPage);

            return $this->successResponse($result, Response::HTTP_OK);
        } catch (\Exception $ex) {
            log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), $ex->getCode() > 0 ? $ex->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return ValidatorObject
     */
    private function Validator(Request $request): ValidatorObject
    {
        return Validator::make($request->all(), [
            'type' => 'string|in:PLAYER,TRAINER',
        ]);
    }

}
