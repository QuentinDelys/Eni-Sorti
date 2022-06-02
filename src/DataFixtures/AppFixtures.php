<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
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
        $this->addVille($manager);
        $this->addCampus($manager);
        $this->addLieux($manager);
        $this->addParticipant($manager);
        $this->addEtat($manager);
        $this->addSortie($manager);

    }


    public function addVille(ObjectManager $manager): void
    {
        $villeRennes = new Ville();
        $villeNiort = new Ville();
        $villeQuimper = new Ville();
        $villeNantes = new Ville();
        $villeRennes->setNom("Rennes")->setCodePostal(35000);
        $villeNiort->setNom("Niort")->setCodePostal(79000);
        $villeQuimper->setNom("Quimper")->setCodePostal(29000);
        $villeNantes->setNom("Nantes")->setCodePostal(44000);
        $manager->persist($villeRennes);
        $manager->persist($villeNiort);
        $manager->persist($villeQuimper);
        $manager->persist($villeNantes);

        $manager->flush();

    }

    public function addCampus(ObjectManager $manager): void
    {
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

    public function addLieux(ObjectManager $manager): void
    {
        //création des lieux
        $lieux = ['bar', 'taverne', 'piscine', 'patinoire', 'plage', 'bibliothèque', 'cinéma', 'piscine'];
        $villes = $manager->getRepository(Ville::class)->findAll();
        for ($i = 0; $i < 30; $i++) {
            $lieu = new Lieu();
            $lieu->setNom($this->generator->randomElement($lieux));
            $lieu->setRue($this->generator->streetName);
            $lieu->setville($this->generator->randomElement($villes));
            $lieu->setLatitude($this->generator->latitude);
            $lieu->setLongitude($this->generator->longitude);

            $manager->persist($lieu);
        }
        $manager->flush();
    }

    public function addParticipant(ObjectManager $manager): void
    {
        $campus = $manager->getRepository(Campus::class)->findAll();
        //Création d'un participant test
        $participant = new Participant();
        $participant->setNom("La pointe")->setPrenom("Boby")->setTelephone(0606060606)
            ->setEmail("bobylapointe@test-eni.bzh")->setActif("true")
            ->setUsername("bobytest")->setPassword("Test123!");
        $manager->persist($participant);

        //Création des participants (20)

        for ($i = 0; $i < 20; $i++) {
            $participant = new Participant();
            $participant->setNom($this->generator->lastName);
            $participant->setPrenom($this->generator->firstName);
            $participant->setTelephone($this->generator->phoneNumber);
            $participant->setEmail($this->generator->email);
            $participant->setActif($this->generator->boolean(100));
            $participant->setCampus($this->generator->randomElement($campus));

            $participant->setUsername($this->generator->userName);
            $participant->setPassword($this->hasher->hashPassword($participant, "123"));

            $manager->persist($participant);
        }
        $manager->flush();
    }

    public function addEtat(ObjectManager $manager): void
    {
        //création des états
        $etats = ['Créée', 'Ouverte', 'Clôturée', 'Activité en cours', 'passée', 'Annulée', 'Historisée'];
        $etat1 = new Etat();
        $etat2 = new Etat();
        $etat3 = new Etat();
        $etat4 = new Etat();
        $etat5 = new Etat();
        $etat6 = new Etat();
        $etat7 = new Etat();
        $etat1->setLibelle('Créée');
        $etat2->setLibelle('Ouverte');
        $etat3->setLibelle('Clôturée');
        $etat4->setLibelle('Activité en cours');
        $etat5->setLibelle('passée');
        $etat6->setLibelle('Annulée');
        $etat7->setLibelle('Historisée');
        $manager->persist($etat1);
        $manager->persist($etat2);
        $manager->persist($etat3);
        $manager->persist($etat4);
        $manager->persist($etat5);
        $manager->persist($etat6);
        $manager->persist($etat7);

        $manager->flush();

    }

    public function addSortie(ObjectManager $manager): void
    {
        $participant = $manager->getRepository(Participant::class)->findAll();
        $campus = $manager->getRepository(Campus::class)->findAll();
        $lieu = $manager->getRepository(Lieu::class)->findAll();
        $etat = $manager->getRepository(Etat::class)->findAll();

        //création des sorties

        for ($i = 0; $i < 10; $i++){
            $sortie = new Sortie();
            $sortie->setOrganisateur($this->generator->randomElement($participant));
            $sortie->setCampus($this->generator->randomElement($campus));
            $sortie->setLieu($this->generator->randomElement($lieu));
            $sortie->setEtat($this->generator->randomElement($etat));
            $sortie->setNom($this->generator->name);
            $sortie->setDateHeureDebut($this->generator->dateTimeBetween('now', '1 month'));
            $sortie->setDateLimiteInscription($this->generator->dateTimeBetween('-1 month', 'now'));
            $sortie->setNbInscriptionMax(($this->generator->randomNumber([5], [20])));
            $sortie->setInfosSortie($this->generator->paragraph);

            $manager->persist();

        }

        $manager->flush();

    }
}
