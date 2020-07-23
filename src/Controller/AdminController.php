<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\Client;
use App\Entity\JobOffer;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {

        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
        $countUsers = (count($users));

        $clients = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findAll();
        $countClients = (count($clients));

        $jobOffers = $this->getDoctrine()
        ->getRepository(JobOffer::class)
        ->findAll();
        $countJobOffers = (count($jobOffers));

        $candidatures = $this->getDoctrine()
        ->getRepository(Candidature::class)
        ->findAll();
        $countCandidatures = (count($candidatures));


        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'countUsers' => $countUsers,
            'countClients' => $countClients,
            'countJobOffers' => $countJobOffers,
            'countCandidatures' => $countCandidatures,
        ]);
    }
}
