<?php

namespace App\Repository;

use App\Entity\InterestRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InterestRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterestRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterestRate[]    findAll()
 * @method InterestRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterestRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InterestRate::class);
    }

    // /**
    //  * @return InterestRate[] Returns an array of InterestRate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InterestRate
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
