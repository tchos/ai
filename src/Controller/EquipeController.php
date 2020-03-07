<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe/new", name="equipe_create")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($equipe);
            $manager->flush();

            $this->addFlash("success", "Equipe créée avec succès !");

            return $this->redirectToRoute('equipe_create');
        }

        return $this->render('equipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
