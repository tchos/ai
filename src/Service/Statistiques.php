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
                COUNT(i.numActeInval) as nbInvalidite, COUNT(r.numActeRevers) + COUNT(i.numActeInval) AS total,
                 e.libelle as libelle
            FROM App\Entity\User u
            JOIN u.reversions r
            JOIN u.invalidites i
            JOIN u.equipe e
            GROUP BY fullName
            ORDER BY total '.$direction
        )
            ->getResult();
    }

    /**
     * Retourne les statistiques de saisies de l'agent de saisie
     * sur les pensions de réversion
     *
     * @return Integer
     */
    public function getCompteurReversion($user)
    {
        return $this->manager->createQuery(
            'SELECT COUNT(r.numActeRevers) as compteur
            FROM App\Entity\Reversion r
            JOIN r.agentSaisie u
            WHERE u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }

    /**
     * Retourne les statistiques de saisies de l'agent de saisie du jour
     * sur les pensions de réversion
     *
     * @return Integer
     */
    public function getDailyCompteurReversion($user)
    {
        return $this->manager->createQuery(
            'SELECT COUNT(r.numActeRevers) as compteurDuJour
            FROM App\Entity\Reversion r
            JOIN r.agentSaisie u
            WHERE CURRENT_DATE() <= r.dateSaisieRevers AND u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }

    /**
     * Retourne les statistiques de saisies de l'agent de saisie
     * sur les pensions d'invalidite
     *
     * @return Integer
     */
    public function getCompteurInvalidite($user)
    {
        return $this->manager->createQuery(
            'SELECT COUNT(i.numActeInval) as compteur
            FROM App\Entity\Invalidite i
            JOIN i.agentSaisie u
            WHERE u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }

    /**
     * Retourne les statistiques de saisies de l'agent de saisie du jour 
     * sur les pensions d'invalidite
     *
     * @return Integer
     */
    public function getDailyCompteurInvalidite($user)
    {
        return $this->manager->createQuery(
            'SELECT COUNT(i.numActeInval) as compteurDuJour
            FROM App\Entity\Invalidite i
            JOIN i.agentSaisie u
            WHERE CURRENT_DATE() <= i.dateSaisieInval AND u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }
}

?>