<?php
declare(strict_types=1);

namespace Api\ClubsAdmin\Application\Entity;


use Api\ClubsAdmin\Application\Club\ClubExpenseCalculate;
use Api\ClubsAdmin\Application\Entity\Update\EntityUpdate;
use Api\ClubsAdmin\Domain\Exceptions\EntityException;
use Api\ClubsAdmin\Domain\Repository\ClubRepository;
use Api\ClubsAdmin\Domain\Repository\EntityRepository;
use Api\Emails\ClubsAdmin\Presentation\EmailAssociateClubController;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


final class EntityAssociateClub
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

    public function __invoke(string $uuidDT, array $clubDTO): array
    {
        log::info('Start associate entity to a club');
        DB::beginTransaction();
        try {
            $entity = $this->entityRepository->search($uuidDT);

            if (!is_null($entity['uuid_club']))
                throw new EntityException('The entity already belongs to a club', Response::HTTP_BAD_REQUEST);

            $this->clubExpenseCalculate->__invoke($clubDTO['uuid_club'], $entity['salary'], 'associate');

            $entity = $this->entityUpdate->__invoke($uuidDT, $clubDTO);

            $club = $this->clubRepository->search($clubDTO['uuid_club']);

            $data = [
                'entity' => $entity,
                'club' => $club
            ];

            Mail::to($data['entity']['email'])->send(new EmailAssociateClubController($data));
            
            //TODO enviar datos al controlador de SMS

            DB::commit();
            log::info("Entity associate to a club -> " . $uuidDT);
            return $entity;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new EntityException("Error to associate entity to a club -> " . $exception->getMessage(), $exception->getCode());
        }
    }

}
