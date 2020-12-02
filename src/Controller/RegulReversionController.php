<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegulReversionController extends AbstractController
{
    /**
     * @Route("/regul/reversion", name="regul_reversion")
     */
    public function index()
    {
        return $this->render('regul_reversion/index.html.twig', [
            'controller_name' => 'RegulReversionController',
        ]);
    }
}
