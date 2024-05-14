<?php

namespace App\Controller\Admin;

use App\Entity\Medicament;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MedicamentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Medicament::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Médicament')
            ->setEntityLabelInPlural('Médicaments')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom du médicament'),
            TextEditorField::new('posologie', 'Posologie'),
        ];
    }
}
