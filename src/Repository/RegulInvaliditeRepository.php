<?php

namespace App\Repository;

use App\Entity\RegulInvalidite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegulInvalidite|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegulInvalidite|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegulInvalidite[]    findAll()
 * @method RegulInvalidite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulInvaliditeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegulInvalidite::class);
    }

    // /**
    //  * @return RegulInvalidite[] Returns an array of RegulInvalidite objects
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
    public function findOneBySomeField($value): ?RegulInvalidite
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
