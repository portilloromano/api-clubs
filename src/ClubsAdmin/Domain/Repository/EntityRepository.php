<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\Repository;

use Api\ClubsAdmin\Domain\ValueObjects\Entity\Entity;

interface EntityRepository
{

    public function searchAll(): array;

    public function searchAllByClub(string $uuidClub, array $filters, ?int $currentPage): array;

    public function search(string $uuid): array;

    public function create(Entity $entityVO): array;

    public function update(string $uuid, Entity $entityVO): array;

}
