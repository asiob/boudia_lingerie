<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ImagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $image = Array();
        for ($i=0; $i <3 ; $i++) { 
            $image[$i] = new Image();
            $image[$i]->setProduit($faker->word());
            $image[$i]->setNom($faker->word());
            $manager->persist($image[$i]);
        }

        $manager->flush();
    }
}
