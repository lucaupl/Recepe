<?php

namespace App\Repository;

use App\Entity\Recepe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recepe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recepe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recepe[]    findAll()
 * @method Recepe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecepeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recepe::class);
    }

    // /**
    //  * @return Recepe[] Returns an array of Recepe objects
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
    public function findOneBySomeField($value): ?Recepe
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
