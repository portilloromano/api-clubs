<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Domain\ValueObjects\Club;


final class Club
{

    private ClubUuid $uuid;
    private ClubName $name;
    private ClubBudget $budget;
    private ClubExpense $expense;

    /**
     * @param ClubUuid $uuid
     * @param ClubName $name
     * @param ClubBudget $budget
     * @param ClubExpense $expense
     */
    public function __construct(ClubUuid    $uuid,
                                ClubName    $name,
                                ClubBudget  $budget,
                                ClubExpense $expense)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->budget = $budget;
        $this->expense = $expense;
    }

    /**
     * @param array $club
     * @return static
     */
    public static function arrayToValueObject(array $club): self
    {
        return new self(
            new ClubUuid($club['uuid']),
            new ClubName($club['name']),
            new ClubBudget($club['budget']),
            new ClubExpense($club['expense'])
        );
    }

    /**
     * @param bool $returnNulls
     * @return array
     */
    public function toArray(bool $returnNulls = true): array
    {
        $toArray = [
            'uuid' => $this->uuid->value(),
            'name' => $this->name->value(),
            'budget' => $this->budget->value(),
            'expense' => $this->expense->value()
        ];

        if (!$returnNulls)
            return array_filter($toArray, function ($value) {
                return $value !== null && $value !== "null";
            });

        return $toArray;
    }

    /**
     * @return ClubUuid
     */
    public function uuid(): ClubUuid
    {
        return $this->uuid;
    }

    /**
     * @return ClubName
     */
    public function name(): ClubName
    {
        return $this->name;
    }

    /**
     * @return ClubBudget
     */
    public function budget(): ClubBudget
    {
        return $this->budget;
    }

    /**
     * @return ClubExpense
     */
    public function expense(): ClubExpense
    {
        return $this->expense;
    }

}
