<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Avis')
            ->setEntityLabelInPlural('Avis')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle', 'Titre de l\'avis'),
            DateField::new('date', 'Date de l\'avis'),
            TextEditorField::new('description', 'Description de l\'avis'),
            AssociationField::new('medecin')->setLabel('Médecin'),
            AssociationField::new('utilisateur')->setLabel('Patient'),
            AssociationField::new('prescription')->setLabel('Prescriptions'),
        ];
    }

}
