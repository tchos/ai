<?php

namespace App\Controller;

use App\Entity\RegulInvClo;
use App\Form\SearchInvCloType;
use App\Form\RegulInvCloType;
use App\Service\Statistiques;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RegulInvCloController extends AbstractController
{
    /**
     * @Route("/regul/inv/clo", name="regul_inv_clo")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $invalidite = new RegulInvClo();
        $inv = null;
        $form = $this->createForm(SearchInvCloType::class, $invalidite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inval = $invalidite->getNomAgentInvalide();
            $inv = $statistiques->findInvClo($inval);
            if (empty($inv)) {
                $this->addFlash(
                    'danger',
                    '<strong>'.$inval."</strong> n'a pas été trouvé dans la base des pensionnés 
                    d'invalidité dont des éléments de salaires ont été clôtrés."
                );
            }
        }

        return $this->render('regul_invalidite/cloture/index.html.twig', [
            'inv' => $inv,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvaliditeClo($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvaliditeClo($this->getUser()),
        ]);
    }

    /**
     * Permet de régulariser une pension d'invalidité.
     *
     * @Route("/regul/inv/clo/{matricul}/edit", name="regul_inv_clo_edit")
     * @IsGranted("ROLE_USER")
     *
     * @return void
     */
    public function updateInvalidite(RegulInvClo $invalidite, EntityManagerInterface $manager, Request $request,
                                     Statistiques $statistiques)
    {
        $form = $this->createForm(RegulInvCloType::class, $invalidite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invalidite->setAgentSaisie($this->getUser())
                ->setDateRegul(new \DateTime())
                ->setRegulariserYN(true)
            ;
            $manager->persist($invalidite);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'acte octroyant la pension d'invalidité à <strong>{$invalidite->getNomAgentInvalide()}
            ({$invalidite->getMatricul()})</strong> a été enregistré avec succès."
            );

            return $this->redirectToRoute('regul_inv_clo');
        }

        return $this->render('regul_invalidite/cloture/edit.html.twig', [
            'invalidite' => $invalidite,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvaliditeClo($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvaliditeClo($this->getUser()),
        ]);
    }
}
