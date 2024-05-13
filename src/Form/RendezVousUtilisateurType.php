<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\PlanningMedecin;
use App\Entity\RendezVousUtilisateur;
use App\Entity\SpecialiteMedecin;
use App\Repository\PlanningMedecinRepository;
use App\Entity\Utilisateur;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousUtilisateurType extends AbstractType
{
    private $planningMedecinRepo;

    public function __construct(PlanningMedecinRepository $planningMedecinRepo)
    {
        $this->planningMedecinRepo = $planningMedecinRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $placeDisponible = $this->planningMedecinRepo->disponibiliteMedecins($builder->getData()->getMedecin());

        $choix = [];
        foreach($placeDisponible as $place)
        {
            if ($place instanceof \DateTime) {
                $choix[$place->format('d-m-Y H:i')] = $place;
            }
        }

        $builder

            ->add('date', ChoiceType::class, [
                'choices' => $choix,
                'choice_label' => function($date){
                    //return $date->format('d-m-Y H:i');
                    return $date->format('d-m-Y');
                },
                'label' => 'Choisissez un créneau',
            ])
            ->add('planningMedecin', EntityType::class, [
                'class' => PlanningMedecin::class,
                'choice_label' => 'nombre_patients_max',
                'label' => 'Places restantes',
                'attr' => [
                    'class' => 'form-control'
                ],
                'mapped' => true,
                'disabled' => true,
                'data' => $builder->getData()->getPlanningMedecin()
            ])
            ->add('nombrePlacesReservees', IntegerType::class, [
                'label' => 'Nombre de places à réserver',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1
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

            ->add('specialite', EntityType::class, [
                'class' => SpecialiteMedecin::class,
                'choice_label' => 'specialite',
                'label' => 'Spécialité',
                'attr' => [
                    'class' => 'form-control'
                ],
                'mapped' => false,
                'disabled' => true,
                'data' => $builder->getData()->getMedecin()->getSpecialite()
            ])

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