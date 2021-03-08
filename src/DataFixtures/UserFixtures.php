<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder) {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    public function load(ObjectManager $manager)
    { 
        $pwd=$this->userPasswordEncoder->encodePassword(new User(), 'test');
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $user = new User(); 
            $user->setEmail($faker->email);
            $user->setName($faker->name);
            $user->setPassword($pwd);
            $this->addReference("user" . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
