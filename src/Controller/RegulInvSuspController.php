<?php

namespace App\Controller;

use App\Entity\RegulInvSusp;
use App\Form\RegulInvSuspType;
use App\Form\SearchInvSuspType;
use App\Service\Statistiques;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegulInvSuspController extends AbstractController
{
    /**
     * @Route("/regul/inv/susp", name="regul_inv_susp")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $invalidite = new RegulInvSusp();
        $inv = null;
        $form = $this->createForm(SearchInvSuspType::class, $invalidite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inval = $invalidite->getNomAgentInvalide();
            $inv = $statistiques->findInvSusp($inval);
            if (empty($inv)) {
                $this->addFlash(
                    'danger',
                    '<strong>'.$inval."</strong> n'a pas été trouvé dans la base des pensionnés 
                    d'invalidité suspendus."
                );
            }
        }

        return $this->render('regul_invalidite/suspension/index.html.twig', [
            'inv' => $inv,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvaliditeSusp($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvaliditeSusp($this->getUser()),
        ]);
    }

    /**
     * Permet de régulariser une pension d'invalidité.
     *
     * @Route("/regul/inv/susp/{matricul}/edit", name="regul_inv_susp_edit")
     * @IsGranted("ROLE_USER")
     *
     * @return integer
     */
    public function updateInvalidite(RegulInvSusp $invalidite, EntityManagerInterface $manager, Request $request,
        Statistiques $statistiques)
    {
        $form = $this->createForm(RegulInvSuspType::class, $invalidite);
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

            return $this->redirectToRoute('regul_inv_susp');
        }

        return $this->render('regul_invalidite/suspension/edit.html.twig', [
            'invalidite' => $invalidite,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurInvaliditeSusp($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurInvaliditeSusp($this->getUser()),
        ]);
    }
}
