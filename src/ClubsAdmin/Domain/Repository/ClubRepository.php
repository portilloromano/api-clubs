<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\Repository;

use Api\ClubsAdmin\Domain\ValueObjects\Club\Club;

interface ClubRepository
{

    public function searchAll(): array;

    public function search(string $uuid): array;

    public function create(Club $clubVO): array;

    public function update(string $uuid, Club $clubVO): array;

}
