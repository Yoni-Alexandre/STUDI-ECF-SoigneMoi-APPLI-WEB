<?php

namespace App\Controller;

use App\Entity\RendezVousUtilisateur;
use App\Form\ModificationMotdePasseUtilisateurType;
use App\Form\RendezVousUtilisateurType;
use App\Repository\MedecinRepository;
use App\Repository\RendezVousUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
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

    # liste des rendez-vous liés à l'utilisateur connecté
    #[Route('/compte/rendez-vous', name: 'app_rendez-vous')]
    public function rdv(Security $security, RendezVousUtilisateurRepository $rendezVousUtilisateurRepository): Response
    {
        $utilisateur = $security->getUser();
        $rdvs = $rendezVousUtilisateurRepository->findBy(['utilisateur' => $utilisateur]);

        return $this->render('compte/rendezVous/rendezVous.html.twig',[
            'rdvs' => $rdvs,
        ]);
    }

    # ********************************************************************************************
    #[Route('/compte/rendez-vous/ajouter', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rdv = new RendezVousUtilisateur();
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($rdv);
            $entityManager->flush();
            // rediriger vers la liste de rendez-vous après l'ajout
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('compte/rendezVous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
        ]);
    }

    #[Route('/compte/rendez-vous/modifier/{id}', name: 'app_rendez-vous_modifier')]
    public function modifierRendezVous(Request $request, EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('compte/rendezVous/modifierRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
        ]);
    }

    #[Route('/compte/rendez-vous/supprimer/{id}', name: 'app_rendez-vous_supprimer')]
    public function supprimerRendezVous(EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $entityManager->remove($rdv);
        $entityManager->flush();
        return $this->redirectToRoute('app_rendez-vous');
    }
    # ********************************************************************************************

    #[Route('/compte/modification-mot-de-passe', name: 'app_compte_modif-mdp')]
public function motDePasse(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
{
    # Récupération de l'utilisateur connecté
    $utilisateur = $this->getUser();
    # transmission de l'utilisateur connecté au formulaire
    $form = $this->createForm(ModificationMotdePasseUtilisateurType::class, $utilisateur, [
        # Ne pas oublier l'injection de dépendances pour le UserPasswordHasherInterface
        # On transmet le UserPasswordHasherInterface au formulaire
        'password_hashers' => $passwordHasher
    ]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        # persister les données dans la table utilisateur
        $entityManager->flush();
        # notification Flash Messages
        $this->addFlash(
            'success',
            'Votre mot de passe a bien été modifié');
    }

    return $this->render('compte/motDePasse.html.twig',[
        'formulaireMotDePasse' => $form->createView()
    ]);
}
}
