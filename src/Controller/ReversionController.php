<?php

namespace App\Controller;

use App\Entity\Reversion;
use App\Form\ReversionType;
use App\Service\Statistiques;
use App\Form\SearchReversionType;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\Static_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReversionController extends AbstractController
{
    /**
     * @Route("/reversion/search", name="reversion_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $reversion = new Reversion();
        $ay = null;
        $form = $this->createForm(SearchReversionType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ayantDroit = $reversion->getNomsAyantDroit();
            $ay = $statistiques->findAyantDroit($ayantDroit);
        }

        return $this->render('reversion/index.html.twig', [
            'ay' => $ay,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversion($this->getUser()),
        ]);
    }

    /**
     * Permet de mettre à jour un acte
     * @Route("reversion/{matricul}/edit", name="reversion_edit")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function updateReversion(EntityManagerInterface $manager, Request $request, Reversion $reversion,
        Statistiques $statistiques)
    {
        $form = $this->createForm(ReversionType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reversion->setAgentSaisie($this->getUser())
                      ->setDateSaisie(new \DateTime())
                      ->setResultat(4);

            $manager->persist($reversion);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'acte octroyant la pension de reversion à <strong>{$reversion->getNomsAyantDroit()}</strong> a 
                été enregistré avec succès. "
            );

            return $this->redirectToRoute("reversion_index");
        }

        return $this->render("reversion/edit.html.twig", [
            'reversion' => $reversion,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversion($this->getUser())
        ]);
    }

    /**
     * Permet de voir les saisies effectuées par l'agent de saisie
     *
     * @Route("reversion/{page<\d+>?1}", name="reversion_show")
     * @IsGranted("ROLE_USER")
     * 
     * @param Paginator $paginator
     * @param [type] $page
     * @param Statistiques $statistiques
     * @return void
     */
    public function show(Paginator $paginator, $page, Statistiques $statistiques)
    {
        $paginator->setEntityClass(Reversion::class)
                  ->setUser($this->getUser())
                  ->setPage($page)
                  ->setLimit(10)
        ;

        return $this->render("reversion/show.html.twig", [
            'paginator' => $paginator,
            'compteur' => $statistiques->getCompteurReversion($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);
    }
}
