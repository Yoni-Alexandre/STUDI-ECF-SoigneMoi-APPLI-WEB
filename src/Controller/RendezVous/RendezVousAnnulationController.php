<?php

namespace App\Controller\RendezVous;

use App\Entity\RendezVousUtilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousAnnulationController extends AbstractController
{
    #[Route('rendez_vous/supprimer/{id}', name: 'app_rendez-vous_supprimer')]
    public function supprimerRendezVous(EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $entityManager->remove($rdv);
        $entityManager->flush();
        return $this->redirectToRoute('app_rendez-vous');
    }
}