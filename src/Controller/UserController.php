<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }
 /* fonction pourcentage */
            $pourcentage = 0;
            if($user->getEmail()){
                $pourcentage += (100/5);
            }
            if($user->getPassword()){
                $pourcentage += (100/5);
            }
            if($user->getGender()){
                $pourcentage += (100/5);
            }
            if($user->getFirstName()){
                $pourcentage += (100/5);
            }
            if($user->getLastName()){
                $pourcentage += (100/5);
            } 
  /*           if($user->getCurrentLocation()){
                $pourcentage += (100/13);
            } 
            if($user->getAddress()){
                $pourcentage += (100/13);
            } 
            if($user->getCountry()){
                $pourcentage += (100/13);
            } 
            if($user->getNationality()){
                $pourcentage += (100/13);
            } 
            if($user->getBirthDate()){
                $pourcentage += (100/13);
            } 
            if($user->getBirthPlace()){
                $pourcentage += (100/13);
            } 
            if($user->getExperience()){
                $pourcentage += (100/13);
            } 
            if($user->getJobCategory()){
                $pourcentage += (100/13);
            }  */
/*  continuer avec les 15 champs */


        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'pourcentage' => round($pourcentage),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
