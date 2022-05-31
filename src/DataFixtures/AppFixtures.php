<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture

{
    private ObjectManager $manager;
    private Generator $generator;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->generator = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        //Création d'un participant test
        $participant = new Participant();
        $participant->setNom("La pointe")->setPrenom("Boby")->setTelephone(0606060606)
            ->setEmail("bobylapointe@test-eni.bzh")->setActif("true")
            ->setUsername("bobytest")->setPassword("Test123!");
        $manager->persist($participant);

        //Création des participants (20)
        /**
         * @var Generator $faker
         */
        $faker = Faker\factory::create('fr_FR');
        $participants = Array();
        for ($i = 0; $i < 20; $i++) {
            $participants[$i] = new Participant();
            $participants[$i]->setNom($faker->lastName);
            $participants[$i]->setPrenom($faker->firstName);
            $participants[$i]->setTelephone($faker->phoneNumber);
            $participants[$i]->setEmail($faker->email);
            $participants[$i]->setActif($faker->boolean(100));
            $participants[$i]->setUsername($faker->userName);
            $participants[$i]->setPassword($faker->password());



            $manager->persist($participants[$i]);
        }

        //création des lieux



        //Création des villes
        $villeRennes = new Ville();
        $villeNiort = new Ville();
        $villeQuimper = new Ville();
        $villeNantes = new Ville();
        $villeRennes->setNom("Rennes")->setCodePostal(35000);
        $villeNiort->setNom("Niort")->setCodePostal(79000);
        $villeQuimper->setNom("Quimper")->setCodePostal(29000);
        $villeNantes->setNom("Nantes")->setCodePostal(44000);
        $manager-> persist($villeRennes);
        $manager-> persist($villeNiort);
        $manager-> persist($villeQuimper);
        $manager-> persist($villeNantes);

        //Création des CAMPUS
        $campusRennes = new Campus();
        $campusNantes = new Campus();
        $campusNiort = new Campus();
        $campusQuimper = new Campus();
        $campusRennes->setNom("Campus Rennes");
        $campusNantes->setNom("Campus Nantes");
        $campusNiort->setNom("Campus Niort");
        $campusQuimper->setNom("Campus Quimper");
        $manager->persist($campusRennes);
        $manager->persist($campusNantes);
        $manager->persist($campusNiort);
        $manager->persist($campusQuimper);



        $manager->flush();
    }
}
