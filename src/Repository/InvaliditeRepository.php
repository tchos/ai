<?php

namespace App\Repository;

use App\Entity\Invalidite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Invalidite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invalidite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invalidite[]    findAll()
 * @method Invalidite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvaliditeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invalidite::class);
    }

    // /**
    //  * @return Invalidite[] Returns an array of Invalidite objects
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
    public function findOneBySomeField($value): ?Invalidite
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
