<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Club;

use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Application\Club\Create\ClubCreate;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidatorObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClubCreateController
{

    /**
     * @OA\Post(
     *     path="/api/v1/club",
     *     tags={"ClubsAdmin"},
     *     description="Create club",
     *     summary="Create club",
     *     @OA\Response(
     *          response=201,
     *          description="Create club"
     *     ),
     *     @OA\RequestBody(
     *          description="Create club Object",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType= "application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"name"},
     *                  @OA\Property(
     *                      property="name",
     *                      description="Club name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="budget",
     *                      description="Club budget",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="expense",
     *                      description="Club expense",
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
                throw new ClubException('Validation Error->' . $validator->errors()->__toString(), Response::HTTP_BAD_REQUEST);

            $club = app()->get(ClubCreate::class);
            $result = $club($request->toArray());

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
            'name' => 'required|string|max:255|min:3',
            'budget' => 'numeric|nullable',
            'expense' => 'numeric|nullable',
        ]);
    }

}
