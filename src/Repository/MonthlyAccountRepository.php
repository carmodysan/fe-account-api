<?php

namespace App\Repository;

use App\Entity\MonthlyAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MonthlyAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonthlyAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonthlyAccount[]    findAll()
 * @method MonthlyAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonthlyAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonthlyAccount::class);
    }

    // /**
    //  * @return MonthlyAccount[] Returns an array of MonthlyAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MonthlyAccount
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
