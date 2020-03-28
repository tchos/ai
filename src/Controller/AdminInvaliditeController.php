<?php

namespace App\Controller;

use App\Entity\Invalidite;
use App\Service\Paginator;
use App\Form\InvaliditeType;
use App\Service\Statistiques;
use App\Form\SearchInvaliditeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminInvaliditeController extends AbstractController
{
    /**
     * @Route("/admin/invalidite/{fake}/index", name="admin_invalidite")
     */
    public function index(Request $request, Statistiques $statistiques, $fake)
    {
        $invalidite = new Invalidite();
        $inv = null;
        $form = $this->createForm(SearchInvaliditeType::class, $invalidite);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $inval = $invalidite->getNomAgentInvalide();
            $inv = $statistiques->findInvalidite($inval);
            if (empty($inv)) {
                $this->addFlash(
                    "danger",
                    "<strong>" . $inval . "</strong> n'a pas été trouvé dans la base des pensionnés
                    d'invalidité appelés à clarifier leur situation."
                );
            }
        }

        return $this->render('admin/invalidite/index.html.twig', [
            'fake' => $fake,
            'inv' => $inv,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
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
    public function updateInvalidite(Invalidite $invalidite, EntityManagerInterface $manager, Request $request,
        Statistiques $statistiques)
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

            return $this->redirectToRoute('admin_invalidite', ['fake' => 'false']);
        }

        return $this->render("admin/invalidite/edit.html.twig", [
            'invalidite' => $invalidite,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);

    }

    /**
     * Permet de régulariser une pension d'invalidité
     * 
     * @Route("/admin/invalidite/fake/{matriculInv}/edit", name="admin_invalidite_edit_fake")
     *
     * @param Invalidite $invalidite
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return void
     */
    public function nonAuthentikInvalidite(
        Invalidite $invalidite,
        EntityManagerInterface $manager,
        Request $request,
        Statistiques $statistiques
    ) {
        $form = $this->createForm(InvaliditeType::class, $invalidite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invalidite->setAgentSaisie($this->getUser())
                ->setResultat(4);
            $manager->persist($invalidite);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'acte octroyant la pension d'invalidité à <strong>{$invalidite->getNomAgentInvalide()}
            ({$invalidite->getMatriculInv()})</strong> a été enregistré avec succès."
            );

            return $this->redirectToRoute('admin_invalidite', ['fake' => 'true']);
        }

        return $this->render("admin/invalidite/fake.html.twig", [
            'invalidite' => $invalidite,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);
    }

    /**
     * Permet de voir les saisies effectuées par l'agent de saisie
     *
     * @Route("admin/invalidite/{page<\d+>?1}", name="admin_invalidite_show")
     * 
     * @param Paginator $paginator
     * @param [type] $page
     * @param Statistiques $statistiques
     * @return void
     */
    public function show(Paginator $paginator, $page, Statistiques $statistiques)
    {
        $paginator->setEntityClass(Invalidite::class)
            ->setUser($this->getUser())
            ->setPage($page)
            ->setLimit(10);

        return $this->render("admin/invalidite/show.html.twig", [
            'paginator' => $paginator,
            'compteur' => $statistiques->getCompteurInvalidite($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvalidite($this->getUser())
        ]);
    }
}
