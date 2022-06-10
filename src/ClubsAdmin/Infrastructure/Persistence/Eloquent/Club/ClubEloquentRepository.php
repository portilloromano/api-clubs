<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Club;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Api\ClubsAdmin\Domain\ValueObjects\Club\Club;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

final class ClubEloquentRepository implements ClubRepository
{
    public function searchAll(): array
    {
        try {
            return ClubEloquent::all()->toArray();

        } catch (QueryException $exception) {
            log::error("error " . $exception->getMessage());
            throw new ClubException("Error to search all clubs -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(string $uuid): array
    {
        try {
            return ClubEloquent::findOrFail($uuid)->toArray();

        } catch (ModelNotFoundException $exception) {
            log::error("Error club not found -> " . $exception->getMessage());
            throw new ClubException("Error club not found -> " . $exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (QueryException $exception) {
            log::error("Error to search club -> " . $exception->getMessage());
            throw new ClubException("Error to search club -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Club $clubVO): array
    {
        try {

            $club = ClubEloquent::create($clubVO->toArray(false));

            return $club->fresh()->toArray();

        } catch (QueryException $exception) {
            log::error("Error to create club -> " . $exception->getMessage());
            throw new ClubException("Error to create club -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(string $uuid, Club $clubVO): array
    {
        try {
            $club = ClubEloquent::findOrFail($uuid);
            $club->fill($clubVO->toArray(false));
            $club->save();

            return $club->fresh()->toArray();

        } catch (ModelNotFoundException $exception) {
            log::error("Error club not found " . $exception->getMessage());
            throw new ClubException('Error club not found -> ' . $exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (QueryException $exception) {
            log::error("Error to update club -> " . $exception->getMessage());
            throw new ClubException('Error to update club -> ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
