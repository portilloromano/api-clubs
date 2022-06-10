<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Infrastructure\Persistence\Eloquent\Entity;


use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\Entity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

final class EntityEloquentRepository implements EntityRepository
{
    public function searchAll(): array
    {
        try {
            return EntityEloquent::all()->toArray();

        } catch (QueryException $exception) {
            log::error("error " . $exception->getMessage());
            throw new EntityException("Error to search all entities -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function searchAllByClub(string $uuidClub, array $filters, ?int $currentPage): array
    {
        try {
            return EntityEloquent::select('*')
                ->where('uuid_club', $uuidClub)
                ->type($filters['type'])
                ->surname($filters['surname'])
                ->orderBy('surname', 'asc')
                ->paginate(env('PAGINATE_DEFAULT'), ['*'], 'page', $currentPage)
                ->toArray();

        } catch (QueryException $exception) {
            log::error("error " . $exception->getMessage());
            throw new EntityException("Error to search all entities -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function search(string $uuid): array
    {
        try {
            return EntityEloquent::findOrFail($uuid)->toArray();

        } catch (ModelNotFoundException $exception) {
            log::error("Error entity not found -> " . $exception->getMessage());
            throw new EntityException("Error entity not found -> " . $exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (QueryException $exception) {
            log::error("Error to search entity -> " . $exception->getMessage());
            throw new EntityException("Error to search entity -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Entity $entityVO): array
    {
        try {

            $entity = EntityEloquent::create($entityVO->toArray(false));

            return $entity->fresh()->toArray();

        } catch (QueryException $exception) {
            log::error("Error to create entity -> " . $exception->getMessage());
            throw new EntityException("Error to create entity -> " . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(string $uuid, Entity $entityVO): array
    {
        try {
            $entity = EntityEloquent::findOrFail($uuid);
            $entity->fill($entityVO->toArray(false));
            $entity->save();

            return $entity->fresh()->toArray();

        } catch (ModelNotFoundException $exception) {
            log::error("Error entity not found " . $exception->getMessage());
            throw new EntityException('Error entity not found -> ' . $exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (QueryException $exception) {
            log::error("Error to update entity -> " . $exception->getMessage());
            throw new EntityException('Error to update entity -> ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
