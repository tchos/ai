<?php

namespace App\Controller;

use App\Entity\Invalidite;
use App\Form\InvaliditeType;
use App\Service\Statistiques;
use App\Form\SearchInvaliditeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvaliditeController extends AbstractController
{
    /**
     * @Route("/invalidite", name="invalidite_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $invalidite = new Invalidite();
        $inv = null;
        $form = $this->createForm(SearchInvaliditeType::class, $invalidite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inval = $invalidite->getNomAgentInvalide();
            $inv = $statistiques->findInvalidite($inval);
        }

        return $this->render('invalidite/index.html.twig', [
            'inv' => $inv,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);
    }

    /**
     * Permet de régulariser une pension d'invalidité
     * 
     * @Route("/invalidite/{matriculInv}/edit", name="invalidite_edit")
     * @IsGranted("ROLE_USER")
     *
     * @param Invalidite $invalidite
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return void
     */
    public function updateInvalidite(Invalidite $invalidite, EntityManagerInterface $manager, Request $request,
        Statistiques $statistiques)
    {
        $form = $this->createForm(InvaliditeType::class, $invalidite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invalidite->setAgentSaisie($this->getUser())
                       ->setDateSaisieInval(new \DateTime())
                       ->setResultat(4)
            ;
            $manager->persist($invalidite);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'acte octroyant la pension d'invalidité à <strong>{$invalidite->getNomAgentInvalide()}
            ({$invalidite->getMatriculInv()})</strong> a été enregistré avec succès."
            );

            return $this->redirectToRoute('invalidite_index');
        }

        return $this->render("invalidite/edit.html.twig", [
            'invalidite' => $invalidite,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);
    }
}
