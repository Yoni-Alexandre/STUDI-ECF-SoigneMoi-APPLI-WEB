<?php

namespace App\Controller\Admin;

use App\Entity\Sejour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SejourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sejour::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('Motif', 'Motif'),
            AssociationField::new('utilisateur', 'Utilisateur'),
            AssociationField::new('medecin', 'Médecin'),
        ];
    }
}
