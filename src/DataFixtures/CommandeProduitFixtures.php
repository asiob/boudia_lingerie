<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\commandeProduit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommandeProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $commandeProduit = Array();
        for ($i=0; $i <3 ; $i++) { 
            $commandeProduit[$i] = new CommandeProduit();
            $commandeProduit[$i]->setCommande($faker->numberBetween(0, 100));
            $commandeProduit[$i]->setProduit($faker->numberBetween(0, 100));
            $commandeProduit[$i]->setQuantite($faker->numberBetween(0, 100));
            $commandeProduit[$i]->setPrix($faker->numberBetween(0, 100));

            $manager->persist($commandeProduit[$i]);
        }

        $manager->flush();
    }
}
