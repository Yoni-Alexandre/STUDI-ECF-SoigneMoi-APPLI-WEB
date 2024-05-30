<?php

namespace App\Controller\RendezVous;

use App\Entity\RendezVousUtilisateur;
use App\Repository\MedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousFicheController extends AbstractController
{
    #[Route('/rendez_vous/fiche/{id}', name: 'app_rendez_vous_fiche')]
    public function index($id, EntityManagerInterface $entityManager, MedecinRepository $medecinRepository, ): Response
    {
        // Je récupère le rendez-vous en utilisant son ID
        $rdv = $entityManager->getRepository(RendezVousUtilisateur::class)->find($id);
        // Si le rendez-vous n'existe pas, j'envoie un message flash puis redirection vers la liste des rendez-vous
        if (!$rdv) {
            $this->addFlash('danger', 'Rendez-vous non trouvé.');
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/FicheRendezVous.html.twig', [
            'rdv' => $rdv,
        ]);
    }
}
