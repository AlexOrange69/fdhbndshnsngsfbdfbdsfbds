<?php

namespace App\Repository;

use App\Entity\MariaDB\RetardQos;
use App\Processing\GlobalFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RetardQos|null find($dps, $lockMode = null, $lockVersion = null)
 * @method RetardQos|null findOneBy(array $criteria, array $orderBy = null)
 * @method RetardQos[]    findAll()
 * @method RetardQos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetardQosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RetardQos::class);
    }

    /**
     * @return RetardQos[] Returns an array of RetardQos objects by client
     */
    public function requestGetRetardByClientAndDate($client, $date): array
    {
        return $this->createQueryBuilder('R')
            ->andWhere('R.client LIKE :client AND R.dateMesTech LIKE :date')
            ->setParameter('client', $client)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }


}
