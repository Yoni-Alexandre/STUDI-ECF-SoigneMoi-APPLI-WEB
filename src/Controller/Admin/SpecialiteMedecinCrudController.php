<?php

namespace App\Controller\Admin;

use App\Entity\SpecialiteMedecin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpecialiteMedecinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpecialiteMedecin::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Spécialité')
            ->setEntityLabelInPlural('Spécialités')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('specialite', 'Spécialité')->setHelp('Veuillez saisir le nom de la spécialité'),
            SlugField::new('slug')->setLabel('Slug')->setTargetFieldName('specialite')->setHelp('URL de la spécialité')
        ];
    }

}
