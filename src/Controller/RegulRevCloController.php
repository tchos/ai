<?php

namespace App\Controller;

use App\Entity\RegulRevClo;
use App\Form\RegulRevCloType;
use App\Form\SearchReversionRegulCloType;
use App\Service\Statistiques;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegulRevCloController extends AbstractController
{
    /**
     * @Route("/regul/rev/clo", name="regul_rev_clo")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, Statistiques $statistiques)
    {
        $reversion = new RegulRevClo();
        $ay = null;
        $form = $this->createForm(SearchReversionRegulCloType::class, $reversion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ayantDroit = $reversion->getNomsAyantDroit();
            $ay = $statistiques->findADClo($ayantDroit);
            if (empty($ay)) {
                $this->addFlash('danger',
                    '<strong>'.$ayantDroit."</strong> n'a pas été trouvé dans la base des ayants droit 
                    dont on a clôturé un élément de salaire."
                );
            }
        }

        return $this->render('regul_reversion/cloture/index.html.twig', [
            'ay' => $ay,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversion($this->getUser()),
        ]);
    }

    /**
     * Permet de mettre à jour un acte.
     *
     * @Route("regul/rev/clo/{id}/edit", name="regul_rev_clo_edit", requirements={"id":"\d+"})
     * @IsGranted("ROLE_USER")
     */
    public function updateReversionClo(EntityManagerInterface $manager, Request $request, RegulRevClo $reversion,
        Statistiques $statistiques): Response
    {
        $form = $this->createForm(RegulRevCloType::class, $reversion);

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
                "L'acte octroyant la pension de reversion à <strong>{$reversion->getNomsAyantDroit()}
                ({$reversion->getMatricul()})</strong> a 
                été enregistré avec succès. "
            );

            return $this->redirectToRoute('regul_rev_clo');
        }

        return $this->render('regul_reversion/cloture/edit.html.twig', [
            'reversion' => $reversion,
            'form' => $form->createView(),
            'compteur' => $statistiques->getCompteurReversion($this->getUser()),
            'compteurDuJour' => $statistiques->getDailyCompteurReversion($this->getUser()),
        ]);
    }
}
