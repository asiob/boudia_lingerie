<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $categorie = Array();
        for ($i=0; $i <3 ; $i++) { 
            $categorie[$i] = new Categorie();
            $categorie[$i]->setNom($faker->word());

            $manager->persist($categorie[$i]);
        }

        $manager->flush();
    }
}
