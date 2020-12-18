<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Step;
use App\DataFixtures\RecepeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StepsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++){
            $steps = new Step();
            $steps->setName($faker->sentence(6));
            $steps->setRecepe($this->getReference("recepe" . \random_int(0, 39)));
            $manager->persist($steps);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [RecepeFixtures::class];
    }
}
