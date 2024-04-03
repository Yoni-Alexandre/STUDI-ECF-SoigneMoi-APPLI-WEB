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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // persister les données dans la table utilisateur
            $entityManager->persist($utilisateur);
            // exécuter la requête
            $entityManager->flush();
        }

        return $this->render('inscription/index.html.twig', [
            'titre_inscription' => 'Inscription',
            'formulaireUtilisateurs' => $form->createView(),
        ]);
    }
}
