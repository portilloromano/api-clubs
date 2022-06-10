<?php
declare(strict_types=1);

namespace Api\Common\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;


abstract class UuidValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->checkUuid($value);
        $this->value = $value;
    }

    public function checkUuid($id): void
    {
        if (!is_null($id))
            if (!RamseyUuid::isValid($id)) $this->throwExceptionUuidInvalid("Error in uuid Validation class: " . static::class . " uuid: " . $id);
    }

    abstract protected function throwExceptionUuidInvalid($value);

    public function value(): ?string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
