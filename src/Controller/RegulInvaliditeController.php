<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegulInvaliditeController extends AbstractController
{
    /**
     * @Route("/regul/invalidite", name="regul_invalidite")
     */
    public function index()
    {
        return $this->render('regul_invalidite/index.html.twig', [
            'controller_name' => 'RegulInvaliditeController',
        ]);
    }
}
