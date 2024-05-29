<?php

namespace App\Controller;

use App\Form\ModificationMotdePasseUtilisateurType;
use App\Repository\MedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(MedecinRepository $medecinRepository): Response
    {

        $medecins = $medecinRepository->findAll();

        return $this->render('compte/index.html.twig',[
            'titre_compte' => 'Mon compte',
            'medecins' => $medecins
        ]);
    }

    #[Route('/compte/modification-mot-de-passe', name: 'app_compte_modif-mdp')]
public function motDePasse(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
{
    # Récupération de l'utilisateur connecté
    $utilisateur = $this->getUser();
    # transmission de l'utilisateur connecté au formulaire
    $form = $this->createForm(ModificationMotdePasseUtilisateurType::class, $utilisateur, [
        // Ne pas oublier l'injection de dépendances pour le UserPasswordHasherInterface
        // On transmet le UserPasswordHasherInterface au formulaire
        'password_hashers' => $passwordHasher
    ]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        // persiste les données dans la table utilisateur
        $entityManager->flush();
        // notification Flash Messages
        $this->addFlash(
            'success',
            'Votre mot de passe a bien été modifié');
    }

    return $this->render('compte/motDePasse.html.twig',[
        'formulaireMotDePasse' => $form->createView()
    ]);
}
}
