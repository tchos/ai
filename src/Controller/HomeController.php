<?php

namespace App\Controller;

use App\Service\Paginator;
use App\Service\Statistiques;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil du site
     * 
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * Permet de voir les statistiques de saisies de tous les utilisateurs
     * 
     * @Route("/statistiques", name="statistiques")
     *
     * @param Statistiques $statistiques
     * @return void
     */
    public function voirSaisie(Statistiques $statistiques)
    {
        return $this->render("home/stat.html.twig", [
            'userStats' => $statistiques->getUserStats('DESC'),
            'regulRevers' => $statistiques->getCountRegulReversion(),
            'regulInval' => $statistiques->getCountRegulInvalidite()
        ]);
    }

    /**
     * Permet de voir les statistiques de saisies de tous les utilisateurs
     *
     * @Route("/statsregul", name="statsregul")
     *
     * @param Statistiques $statistiques
     * @return void
     */
    public function voirSaisieRegul(Statistiques $statistiques)
    {
        return $this->render("home/statsregul.html.twig", [
            'userStats' => $statistiques->getUserStatsContentieux('DESC'),
            'regulRevSusp' => $statistiques->getCountRegulReversionSusp(),
            'regulRevClo' => $statistiques->getCountRegulInvaliditeClo(),
            'regulInvSusp' => $statistiques->getCountRegulInvaliditeSusp(),
            'regulInvClo' => $statistiques->getCountRegulInvaliditeClo(),
        ]);
    }
}
