<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class Statistiques
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Permet de rechercher une pension de réversion à partir de son nom
     *
     * @param [type] $ayantdroit
     * @return Entity ayantdroit
     */
    public function findAyantDroit($ayantdroit)
    {
        return $this->manager->createQuery('
            SELECT r 
            FROM App\Entity\Reversion r
            WHERE r.nomsAyantDroit LIKE :ayantdroit
        ')->setParameter('ayantdroit', '%'.$ayantdroit.'%')
          ->getResult();
    }

    /**
     * Permet de rechercher une pension d'invalidité à partir du nom
     *
     * @param [type] $invalidite
     * @return Entity invalidite
     */
    public function findInvalidite($invalidite)
    {
        return $this->manager->createQuery('
            SELECT i
            FROM App\Entity\Invalidite i
            WHERE i.nomAgentInvalide LIKE :invalidite
        ')->setParameter('invalidite', '%' . $invalidite . '%')
            ->getResult();
    }
}

?>