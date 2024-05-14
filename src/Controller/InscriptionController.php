<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionUtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'un nouvel utilisateur
        $utilisateur = new Utilisateur();
        // Création du formulaire et liaison avec l'objet utilisateur
        $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);

        // Récupération des données du formulaire grâce à la requête HTTP (dans la barre d'adresses du navigateur)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // persiste les données dans la table utilisateur
            $entityManager->persist($utilisateur);
            // exécute la requête vers la base de donneés
            $entityManager->flush();
            // Flash Messages
            $this->addFlash(
                'success',
                'Votre compte est bien créé. Vous pouvez vous connecter.');

            return $this->redirectToRoute('app_connexion');
        }

        return $this->render('inscription/index.html.twig', [
            'titre_inscription' => 'Inscription',
            'formulaireUtilisateurs' => $form->createView(),
        ]);
    }
}
