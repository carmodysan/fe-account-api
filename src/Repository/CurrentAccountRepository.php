<?php

namespace App\Repository;

use App\Entity\CurrentAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrentAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentAccount[]    findAll()
 * @method CurrentAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentAccount::class);
    }

    // /**
    //  * @return CurrentAccount[] Returns an array of CurrentAccount objects
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
    public function findOneBySomeField($value): ?CurrentAccount
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
