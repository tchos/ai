<?php

namespace App\Repository;

use App\Entity\UpdatePasword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UpdatePasword|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdatePasword|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdatePasword[]    findAll()
 * @method UpdatePasword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdatePaswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdatePasword::class);
    }

    // /**
    //  * @return UpdatePasword[] Returns an array of UpdatePasword objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UpdatePasword
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
