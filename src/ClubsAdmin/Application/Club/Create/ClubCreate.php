<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Club\Create;


use Api\ClubsAdmin\Domain\Exceptions\ClubException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Api\ClubsAdmin\Domain\ValueObjects\Club\Club;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubBudget;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubExpense;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubName;
use Api\ClubsAdmin\Domain\ValueObjects\Club\ClubUuid;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class ClubCreate
{

    /** Services */
    private ClubRepository $clubRepository;

    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function __invoke(array $clubDTO): array
    {
        log::info('Start create club');
        try {
            $uuid = new ClubUuid(Str::uuid()->toString());
            $name = new ClubName($clubDTO['name']);
            $budget = new ClubBudget($clubDTO['budget']);
            $expense = new ClubExpense($clubDTO['expense']);

            $clubVO = new Club($uuid, $name, $budget, $expense);

            $club = $this->clubRepository->create($clubVO);

            log::info("Club created -> " . $clubVO->uuid()->value());

            return $club;
        } catch (Exception $exception) {
            log::error("Error to create club -> " . $exception->getMessage());
            throw new ClubException("Error to create club -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
