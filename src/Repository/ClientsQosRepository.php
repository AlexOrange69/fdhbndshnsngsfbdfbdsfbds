<?php

namespace App\Repository;

use App\Entity\MariaDB\Clients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Clients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clients[]    findAll()
 * @method Clients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientsQosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clients::class);
    }


    public function requestGetClient(): array
    {
        return $this->createQueryBuilder('C')
            ->select('C.name')
            ->getQuery()
            ->getResult();
    }
}