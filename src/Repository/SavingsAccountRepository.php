<?php

namespace App\Repository;

use App\Entity\SavingsAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SavingsAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method SavingsAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method SavingsAccount[]    findAll()
 * @method SavingsAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SavingsAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SavingsAccount::class);
    }

    // /**
    //  * @return SavingsAccount[] Returns an array of SavingsAccount objects
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
    public function findOneBySomeField($value): ?SavingsAccount
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
