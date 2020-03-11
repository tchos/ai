<?php

namespace App\Controller;

use App\Entity\Invalidite;
use App\Form\InvaliditeType;
use App\Form\SearchInvaliditeType;
use App\Service\Statistiques;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminInvaliditeController extends AbstractController
{
    /**
     * @Route("/admin/invalidite", name="admin_invalidite")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $invalidite = new Invalidite();
        $inv = null;
        $form = $this->createForm(SearchInvaliditeType::class, $invalidite);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $inval = $invalidite->getNomAgentInvalide();
            $inv = $statistiques->findInvalidite($inval);
        }

        return $this->render('admin/invalidite/index.html.twig', [
            'inv' => $inv,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de régulariser une pension d'invalidité
     * 
     * @Route("/admin/invalidite/{matriculInv}/edit", name="admin_invalidite_edit")
     *
     * @param Invalidite $invalidite
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return void
     */
    public function updateInvalidite(Invalidite $invalidite, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(InvaliditeType::class, $invalidite);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $invalidite->setAgentSaisie($this->getUser())
                       ->setResultat(4)
            ;
            $manager->persist($invalidite);
            $manager->flush();

            $this->addFlash("success",
            "L'acte octroyant la pension d'invalidité à <strong>{$invalidite->getNomAgentInvalide()}
            ({$invalidite->getMatriculInv()})</strong> a été enregistré avec succès.");

            return $this->redirectToRoute('admin_invalidite');
        }

        return $this->render("admin/invalidite/edit.html.twig", [
            'invalidite' => $invalidite,
            'form' => $form->createView()
        ]);

    }
}