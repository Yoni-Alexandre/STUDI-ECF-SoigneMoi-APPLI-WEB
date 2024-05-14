<?php

namespace App\Controller\RendezVous;

use App\Entity\RendezVousUtilisateur;
use App\Form\RendezVousUtilisateurType;
use App\Repository\MedecinRepository;
use App\Repository\PlanningMedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousAjoutController extends AbstractController
{
    #[Route('rendez_vous/ajouter/{medecinId}', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager, Security $security, $medecinId, MedecinRepository $medecinRepository, PlanningMedecinRepository $planningMedecinRepository): Response
    {
        // Crée un nouvel objet RendezVousUtilisateur
        $rdv = new RendezVousUtilisateur();
        // Récupère l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        // Associe le rendez-vous à cet utilisateur
        $rdv->setUtilisateur($utilisateur);

        // Trouve un médecin spécifique dans la base de données en utilisant son ID
        $medecin = $medecinRepository->find($medecinId);
        // Associe le rendez-vous avec le médecin trouvé
        $rdv->setMedecin($medecin);

        /// Utilise le PlanningMedecinRepository pour vérifier les créneaux disponibles pour le médecin spécifié
        $disponibiliteMedecins = $planningMedecinRepository->disponibiliteMedecins($medecin);
        // Si aucun créneau n'est disponible, il envoie un message flash à l'utilisateur et le redirige vers une autre page
        if (empty($disponibiliteMedecins)) {
            $this->addFlash('danger', 'Il n\'y a plus de disponibilité pour ce médecin.');
            // Rediriger vers la page précédente ou une autre page appropriée.
            return $this->redirectToRoute('app_rendez-vous');
        }
        // Par défaut, le statut du rendez-vous est "à venir"
        $rdv->setStatus('à venir');

        // Crée un formulaire pour le rendez-vous utilisant "RendezVousUtilisateurType" comme classe de formulaire.
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et si toutes les données du formulaire sont valides
        if ($form->isSubmitted() && $form->isValid()){
            // Récupère les données du formulaire
            $rdv = $form->getData();
            // Récupère la date du rendez-vous
            $date = $rdv->getDate();
            // Si une date a été sélectionnée, le code vérifie s'il y a des créneaux disponibles pour cette date
            if ($date !== null) {
                // On récupère le planning associé à la date et au médecin
                $planningMedecin = $planningMedecinRepository->findOneBy([
                    'date' => $date,
                    'medecin' => $rdv->getMedecin()
                ]);
                // Si aucun planning n'est associé à cette date et médecin, on refuse la réservation
                if (!$planningMedecin) {
                    $this->addFlash('danger', 'Il n\'y a plus de places disponibles pour ce créneau.');
                    return $this->redirectToRoute('app_rendez-vous');
                }
                // Récupère toutes les places disponibles et le nombre de places que l'utilisateur souhaite réserver
                $totalPlacesDisponibles = $planningMedecin->getNombrePatientsMax();
                $placesReservees = $rdv->getNombrePlacesReservees();
                // Vérifie si suffisamment de places sont disponibles. Si ce n'est pas le cas, affiche un message d'erreur et redirige vers app_rendez-vous
                if ($totalPlacesDisponibles < $placesReservees) {
                    $this->addFlash('danger', 'Il n\'y a pas assez de places disponibles pour ce créneau.');
                    return $this->redirectToRoute('app_rendez-vous');
                }

                // Met à jour le nombre de places restantes
                $planningMedecin->setNombrePatientsMax($totalPlacesDisponibles - $placesReservees);
                // Persiste le planningMedecin dans la base de données
                $entityManager->persist($planningMedecin);

                $entityManager->persist($rdv);
                $entityManager->flush();
                // redirection vers la page des rendez-vous de l'utilisateur
                return $this->redirectToRoute('app_rendez-vous');
                // S'il n'y a pas de place disponible pour cette date, un message flash est généré.
            } else {
                $this->addFlash('danger', 'Il n\'y a plus de place disponible à cette date pour ce médecin.');
            }
        }

        return $this->render('rendez_vous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
            'medecinId' => $medecinId,
        ]);
    }
}
