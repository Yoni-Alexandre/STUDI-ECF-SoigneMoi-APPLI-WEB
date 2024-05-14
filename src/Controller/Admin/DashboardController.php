<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\PlanningMedecin;
use App\Entity\Prescription;
use App\Entity\RendezVousUtilisateur;
use App\Entity\SpecialiteMedecin;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UtilisateurCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SOIGNEMOI' );
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::section('Médecins');
        yield MenuItem::linkToCrud('Médecins', 'fas fa-stethoscope', Medecin::class);
        yield MenuItem::linkToCrud('Spécialités', 'fas fa-heartbeat', SpecialiteMedecin::class);
        yield MenuItem::linkToCrud('Plannings', 'fas fa-calendar', PlanningMedecin::class);
        yield MenuItem::section('Rendez-Vous');
        yield MenuItem::linkToCrud('Rendez-Vous', 'fas fa-calendar', RendezVousUtilisateur::class);
        yield MenuItem::section('Gestion des avis et prescriptions');
        yield MenuItem::linkToCrud('Avis', 'fas fa-comment-medical', Avis::class);
        yield MenuItem::linkToCrud('Prescription', 'fas fa-file-medical', Prescription::class);
        yield MenuItem::section('Médicaments');
        yield MenuItem::linkToCrud('Médicament', 'fas fa-pills', Medicament::class);
    }
}
