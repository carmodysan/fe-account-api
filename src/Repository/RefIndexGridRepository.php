<?php

namespace App\Repository;

use App\Entity\RefIndexGrid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RefIndexGrid|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefIndexGrid|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefIndexGrid[]    findAll()
 * @method RefIndexGrid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefIndexGridRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefIndexGrid::class);
    }

    // /**
    //  * @return RefIndexGrid[] Returns an array of RefIndexGrid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RefIndexGrid
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
