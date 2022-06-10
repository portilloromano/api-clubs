<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Entity;

use Api\ClubsAdmin\Application\Entity\Create\EntityCreate;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidatorObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EntityCreateController
{

    /**
     * @OA\Post(
     *     path="/api/v1/entity",
     *     tags={"ClubsAdmin"},
     *     description="Create entity",
     *     summary="Create entity",
     *     @OA\Response(
     *          response=201,
     *          description="Create entity"
     *     ),
     *     @OA\RequestBody(
     *          description="Create entity Object",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType= "application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"type", "name", "surname", "email", "phone"},
     *                  @OA\Property(
     *                      property="uuid_club",
     *                      description="Club UUID",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="type",
     *                      description="Entity type",
     *                      type="enum['PLAYER', 'TRAINER']"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      description="Entity name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="surname",
     *                      description="Entity surname",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      description="Entity email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      description="Entiy phone",
     *                      type="string"
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

    function __invoke(Request $request): JsonResponse
    {
        try {
            $validator = $this->Validator($request);
            if ($validator->fails()) return
                throw new EntityException('Validation Error->' . $validator->errors()->__toString(), Response::HTTP_BAD_REQUEST);

            $entity = app()->get(EntityCreate::class);
            $result = $entity($request->toArray());

            return $this->successResponse($result, Response::HTTP_CREATED);
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
            'uuid_club' => 'string|max:36|min:36|nullable',
            'type' => 'required|string|in:PLAYER,TRAINER',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'salary' => 'numeric|nullable',
        ]);
    }

}
