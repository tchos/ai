<?php

namespace App\Repository;

use App\Entity\RegulRevClo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegulRevClo|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegulRevClo|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegulRevClo[]    findAll()
 * @method RegulRevClo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulRevCloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegulRevClo::class);
    }

    // /**
    //  * @return RegulRevClo[] Returns an array of RegulRevClo objects
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
    public function findOneBySomeField($value): ?RegulRevClo
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
