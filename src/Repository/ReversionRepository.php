<?php

namespace App\Repository;

use App\Entity\Reversion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reversion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reversion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reversion[]    findAll()
 * @method Reversion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReversionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reversion::class);
    }

    // /**
    //  * @return Reversion[] Returns an array of Reversion objects
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
    public function findOneBySomeField($value): ?Reversion
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
