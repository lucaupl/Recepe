<?php

namespace App\Controller;

use App\Entity\Recepe;
use App\Form\RecepeType;
use App\Repository\RecepeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(RecepeRepository $recepeRepository): Response
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recepeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/recette/create", name="recette_create")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
       $recette = new Recepe();
       $form = $this->createForm(RecepeType::class, $recette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recette->setUser($this->getUser());
            $manager->persist($recette);
            $manager->flush();
            return $this->redirectToRoute("recette");
        }

       return $this->render('recette/create.html.twig', [
           'form' => $form->createView(),
       ]);
    }
}
