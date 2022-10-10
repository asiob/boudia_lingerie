<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create( locale: 'fr_FR');
        $client = Array();
        for ($i=0; $i <30 ; $i++) { 
            $client[$i] = new Client();
            $client[$i]->setName($faker->word());
            $client[$i]->setPrenom($faker->word());
            $client[$i]->setMail($faker->word());
            $client[$i]->setTelephone($faker->word());
            $client[$i]->setAdresse($faker->word());
            $client[$i]->setCodePostal($faker->randomNumber(5, true));
            $client[$i]->setVille($faker->word());
            $client[$i]->setPays($faker->word());
            
            $manager->persist($client[$i]);
        }

       

        $manager->flush();
    }
}
