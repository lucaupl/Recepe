<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function profile(RecipeRepository $recipeRepository): Response
    {
        return $this->render('user/profile.html.twig', [
            'recettes' => $recipeRepository->findBy([
                'user' => $this->getUser()->getId()
            ]
            )
            ]
        );
    }
}
