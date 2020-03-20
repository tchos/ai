<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEquipeController extends AbstractController
{
    /**
     * @Route("/admin/equipe/new", name="admin_equipe_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($equipe);
            $manager->flush();

            $this->addFlash("success", "Equipe créée avec succès !");

            return $this->redirectToRoute('admin_equipe_create');
        }

        return $this->render('admin/equipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Liste des équipes
     * @Route("admin/equipe", name="admin_equipe_show")
     *
     * @param EquipeRepository $equipeRepository
     * @return void
     */
    public function listEquipe(EquipeRepository $equipeRepository)
    {
        return $this->render('admin/equipe/show.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }
}
