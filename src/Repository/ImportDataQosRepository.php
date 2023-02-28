<?php

namespace App\Repository;

use App\Entity\MariaDB\ImportDataQos;
use App\Processing\GlobalFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportDataQos|null find($dps, $lockMode = null, $lockVersion = null)
 * @method ImportDataQos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportDataQos[]    findAll()
 * @method ImportDataQos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportDataQosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportDataQos::class);
    }

    /**
     * @return ImportDataQos[] Returns an array of ImportDataQos objects with retard value = "OUI"
     */
    public function requestGetRetardData(): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.retard LIKE :retard AND IDQ.qosMensuel LIKE :qos')
            ->setParameter('retard', 'OUI')
            ->setParameter('qos', 'OUI')
            ->getQuery()
            ->getResult();
    }

    public function requestGetDeliveryData($client, $date): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.client LIKE :client AND IDQ.dateMesTech LIKE :date')
            ->select('IDQ.dps, IDQ.idCedre, IDQ.codeSite, IDQ.dateMesTech, IDQ.techno, IDQ.type, IDQ.client, IDQ.dateMesLong')
            ->setParameter('client', $client)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

    public function requestGetDataByClient($client): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.client LIKE :client')
            ->setParameter('client', $client)
            ->getQuery()
            ->getResult();
    }

    public function requestOrdersOnGoing($client): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.client LIKE :client AND IDQ.etatDps LIKE :etat AND LENGTH(IDQ.delaiSla) <= 3 AND IDQ.typeSla LIKE :type AND IDQ.dateMesTech IS NULL')
            ->setParameter('client', $client)
            ->setParameter('etat', "%En cours%")
            ->setParameter('type', "OUI")
            ->getQuery()
            ->getResult();
    }

    public function requestOrdersOnGoingThisMonth(string $client, $date): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.client LIKE :client AND LENGTH(IDQ.delaiSla) <= 3 AND IDQ.typeSla LIKE :type AND IDQ.dateCmdClient LIKE :date')
            ->setParameter('client', $client)
            ->setParameter('type', "OUI")
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

/*    public function requestDeleteDps(string $dps): array
    {
        return $this->createQueryBuilder('IDQ')
            ->delete()
            ->awhere("IDQ.dps = :dps" )
            ->setParameter('dps', $dps)
            ->getQuery()
            ->getResult();
    }*/

    public function requestGetOrdersDeliveredWithSla(string $client, GlobalFunction $date): array
    {
        return $this->createQueryBuilder('IDQ')
            ->andWhere('IDQ.client LIKE :client AND IDQ.etatDps LIKE :etat AND LENGTH(IDQ.delaiSla) <= 3 AND IDQ.typeSla LIKE :type AND IDQ.dateCmdClient LIKE :date')
            ->setParameter('client', $client)
            ->setParameter('etat', "Traité")
            ->setParameter('type', "OUI")
            ->setParameter('date', $date->GetFormatedDate(1))
            ->getQuery()
            ->getResult();
    }

    public function requestGetDps($dps): array
    {
        return $this->createQueryBuilder('IDQ')
            ->select('IDQ.Dps LIKE :DPS')
            ->setParameter('DPS', $dps)
            ->getQuery()
            ->getResult();
    }


}
