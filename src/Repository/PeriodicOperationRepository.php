<?php

namespace App\Repository;

use App\Entity\PeriodicOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PeriodicOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeriodicOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeriodicOperation[]    findAll()
 * @method PeriodicOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodicOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeriodicOperation::class);
    }

    // /**
    //  * @return PeriodicOperation[] Returns an array of PeriodicOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PeriodicOperation
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
