<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminActeController extends AbstractController
{
    /**
     * @Route("/admin/acte", name="admin_acte")
     */
    public function index()
    {
        return $this->render('admin_acte/index.html.twig', [
            'controller_name' => 'AdminActeController',
        ]);
    }
}
