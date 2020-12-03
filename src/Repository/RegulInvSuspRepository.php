<?php

namespace App\Repository;

use App\Entity\RegulInvSusp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegulInvSusp|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegulInvSusp|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegulInvSusp[]    findAll()
 * @method RegulInvSusp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulInvSuspRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegulInvSusp::class);
    }

    // /**
    //  * @return RegulInvSusp[] Returns an array of RegulInvSusp objects
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
    public function findOneBySomeField($value): ?RegulInvSusp
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
