<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity;


use Api\ClubsAdmin\Application\Club\ClubExpenseCalculate;
use Api\ClubsAdmin\Application\Entity\Update\EntityUpdate;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Api\Emails\ClubsAdmin\Presentation\EmailDisassociateClubController;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


final class EntityDisassociateClub
{

    /** Services */
    private EntityRepository $entityRepository;
    private ClubRepository $clubRepository;
    private EntityUpdate $entityUpdate;
    private ClubExpenseCalculate $clubExpenseCalculate;


    public function __construct(EntityRepository     $entityRepository,
                                ClubRepository       $clubRepository,
                                EntityUpdate         $entityUpdate,
                                ClubExpenseCalculate $clubExpenseCalculate)
    {
        $this->entityRepository = $entityRepository;
        $this->clubRepository = $clubRepository;
        $this->entityUpdate = $entityUpdate;
        $this->clubExpenseCalculate = $clubExpenseCalculate;
    }


    public function __invoke(string $uuidDT): array
    {
        log::info('Start disassociate entity to a club');
        DB::beginTransaction();
        try {
            $entity = $this->entityRepository->search($uuidDT);

            if (is_null($entity['uuid_club']))
                throw new EntityException('The entity is not associated with any club', Response::HTTP_BAD_REQUEST);

            $this->clubExpenseCalculate->__invoke($entity['uuid_club'], $entity['salary'], 'disassociate');

            $club = $this->clubRepository->search($entity['uuid_club']);

            $entity = $this->entityUpdate->__invoke($uuidDT, ['uuid_club' => null]);

            $data = [
                'entity' => $entity,
                'club' => $club
            ];

            Mail::to($data['entity']['email'])->send(new EmailDisassociateClubController($data));

            //TODO enviar datos al controlador de SMS

            DB::commit();
            log::info("Entity disassociate to a club -> " . $uuidDT);
            return $entity;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new EntityException("Error to disassociate entity to a club -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
