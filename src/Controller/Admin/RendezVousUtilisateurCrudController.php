<?php

namespace App\Controller\Admin;

use App\Entity\RendezVousUtilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RendezVousUtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RendezVousUtilisateur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('date')->setLabel('Date et heure du rendez-vous'),
            TextareaField::new('motifDeSejour')->setLabel('Motif du rendez-vous'),
            AssociationField::new('utilisateur')->setLabel('Patient'),
            AssociationField::new('medecin')->setLabel('Médecin'),
        ];
    }
}