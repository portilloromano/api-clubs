<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Club\Update;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Api\ClubsAdmin\Domain\ValueObjects\Club\Club;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubBudget;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubExpense;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubName;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubUuid;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


final class ClubUpdate
{

    /** Services */
    private ClubRepository $clubRepository;

    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function __invoke(string $uuidDT, array $clubDTO): array
    {
        log::info('Start update club');

        $club = $this->clubRepository->search($uuidDT);
        if (isset($clubDTO['budget']) && $clubDTO['budget'] < $club['expense'])
            throw new ClubException('Budget cannot be less than expenses', Response::HTTP_BAD_REQUEST);

        try {
            $uuid = new ClubUuid($uuidDT);
            $name = new ClubName($clubDTO['name'] ?? null);
            $budget = new ClubBudget($clubDTO['budget'] ?? null);
            $expense = new ClubExpense($clubDTO['expense'] ?? null);

            $clubVO = new Club($uuid, $name, $budget, $expense);

            $club = $this->clubRepository->update($uuidDT, $clubVO);

            log::info("Club updated -> " . $uuidDT);
            return $club;
        } catch (Exception $exception) {
            throw new ClubException("Error to update club -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
