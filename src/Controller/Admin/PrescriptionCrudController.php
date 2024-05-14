<?php

namespace App\Controller\Admin;

use App\Entity\Prescription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PrescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prescription::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Prescription')
            ->setEntityLabelInPlural('Prescriptions')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom de la prescription'),
            DateField::new('dateDebutTraitement', 'Date du début de traitement'),
            DateField::new('dateFinTraitement', 'Date de fin de traitement'),
            AssociationField::new('medicament')->setLabel('Médicament'),
        ];
    }

}
