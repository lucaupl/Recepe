<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

    /**
     * @Route("/recette/{id}/edit", name="recette_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and user === recette.getUser()", message="Vous n'êtes pas propriétaire de cette recette")
     */
    public function edit(Recipe $recette, Request $request, EntityManagerInterface $manager)
    {
        $copyingredients = new ArrayCollection();
        $copysteps = new ArrayCollection();

        foreach($recette->getIngredients() as $ingredient){
            $copyingredients->add($ingredient);
        }

        foreach($recette->getSteps() as $step) {
            $copysteps->add($step);
        }

        $form = $this->createForm(RecipeType::class, $recette);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach($copyingredients as $ingredient){
                if (!$recette->getIngredients()->contains($ingredient)){
                    $manager->remove($ingredient);
                }
            }
            foreach($copysteps as $step){
                if (!$recette->getSteps()->contains($step)){
                    $manager->remove($step);
                }
            }
            $manager->persist($recette);
            $manager->flush();
            return $this->redirectToRoute("recette");
        }
        return $this->render('recette/edit.html.twig', [
            'form' => $form->createView(),
            'recette' => $recette
        ]);

    }
    /**
     * @Route("/recette/{id}/delete", name="recette_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and user === recette.getUser()", message="Vous n'êtes pas propriétaire de cette recette")
     */
    public function delete(Recipe $recette, EntityManagerInterface $manager)
    {
        $manager->remove($recette);
        $manager->flush();
        return $this->redirectToRoute("profile");
    }
}