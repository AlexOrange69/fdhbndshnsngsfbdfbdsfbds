<?php

namespace App\Repository;

use App\Entity\MariaDB\RetardQos;
use App\Entity\MariaDB\TepQos;
use App\Processing\GlobalFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method tepQos|null find($id, $lockMode = null, $lockVersion = null)
 * @method tepQos|null findOneBy(array $criteria, array $orderBy = null)
 * @method tepQos[]    findAll()
 * @method tepQos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TepQosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, tepQos::class);
    }

    /**
     * @return TepQos Returns an line of TepQos objects by client and date
     */
    public function requestGetTepByClient($client, GlobalFunction $date): TepQos
    {
        return $this->createQueryBuilder('T')
            ->andWhere('T.client LIKE :client AND T.date LIKE :date')
            ->setParameter('client', $client)
            ->setParameter('date', $date->GetFormatedDate(1))
            ->getQuery()
            ->getResult();
    }

}
