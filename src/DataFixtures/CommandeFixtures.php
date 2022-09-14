<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\commande;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $commande = Array();
        for ($i=0; $i <3 ; $i++) { 
            $commande[$i] = new Commande();
            $commande[$i]->setClient($faker->numberBetween(0, 100));
            $commande[$i]->setDate($faker->date());

            $manager->persist($commande[$i]);
        }

        $manager->flush();
    }
}
