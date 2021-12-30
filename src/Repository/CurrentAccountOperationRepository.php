<?php

namespace App\Repository;

use App\Entity\CurrentAccountOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrentAccountOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentAccountOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentAccountOperation[]    findAll()
 * @method CurrentAccountOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentAccountOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentAccountOperation::class);
    }

    // /**
    //  * @return CurrentAccountOperation[] Returns an array of CurrentAccountOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurrentAccountOperation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
