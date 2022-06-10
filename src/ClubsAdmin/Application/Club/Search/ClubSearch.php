<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Club\Search;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Exception;
use Illuminate\Support\Facades\Log;


final class ClubSearch
{

    /** Services */
    private ClubRepository $clubRepository;

    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    function __invoke(string $uuid): array
    {
        log::info('Search club');
        try {
            $club = $this->clubRepository->search($uuid);

            log::info("Searched club");
            return $club;
        } catch (Exception $exception) {
            log::error("Error to search club -> " . $exception->getMessage());
            throw new ClubException("Error to search club -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
