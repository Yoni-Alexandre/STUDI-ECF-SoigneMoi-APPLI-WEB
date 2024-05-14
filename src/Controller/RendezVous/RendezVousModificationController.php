<?php

namespace App\Controller\RendezVous;

use App\Entity\RendezVousUtilisateur;
use App\Form\RendezVousUtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousModificationController extends AbstractController
{
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
}