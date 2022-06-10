<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Presentation\REST\Club;


use Api\ClubsAdmin\Application\Club\Update\ClubUpdate;
use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\Common\Application\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidatorObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClubUpdateBudgetController
{

    /**
     * @OA\Patch(
     *     path="/api/v1/club/budget/{uuid}",
     *     tags={"ClubsAdmin"},
     *     description="Budget club update",
     *     summary="Budget club update",
     *     @OA\Parameter(
     *         description="Club UUID",
     *         in="path",
     *         name="uuid",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Budget club updated"),
     *     @OA\RequestBody(
     *          description="Update budget club Object",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType= "application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"budget"},
     *                  @OA\Property(
     *                      property="budget",
     *                      description="Club budget",
     *                      type="integer",
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
                throw new ClubException('Validation Error->' . $validator->errors()->__toString(), Response::HTTP_BAD_REQUEST);

            $club = app()->get(ClubUpdate::class);
            $result = $club($uuid, $request->only('budget'));

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
            'budget' => 'required|numeric',
        ]);
    }

}
