<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $produit = Array();
        for ($i=0; $i <3 ; $i++) { 
            $produit[$i] = new Produit();
            $produit[$i]->setCategorie($faker->word());
            $produit[$i]->setStock($faker->numberBetween(0, 100));
            $produit[$i]->setTitre($faker->word());
            $produit[$i]->setDescription($faker->paragraphs());
            $produit[$i]->setPrix($faker->numberBetween(0, 200));
            $produit[$i]->setQuantite($faker->numberBetween(0, 100));
            $produit[$i]->setCouleur($faker->safeColorName());
            $produit[$i]->setTaille($faker->regexify('[70-150]{2,3}[A-Z]{1}'));


            $manager->persist($produit[$i]);
        }

       
        $manager->flush();
    }
}
