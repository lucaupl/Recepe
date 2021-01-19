<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ingredient;
use App\DataFixtures\RecipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IngredientsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 40; $i++){
            $ingredient = new Ingredient();
            $ingredient->setName($faker->word);
            $ingredient->setRecette($this->getReference("recipe" . \random_int(0, 39)));
            $manager->persist($ingredient);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [RecipeFixtures::class];
    }
}
