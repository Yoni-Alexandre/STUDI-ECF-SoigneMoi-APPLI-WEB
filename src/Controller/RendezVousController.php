<?php

namespace App\Controller;

use App\Entity\RendezVousUtilisateur;
use App\Form\RendezVousUtilisateurType;
use App\Repository\MedecinRepository;
use App\Repository\PlanningMedecinRepository;
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
    public function rdv(Security $security, RendezVousUtilisateurRepository $rendezVousUtilisateurRepository, EntityManagerInterface $entityManager): Response
    {
        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdvs = $rendezVousUtilisateurRepository->findBy(['utilisateur' => $utilisateur]);

        // Création d'un objet DateTime qui contient la date et l'heure actuelle
        $actuelle = new \DateTime();

        // Boucle qui parcourt chaque rendez-vous dans le tableau $rdvs.
        foreach ($rdvs as $rdv) {
            // Obtention de la date du rendez-vous actuel et la stocke dans la variable $dateRDV
            $dateRDV = $rdv->getDate();

            // Vérification si la date du rendez-vous est passée et si le statut du rendez-vous n'est pas déjà "effectué".
            if ($dateRDV < $actuelle && $rdv->getStatus() != 'effectué') {
                // Change le statut du rendez-vous à "effectué"
                $rdv->setStatus('effectué');

              // Vérifie si la date du rendez-vous est la même que la date actuelle et si le statut du rendez-vous n'est pas déjà "en cours"
            } elseif ($dateRDV == $actuelle && $rdv->getStatus() != 'en cours') {
                // Change le statut du rendez-vous à "en cours"
                $rdv->setStatus('en cours');
            } // sinon le statut reste 'à venir' par défaut

            // Prépare le rendez-vous pour être enregistré (ou mise à jour) dans la base de données.
            $entityManager->persist($rdv);
        }
        // Flush dans la base de données les opérations préparées avec $entityManager->persist($rdv);
        $entityManager->flush();

        return $this->render('rendez_vous/rendezVous.html.twig',[
            'rdvs' => $rdvs,
        ]);
    }
    #[Route('rendez_vous/ajouter/{medecinId}', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager, Security $security, $medecinId, MedecinRepository $medecinRepository, PlanningMedecinRepository $planningMedecinRepository): Response
    {
        $rdv = new RendezVousUtilisateur();

        // Récupération et attribution du médecin à partir de l'ID dans l'URL
        $medecin = $medecinRepository->find($medecinId);
        $rdv->setMedecin($medecin);
        $specialite = $medecin->getSpecialite();

        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdv->setUtilisateur($utilisateur);

        $rdv->setStatus('à venir');

        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv, ['planningMedecinRepository' => $planningMedecinRepository]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // Vérifier la disponibilité
            $isAvailable = $planningMedecinRepository->disponibiliteMedecin($rdv->getDate(), $rdv->getMedecin());
            if($isAvailable) {
                $entityManager->persist($rdv);
                $entityManager->flush();
                // redirection vers la page des rendez-vous de l'utilisateur
                return $this->redirectToRoute('app_rendez-vous');
            } else {
                // Si le formulaire est soumis et que le menu déroulant est vide, le message "Il n\'y a plus de place disponible à cette date pour ce médecin." sera afficher
                $this->addFlash('danger', 'Il n\'y a plus de place disponible à cette date pour ce médecin.');
            }
        }

        return $this->render('rendez_vous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
            'medecinId' => $medecinId,
            'specialite' => $specialite,
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
