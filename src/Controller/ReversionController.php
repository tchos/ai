<?php

namespace App\Controller;

use App\Entity\Reversion;
use App\Form\ReversionType;
use App\Service\Statistiques;
use App\Form\SearchReversionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReversionController extends AbstractController
{
    /**
     * @Route("reversion", name="reversion_index")
     * @IsGranted('ROLE_USER')
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

        $userStats = $statistiques->getUserStats('DESC');

        return $this->render('reversion/index.html.twig', [
            'ay' => $ay,
            'form' => $form->createView(),
            'userStats' => $userStats
        ]);
    }

    /**
     * Permet de mettre à jour un acte
     * @Route("reversion/{matricul}/edit", name="reversion_edit")
     * @IsGranted('ROLE_USER')
     *
     * @return Response
     */
    public function updateReversion(EntityManagerInterface $manager, Request $request, Reversion $reversion)
    {
        $form = $this->createForm(ReversionType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reversion->setAgentSaisie($this->getUser())
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
        ]);
    }
}
