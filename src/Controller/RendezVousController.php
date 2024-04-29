<?php

namespace App\Controller;

use App\Entity\RendezVousUtilisateur;
use App\Form\RendezVousUtilisateurType;
use App\Repository\MedecinRepository;
use App\Repository\RendezVousUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousController extends AbstractController
{
    #[Route('/compte/rendez-vous', name: 'app_rendez-vous')]
    public function rdv(Security $security, RendezVousUtilisateurRepository $rendezVousUtilisateurRepository): Response
    {
        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdvs = $rendezVousUtilisateurRepository->findBy(['utilisateur' => $utilisateur]);

        return $this->render('rendez_vous/rendezVous.html.twig',[
            'rdvs' => $rdvs,
        ]);
    }
    #[Route('rendez_vous/ajouter/{medecinId}', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager, Security $security, $medecinId, MedecinRepository $medecinRepository): Response
    {
        $rdv = new RendezVousUtilisateur();

        // Récupération et attribution du médecin à partir de l'ID dans l'URL
        $medecin = $medecinRepository->find($medecinId);
        $rdv->setMedecin($medecin);

        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdv->setUtilisateur($utilisateur);

        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($rdv);
            $entityManager->flush();
            // redirection vers la page des rendez-vous de l'utilisateur
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
            'medecinId' => $medecinId,
        ]);
    }


    #[Route('rendez_vous/modifier/{id}', name: 'app_rendez-vous_modifier')]
    public function modifierRendezVous(Request $request, EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/modifierRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
        ]);
    }

    #[Route('rendez_vous/supprimer/{id}', name: 'app_rendez-vous_supprimer')]
    public function supprimerRendezVous(EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $entityManager->remove($rdv);
        $entityManager->flush();
        return $this->redirectToRoute('app_rendez-vous');
    }
}
