<?php

namespace App\Controller;

use App\Entity\Reversion;
use App\Service\Paginator;
use App\Form\ReversionType;
use App\Service\Statistiques;
use PhpParser\Node\Stmt\Static_;
use App\Form\SearchReversionType;
use App\Repository\ReversionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
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
            if (empty($ay)) {
                $this->addFlash("danger",
                    "<strong>" . $ayantDroit . "</strong> n'a pas été trouvé dans la base des ayants droit 
                    appelés à clarifier leur situation."
                );
            }
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

    /**
     * @Route("/reversion/autocomplete", methods="GET", name="search_reversion", defaults={"_format"="json"})
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function searchAutocomplete(Request $request, EntityManagerInterface $manager, 
        ReversionRepository $reversionRepository)
    {
        // search_reversion[nomsAyantDroit]
        $requestString = $request->get('search_reversion[nomsAyantDroit]');

        $results = $reversionRepository->findReversion($requestString);

        //$response = new Response(json_encode($results));
        return new JsonResponse($results);

        //$response = new Response(json_encode($results));
        //$response->headers->set('Content-Type', 'application/json');
        //return $response;
    }
}
