<?php

namespace App\Controller;

use App\Entity\RegulRevSusp;
use App\Form\RegulRevSuspType;
use App\Form\SearchReversionRegulSuspType;
use App\Service\Statistiques;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegulRevSuspController extends AbstractController
{
    /**
     * @Route("/regul/rev/susp", name="regul_rev_susp")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $reversion = new RegulRevSusp();
        $ay = null;
        $form = $this->createForm(SearchReversionRegulSuspType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ayantDroit = $reversion->getNomsAyantDroit();
            $ay = $statistiques->findADSusp($ayantDroit);
            if (empty($ay)) {
                $this->addFlash('danger',
                    '<strong>'.$ayantDroit."</strong> n'a pas été trouvé dans la base des ayants droit 
                    suspendus."
                );
            }
        }

        return $this->render('regul_reversion/suspension/index.html.twig', [
            'controller_name' => 'RegulRevSuspController',
            'ay' => $ay,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversionSusp($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversionSusp($this->getUser()),
        ]);
    }

    /**
     * Permet de mettre à jour un acte.
     *
     * @Route("/regul/rev/susp/{matricul}/edit", name="regul_rev_susp_edit")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function updateReversion(EntityManagerInterface $manager, Request $request, RegulRevSusp $reversion,
        Statistiques $statistiques)
    {
        $form = $this->createForm(RegulRevSuspType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reversion->setAgentSaisie($this->getUser())
                      ->setDateRegul(new \DateTime())
                      ->setRegulariserYN(true)
            ;

            $manager->persist($reversion);
            $manager->flush();

            $this->addFlash(
                'success',
                "La pension de reversion attribuée à <strong>{$reversion->getNomsAyantDroit()}
                ({$reversion->getMatricul()})</strong> a 
                été régularisée avec succès. "
            );

            return $this->redirectToRoute('regul_rev_susp');
        }

        return $this->render('regul_reversion/suspension/editRevSusp.html.twig', [
            'reversion' => $reversion,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversionSusp($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversionSusp($this->getUser()),
        ]);
    }
}
