<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Club\SearchAll;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Exception;
use Illuminate\Support\Facades\Log;

final class ClubSearchAll
{

    /** Services */
    private ClubRepository $clubRepository;

    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    function __invoke(): array
    {
        log::info('Search all clubs');
        try {
            $clubs = $this->clubRepository->searchAll();

            log::info("Searched all clubs");
            return $clubs;
        } catch (Exception $exception) {
            log::error("Error to search all clubs -> " . $exception->getMessage());
            throw new ClubException("Error to search all clubs -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
