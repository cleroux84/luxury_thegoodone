<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Form\CandidatureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/candidature")
 */
class CandidatureController extends AbstractController
{
    /**
     * @Route("/", name="candidature_index", methods={"GET"})
     */
    public function index(): Response
    {
        $candidatures = $this->getDoctrine()
            ->getRepository(Candidature::class)
            ->findAll();
            

        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }

    /**
     * @Route("/new/{id}", name="candidature_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserInterface $user, JobOffer $jobOffer): Response
    {
        $candidature = new Candidature();   
        $candidature->setCreatedAt(new \DateTime('now'));
        $candidature->setUser($user);
        $candidature->setJobOffer($jobOffer);
              
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($candidature);
        $entityManager->flush();

        return $this->render('job_offer/show.html.twig', [
            'candidature' => $candidature,
            'job_offer' => $jobOffer,
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_show", methods={"GET"})
     */
    public function show(Candidature $candidature): Response
    {
        return $this->render('candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidature $candidature): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidature_index');
        }

        return $this->render('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="candidature_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidature $candidature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidature_index');
    }
}
