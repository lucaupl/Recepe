<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
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
    public function index(RecipeRepository $recipeRepository): Response
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recipeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/recette/create", name="recette_create")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
       $recette = new Recipe();
       $form = $this->createForm(RecipeType::class, $recette);

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
