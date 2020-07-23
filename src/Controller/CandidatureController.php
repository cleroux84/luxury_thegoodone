<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/candidature{id}", name="candidature")
     */
    public function index()
    {
        return $this->render('candidature/index.html.twig', [
            'controller_name' => 'CandidatureController',
        ]);
    }
}
