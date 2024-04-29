<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\RendezVousUtilisateur;
use App\Entity\Utilisateur;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // L'utilisateur ne peut pas prendre rendez-vous à une date antérieure à j + 1
            ->add('date', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'attr' => [
                    'min' => (new \DateTime('tomorrow'))->format('Y-m-d H:i')
                ]
            ])
            ->add('medecin', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' => 'nom',
                'label' => 'Nom du médecin',
                'attr' => [
                    'class' => 'form-control'
                ],
                'disabled' => true,
            ])
            /*
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'nom',
                'label' => 'Nom de l\'utilisateur',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            */
            ->add('motifDeSejour', TextareaType::class, [
                'label' => 'Indiquez le motif de sejour',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Validez le rendez-vous',
                'attr' => [
                    'class' => 'btn btn-primary mt-2 mb-5'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVousUtilisateur::class,
        ]);
    }
}
