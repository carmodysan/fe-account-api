<?php

namespace App\Repository;

use App\Entity\SavingsAccountOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SavingsAccountOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SavingsAccountOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SavingsAccountOperation[]    findAll()
 * @method SavingsAccountOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SavingsAccountOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SavingsAccountOperation::class);
    }

    // /**
    //  * @return SavingsAccountOperation[] Returns an array of SavingsAccountOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SavingsAccountOperation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
