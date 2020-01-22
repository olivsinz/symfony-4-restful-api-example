<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            $user->setFirstname('Firstname'.$i);
            $user->setLastname('LASTNAME'.$i);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
