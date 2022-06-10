<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity\Update;


use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\Entity;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityEmail;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityName;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityPhone;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntitySalary;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntitySurname;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityType;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityUuid;
use Api\ClubsAdmin\Domain\ValueObjects\Entity\EntityUuidClub;
use Exception;
use Illuminate\Support\Facades\Log;


final class EntityUpdate
{

    /** Services */
    private EntityRepository $entityRepository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function __invoke(string $uuidDT, array $entityDTO): array
    {
        log::info('Start update entity');
        try {
            $uuid = new EntityUuid($uuidDT);
            $uuidClub = new EntityUuidClub($entityDTO['uuid_club'] ?? null);
            $type = new EntityType($entityDTO['type'] ?? null);
            $name = new EntityName($entityDTO['name'] ?? null);
            $surname = new EntitySurname($entityDTO['surname'] ?? null);
            $email = new EntityEmail($entityDTO['email'] ?? null);
            $phone = new EntityPhone($entityDTO['phone'] ?? null);
            $salary = new EntitySalary($entityDTO['salary'] ?? null);

            $entityVO = new Entity($uuid, $uuidClub, $type, $name, $surname, $email, $phone, $salary);

            $entity = $this->entityRepository->update($uuidDT, $entityVO);

            log::info("Entity updated -> " . $uuidDT);
            return $entity;
        } catch (Exception $exception) {
            throw new EntityException("Error to update entity -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
