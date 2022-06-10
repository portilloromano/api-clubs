<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity\SearchAll;


use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Exception;
use Illuminate\Support\Facades\Log;

final class EntitySearchAll
{

    /** Services */
    private EntityRepository $entityRepository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    function __invoke(): array
    {
        log::info('Search all entities');
        try {
            $entities = $this->entityRepository->searchAll();

            log::info("Searched all entities");
            return $entities;
        } catch (Exception $exception) {
            log::error("Error to search all entities -> " . $exception->getMessage());
            throw new EntityException("Error to search all entities -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
