<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\ValueObjects\Club;


use Api\Common\Domain\ValueObject\UuidValueObject;

final class ClubUuid extends UuidValueObject
{
    protected function throwExceptionUuidInvalid($value)
    {
        throw new \Exception($value);
    }
}
