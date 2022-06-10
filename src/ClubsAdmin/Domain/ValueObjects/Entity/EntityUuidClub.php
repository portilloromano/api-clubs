<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\ValueObjects\Entity;


use Api\Common\Domain\ValueObject\UuidValueObject;

final class EntityUuidClub extends UuidValueObject
{
    protected function throwExceptionUuidInvalid($value)
    {
        throw new \Exception($value);
    }
}
