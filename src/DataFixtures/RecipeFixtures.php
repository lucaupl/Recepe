<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 40; $i++){
            $recipe = new Recipe();
            $recipe->setName($faker->sentence(4));
            $recipe->setUser($this->getReference("user" . \random_int(0, 9)));
            $this->addReference("recipe" . $i , $recipe);
            $manager->persist($recipe);
        }
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
