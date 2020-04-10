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

    public function getStats()
    {
        $nbUsers = $this->getUserCount();
        $nbEquipes = $this->getEquipeCount();
        $nbReversRegul = $this->getCountRegulReversion();
        $nbInvalRegul = $this->getCountRegulInvalidite();

        return compact('nbUsers', 'nbEquipes', 'nbReversRegul', 'nbInvalRegul');
    }

    /**
     * Permet de rechercher une pension de réversion à partir de son nom
     *
     * @param [type] $ayantdroit
     * @return Entity ayantdroit
     */
    public function findAyantDroit($ayantdroit)
    {
        $mots_cles = explode(" ", $ayantdroit);
        for($i=0; $i < sizeof($mots_cles); $i++)
        {
            if($i == 0)
            {
                $recherche = '
                    SELECT r 
                    FROM App\Entity\Reversion r
                    WHERE (r.nomsAyantDroit LIKE :mot_clef'.$i. ' OR r.matricul LIKE :mot_clef' . $i . ')
                ';
            } 
            else
            {
                $recherche .= ' AND (r.nomsAyantDroit LIKE :mot_clef' . $i . '
                    OR r.matricul LIKE :mot_clef' . $i . ')';
            }
        }

        $query = $this->manager->createQuery($recherche);
        for($i = 0; $i < sizeof($mots_cles); $i++)
        {
            $mot_clef = trim($mots_cles[$i]);
            $query->setParameter('mot_clef'.$i.'', '%'.$mot_clef.'%');
        } 

        return $query->getResult();

        /**
        return $this->manager->createQuery('
            SELECT r 
            FROM App\Entity\Reversion r
            WHERE r.nomsAyantDroit LIKE :ayantdroit
        ')
        ->setParameter('ayantdroit', '%'.$ayantdroit.'%')
        ->getResult(); */
    }

    /**
     * Permet de rechercher une pension d'invalidité à partir du nom
     *
     * @param [type] $invalidite
     * @return Entity invalidite
     */
    public function findInvalidite($invalidite)
    {
        $mots_cles = explode(" ", $invalidite);
        for ($i = 0; $i < sizeof($mots_cles); $i++) {
            if ($i == 0) {
                $recherche = '
                    SELECT i
                    FROM App\Entity\Invalidite i
                    WHERE (i.nomAgentInvalide LIKE :mot_clef' . $i . ' OR i.matriculInv LIKE :mot_clef' . $i . ')
                ';
            } else {
                $recherche .= ' AND (i.nomAgentInvalide LIKE :mot_clef' . $i . ' 
                    OR i.matriculInv LIKE :mot_clef' . $i . ')';
            }
        }

        $query = $this->manager->createQuery($recherche);
        
        for ($i = 0; $i < sizeof($mots_cles); $i++) {
            $mot_clef = trim($mots_cles[$i]);
            $query->setParameter('mot_clef' . $i . '', '%' . $mot_clef . '%');
        }

        return $query->getResult();
        /**
        return $this->manager->createQuery('
            SELECT i
            FROM App\Entity\Invalidite i
            WHERE i.nomAgentInvalide LIKE :invalidite
        ')
        ->setParameter('invalidite', '%' . $invalidite . '%')
        ->getResult();
        */
    }

    /**
     * Retourne les statistiques de saisies par agents de saisie
     *
     * @return User
     */
    public function getUserStats($direction)
    {
        return $this->manager->createQuery(
            'SELECT u.fullName AS fullName, COUNT(DISTINCT r.numActeRevers) AS nbReversion,
                COUNT(DISTINCT i.numActeInval) AS nbInvalidite, 
                COUNT(DISTINCT r.numActeRevers) + COUNT(DISTINCT i.numActeInval) AS total,
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
            WHERE CURRENT_DATE() <= r.dateSaisie AND u = :user'
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
            WHERE CURRENT_DATE() <= i.dateSaisie AND u = :user'
        )
            ->setParameter('user', $user)
            ->getSingleScalarResult();
    }

    /**
     * Nombre de réversions régularisés
     *
     * @return Integer
     */
    public function getCountRegulReversion()
    {
        return $this->manager->createQuery(
            'SELECT COUNT(r.numActeRevers) AS nbReversRegul
             FROM App\Entity\Reversion r
             WHERE r.resultat = 4'
        )
        ->getSingleScalarResult();
    }

    /**
     * Nombre d'invalidités régularisées
     *
     * @return Integer
     */
    public function getCountRegulInvalidite()
    {
        return $this->manager->createQuery(
            'SELECT COUNT(i.numActeInval) AS nbInvalRegul
             FROM App\Entity\Invalidite i
             WHERE i.resultat = 4'
        )
        ->getSingleScalarResult();
    }

    /**
     * Nombres de users inscrits
     *
     * @return void
     */
    public function getUserCount()
    {
        return $this->manager->createQuery("SELECT COUNT(u) FROM App\Entity\User u")->getSingleScalarResult();
    }

    /**
     * Nombres d'équipes inscrites
     *
     * @return void
     */
    public function getEquipeCount()
    {
        return $this->manager->createQuery("SELECT COUNT(e) FROM App\Entity\Equipe e")->getSingleScalarResult();
    }
}

?>