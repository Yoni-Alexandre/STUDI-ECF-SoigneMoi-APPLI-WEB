<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\PlanningMedecin;
use App\Entity\Prescription;
use App\Entity\SpecialiteMedecin;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName);
            $utilisateur->setPrenom($faker->firstName);
            $utilisateur->setEmail($faker->email);

            $plainPassword = "any_temp_password";
            $encodedPassword = $this->passwordEncoder->hashPassword($utilisateur, $plainPassword);

            $utilisateur->setPassword($encodedPassword);
            $utilisateur->setRoles(['ROLE_USER']);
            $utilisateur->setAdressePostale($faker->address);

            $manager->persist($utilisateur);
        }

        // Création d'un utilisateur admin
        $admin = new Utilisateur();
        $admin->setNom('Admin');
        $admin->setPrenom('Admin');
        $admin->setEmail('yoni-brault@blanche-de-castille.fr');
        $plainPassword = "Y_a=B7-5&?2:2?>";
        $encodedPassword = $this->passwordEncoder->hashPassword($utilisateur, $plainPassword);
        $admin->setPassword($encodedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setAdressePostale('1 rue de la Paix, 75000 Paris');
        $manager->persist($admin);

        // Création de spécialités
        $specialites = [];
        for ($i = 0; $i < 10; $i++) {
            $specialite = new SpecialiteMedecin();
            $specialite->setSpecialite($faker->word);
            $specialite->setSlug($faker->slug);
            $manager->persist($specialite);
            $specialites[] = $specialite;
        }

        // Création de médecins
        $medecins = [];
        for ($i = 0; $i < 10; $i++) {
            $medecin = new Medecin();
            $medecin->setNom($faker->lastName);
            $medecin->setPrenom($faker->firstName);
            $medecin->setMatricule($faker->randomNumber(8));

            $randomSpecialite = $specialites[array_rand($specialites)];
            $medecin->setSpecialite($randomSpecialite);

            $manager->persist($medecin);
            $medecins[] = $medecin;
        }

        // Création des plannings
        $plannings = [];
        for ($i = 0; $i < 10; $i++) {
            $planning = new PlanningMedecin();
            $planning->setDate($faker->dateTimeBetween('now', '+1 month'));
            $planning->setMedecin($medecins[array_rand($medecins)]);

            $manager->persist($planning);
            $plannings[] = $planning;
        }

        // Création des médicaments
        $medicaments = [];
        for ($i = 0; $i < 10; $i++) {
            $medicament = new Medicament();
            $medicament->setNom($faker->word);
            $medicament->setPosologie($faker->sentence);

            $manager->persist($medicament);
            $medicaments[] = $medicament;
        }

        // Création des Préscriptions
        $prescriptions = [];
        for ($i = 0; $i < 10; $i++) {
            $prescription = new Prescription();
            $prescription->setNom($faker->word);
            $prescription->setDateDebutTraitement($faker->dateTimeBetween('now', '+1 month'));
            $prescription->setDateFinTraitement($faker->dateTimeBetween('+1 month', '+2 month'));
            $prescription->setMedicament($medicaments[array_rand($medicaments)]);

            $manager->persist($prescription);
            $prescriptions[] = $prescription;
        }

        // Création des Avis Médecins
        $avisMedecin = [];
        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis->setLibelle($faker->sentence);
            $avis->setDate($faker->dateTimeBetween('now', '+1 month'));
            $avis->setDescription($faker->paragraph);
            $avis->setMedecin($medecins[array_rand($medecins)]);
            $avis->setUtilisateur($utilisateur);
            $avis->setPrescription($prescriptions[array_rand($prescriptions)]);

            $manager->persist($avis);
            $avisMedecin[] = $avis;
        }

        $manager->flush();
    }
}