<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Stock;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $categories = Array();
        for ($i=0; $i <3 ; $i++) { 
            $categories[$i] = new Categorie();
            $categories[$i]->setNom($faker->word());
            $manager->persist($categories[$i]);
        }

        // $stock = Array();
        // for ($i=0; $i < 3 ; $i++) { 
        //     $stock[$i] = new Stock();
        //     $stock[$i]->setQuantite($faker->randomDigitNotNull());
        //     $manager->persist($stock[$i]);
        // }
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
