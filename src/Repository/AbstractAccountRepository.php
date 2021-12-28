<?php

namespace App\Repository;

use App\Entity\AbstractAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbstractAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbstractAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbstractAccount[]    findAll()
 * @method AbstractAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbstractAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbstractAccount::class);
    }

    // /**
    //  * @return AbstractAccount[] Returns an array of AbstractAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AbstractAccount
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
