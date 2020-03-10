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
        ')
        ->setParameter('ayantdroit', '%'.$ayantdroit.'%')
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
        ')
        ->setParameter('invalidite', '%' . $invalidite . '%')
        ->getResult();
    }

    /**
     * Retourne les statistiques de saisies par agents de saisie
     *
     * @return User
     */
    public function getUserStats($direction)
    {
        return $this->manager->createQuery(
            'SELECT u.fullName as fullName, COUNT(r.numActeRevers) as nbReversion,
                COUNT(i.numActeInval) as nbInvalidite, e.libelle as libelle
            FROM App\Entity\User u
            JOIN u.reversions r
            JOIN u.invalidites i
            JOIN u.equipe e
            GROUP BY fullName
            ORDER BY nbReversion, nbInvalidite '.$direction
        )
            ->getResult();
    }

    /**
     * Retourne les statistiques de saisies de l'agent de saisie
     *
     * @return Integer
     */
    public function getCompteur($user)
    {
        return $this->manager->createQuery(
            'SELECT COUNT(a.numeroActe) as compteur
            FROM App\Entity\ActeDeces a
            JOIN a.agentSaisie u
            WHERE u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }
}

?>