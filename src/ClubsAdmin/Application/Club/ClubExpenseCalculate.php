<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Club;


use Api\ClubsAdmin\Application\Club\Update\ClubUpdate;
use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

final class ClubExpenseCalculate
{

    /** Services */
    private ClubRepository $clubRepository;
    private ClubUpdate $clubUpdate;

    public function __construct(ClubRepository $clubRepository,
                                ClubUpdate     $clubUpdate)
    {
        $this->clubRepository = $clubRepository;
        $this->clubUpdate = $clubUpdate;
    }

    public function __invoke(string $uuid, int $salary, string $transactionType): void
    {
        log::info('Start budget validate and updated club expenses.');
        try {
            $club = $this->clubRepository->search($uuid);

            if ($transactionType == 'associate') {
                if ($club['budget'] - ($club['expense'] + $salary) < 0)
                    throw new ClubException('Insufficient budget', Response::HTTP_BAD_REQUEST);

                $club['expense'] += $salary;

            } elseif ($transactionType == 'disassociate') {
                $club['expense'] -= $salary;
            }

            $this->clubUpdate->__invoke($uuid, $club);

        } catch (Exception $exception) {
            log::error("Error to budget validate and updated club expenses -> " . $exception->getMessage());
            throw new ClubException("Error to budget validate and updated club expenses -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
