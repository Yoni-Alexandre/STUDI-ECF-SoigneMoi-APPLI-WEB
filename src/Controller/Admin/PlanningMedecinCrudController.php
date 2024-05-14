<?php

namespace App\Controller\Admin;

use App\Entity\PlanningMedecin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlanningMedecinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlanningMedecin::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Planning')
            ->setEntityLabelInPlural('Plannings')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setLabel('ID')->hideOnForm(),
            DateTimeField::new('date')
                ->setLabel('Date'),
            IntegerField::new('nombre_patients_max')
                ->setLabel('Nombre de patients maximum')
                ->setFormTypeOptions([
                    'disabled' => true
                ]),
            AssociationField::new('medecin')->setLabel('Médecin'),
        ];
    }

}
