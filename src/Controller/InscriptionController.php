<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionUtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);

        return $this->render('inscription/index.html.twig', [
            'titre_inscription' => 'Inscription',
            'form' => $form->createView(),
        ]);
    }
}
