<?php

namespace App\Repository;

use App\Entity\RegulReversion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegulReversion|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegulReversion|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegulReversion[]    findAll()
 * @method RegulReversion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulReversionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegulReversion::class);
    }

    // /**
    //  * @return RegulReversion[] Returns an array of RegulReversion objects
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
    public function findOneBySomeField($value): ?RegulReversion
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
