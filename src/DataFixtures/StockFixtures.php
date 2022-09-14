<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Stock;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StockFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $stock = Array();
        for ($i=0; $i <3 ; $i++) { 
            $stock[$i] = new Stock();
            $stock[$i]->setQuantite($faker->numberBetween(0, 100));
            $manager->persist($stock[$i]);
        }

        $manager->flush();
    }
}
