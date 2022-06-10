<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;

use Api\ClubsAdmin\Application\Entity\EntityAssociateClub;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidatorObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EntityAssociateClubController
{

    /**
     * @OA\Patch(
     *     path="/api/v1/entity/associate/{uuid}",
     *     tags={"ClubsAdmin"},
     *     description="Associate entity to a club",
     *     summary="Associate entity to a club",
     *     @OA\Parameter(
     *         description="Entity UUID",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Associated club"),
     *     @OA\RequestBody(
     *          description="Associate club Object",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType= "application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"uuid_club"},
     *                  @OA\Property(
     *                      property="uuid_club",
     *                      description="Club UUID",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="salary",
     *                      description="Entity salary",
     *                      type="integer"
     *                  )
     *              )
     *          )
     *     )
     * )
     */

    use ApiResponse;

    function __invoke(string $uuid, Request $request): JsonResponse
    {
        try {
            $validator = $this->Validator($request);
            if ($validator->fails()) return
                throw new EntityException('Validation Error->' . $validator->errors()->__toString(), Response::HTTP_BAD_REQUEST);

            $entity = app()->get(EntityAssociateClub::class);
            $result = $entity($uuid, $request->only('uuid_club', 'salary'));

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
            'uuid_club' => 'required|string|max:36|min:36',
            'salary' => 'numeric|nullable',
        ]);
    }

}
