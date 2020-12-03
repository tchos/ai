<?php

namespace App\Repository;

use App\Entity\RegulRevSusp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegulRevSusp|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegulRevSusp|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegulRevSusp[]    findAll()
 * @method RegulRevSusp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulRevSuspRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegulRevSusp::class);
    }

    // /**
    //  * @return RegulRevSusp[] Returns an array of RegulRevSusp objects
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
    public function findOneBySomeField($value): ?RegulRevSusp
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
