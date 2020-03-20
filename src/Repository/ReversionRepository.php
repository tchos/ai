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

    public function findLike(string $name): ?array
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.nomsAyantDroit LIKE :name')
            ->setParameter('name', "%$name%")
            ->orderBy('r.nomsAyantDroit')
            ->setMaxResults(10)
            ->getQuery()
            ->execute();
    }

    public function findReversion($str)
    {
        $arrayAss = $this->getEntityManager()
            ->createQuery(
                'SELECT r.nomsAyantDroit
                FROM App\Entity\Reversion r
                WHERE r.nomsAyantDroit LIKE :str'
            )
            ->setParameter('str', '%' . $str . '%')
            ->getArrayResult();
        
        $array = array();
        foreach ($arrayAss as $data) 
        {
            $array[] = $data['nomsAyantDroit'];
        }

        return $array;
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
