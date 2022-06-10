<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity\Search;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Exception;
use Illuminate\Support\Facades\Log;


final class EntitySearch
{

    /** Services */
    private EntityRepository $entityRepository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    function __invoke(string $uuid): array
    {
        log::info('Search entity');
        try {
            $entity = $this->entityRepository->search($uuid);

            log::info("Searched entity");
            return $entity;
        } catch (Exception $exception) {
            log::error("Error to search entity -> " . $exception->getMessage());
            throw new EntityException("Error to search entity -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
