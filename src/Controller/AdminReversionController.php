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

class AdminReversionController extends AbstractController
{
    /**
     * @Route("admin/reversion", name="admin_reversion")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $reversion = new Reversion();
        $ay = null;
        $form = $this->createForm(SearchReversionType::class, $reversion);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $ayantDroit = $reversion->getNomsAyantDroit();
            $ay = $statistiques->findAyantDroit($ayantDroit);
        }
        
        return $this->render('admin/reversion/index.html.twig', [
            'ay' => $ay,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser())
        ]);
    }

    /**
     * Permet de mettre à jour un acte
     * @Route("admin/reversion/{matricul}/edit", name="admin_reversion_edit")
     *
     * @return Response
     */
    public function updateReversion(EntityManagerInterface $manager, Request $request, Reversion $reversion,
        Statistiques $statistiques)
    {
        $form = $this->createForm(ReversionType::class, $reversion);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $reversion->setAgentSaisie($this->getUser())
                      ->setResultat(4)
            ;

            $manager->persist($reversion);
            $manager->flush();

            $this->addFlash("success", 
                "L'acte octroyant la pension de reversion à <strong>{$reversion->getNomsAyantDroit()}</strong> a 
                été enregistré avec succès. ");
            
            return $this->redirectToRoute("admin_reversion");
        }

        return $this->render("admin/reversion/edit.html.twig", [
            'reversion' => $reversion,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser())
        ]);
    }
}
