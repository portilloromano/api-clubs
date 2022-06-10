<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\ValueObjects\Entity;


final class Entity
{

    private EntityUuid $uuid;
    private EntityUuidClub $uuidClub;
    private EntityType $type;
    private EntityName $name;
    private EntitySurname $surname;
    private EntityEmail $email;
    private EntityPhone $phone;
    private EntitySalary $salary;

    /**
     * @param EntityUuid $uuid
     * @param EntityUuidClub $uuidClub
     * @param EntityType $type
     * @param EntityName $name
     * @param EntitySurname $surname
     * @param EntityEmail $email
     * @param EntityPhone $phone
     * @param EntitySalary $salary
     */
    public function __construct(EntityUuid     $uuid,
                                EntityUuidClub $uuidClub,
                                EntityType     $type,
                                EntityName     $name,
                                EntitySurname  $surname,
                                EntityEmail    $email,
                                EntityPhone    $phone,
                                EntitySalary   $salary)
    {
        $this->uuid = $uuid;
        $this->uuidClub = $uuidClub;
        $this->type = $type;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->salary = $salary;
    }

    /**
     * @param array $entity
     * @return static
     */
    public static function arrayToValueObject(array $entity): self
    {
        return new self(
            new EntityUuid($entity['uuid']),
            new EntityUuidClub($entity['uuid_club']),
            new EntityType($entity['type']),
            new EntityName($entity['name']),
            new EntitySurname($entity['surname']),
            new EntityEmail($entity['email']),
            new EntityPhone($entity['phone']),
            new EntitySalary($entity['salary'])
        );
    }

    /**
     * @param bool $returnNulls
     * @return array
     */
    public function toArray(bool $returnNulls = true): array
    {
        $toArray = [
            'uuid' => $this->uuid->value(),
            'uuid_club' => $this->uuidClub->value(),
            'type' => $this->type->value(),
            'name' => $this->name->value(),
            'surname' => $this->surname->value(),
            'email' => $this->email->value(),
            'phone' => $this->phone->value(),
            'salary' => $this->salary->value()
        ];

        if (!$returnNulls)
            return array_filter($toArray, function ($value) {
                return $value !== null && $value !== "null";
            });

        return $toArray;
    }

    /**
     * @return EntityUuid
     */
    public function uuid(): EntityUuid
    {
        return $this->uuid;
    }

    /**
     * @return EntityUuidClub
     */
    public function uuidClub(): EntityUuidClub
    {
        return $this->uuidClub;
    }

    /**
     * @return EntityType
     */
    public function type(): EntityType
    {
        return $this->type;
    }

    /**
     * @return EntityName
     */
    public function name(): EntityName
    {
        return $this->name;
    }

    /**
     * @return EntitySurname
     */
    public function surname(): EntitySurname
    {
        return $this->surname;
    }

    /**
     * @return EntityEmail
     */
    public function email(): EntityEmail
    {
        return $this->email;
    }

    /**
     * @return EntityPhone
     */
    public function phone(): EntityPhone
    {
        return $this->phone;
    }

    /**
     * @return EntitySalary
     */
    public function salary(): EntitySalary
    {
        return $this->salary;
    }

}
