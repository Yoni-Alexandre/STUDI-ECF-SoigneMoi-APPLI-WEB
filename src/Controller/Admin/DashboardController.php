<?php

namespace App\Controller\Admin;

use App\Entity\Medecin;
use App\Entity\PlanningMedecin;
use App\Entity\RendezVousUtilisateur;
use App\Entity\Sejour;
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
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Médecins', 'fas fa-stethoscope', Medecin::class);
        yield MenuItem::linkToCrud('Spécialités', 'fas fa-heartbeat', SpecialiteMedecin::class);
        yield MenuItem::linkToCrud('Plannings', 'fas fa-calendar', PlanningMedecin::class);
        yield MenuItem::linkToCrud('Rendez-Vous', 'fas fa-calendar', RendezVousUtilisateur::class);
    }
}
