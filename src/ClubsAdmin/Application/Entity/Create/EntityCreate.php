<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity\Create;


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
use Illuminate\Support\Str;

final class EntityCreate
{

    /** Services */
    private EntityRepository $entityRepository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function __invoke(array $entityDTO): array
    {
        log::info('Start create entity');
        try {
            $uuid = new EntityUuid(Str::uuid()->toString());
            $uuidClub = new EntityUuidClub($entityDTO['uuid_club']);
            $type = new EntityType($entityDTO['type']);
            $name = new EntityName($entityDTO['name']);
            $surname = new EntitySurname($entityDTO['surname']);
            $email = new EntityEmail($entityDTO['email']);
            $phone = new EntityPhone($entityDTO['phone']);
            $salary = new EntitySalary($entityDTO['salary']);

            $entityVO = new Entity($uuid, $uuidClub, $type, $name, $surname, $email, $phone, $salary);

            $entity = $this->entityRepository->create($entityVO);

            log::info("Entity created -> " . $entityVO->uuid()->value());

            return $entity;
        } catch (Exception $exception) {
            log::error("Error to create entity -> " . $exception->getMessage());
            throw new EntityException("Error to create entity -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
