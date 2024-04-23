<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email'
                ]
            ])
            ->add('motDePasse', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                  new Length([
                      'min' => 8,
                      'minMessage' => 'Votre mot de passe doit contenir au moins 8 caractères'
                  ])
                ],
                'first_options'  => [
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe'
                    ],
                    'label' => 'Mot de passe',
                    // permet de transiter le mot de passe saisi dans le formulaire jusqu'au contrôleur de manière crypté
                    // Se réfère au security.yaml -> password_hashers
                    // 'password' se réfère au nom du propriété dans l'entité 'Utilisateur' qui se nomme 'password"
                    'hash_property_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmez votre mot de passe'
                    ]
                ],
                // pour dire à Symfony de ne pas aller chercher un champ (ici que je nomme 'motDePasse') dans l'entité Utilisateur pour le mot de passe répété (qui n'existe pas)
                'mapped' => false,
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 25,
                        'minMessage' => 'Votre nom doit contenir au moins 2 caractères',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 25,
                        'minMessage' => 'Votre prénom doit contenir au moins 2 caractères',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('adresse_postale', TextareaType::class, [
                'label' => 'Adresse postale',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse postale'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Inscription',
                'attr' => [
                    'class' => 'btn btn-primary mt-2 mb-5'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => Utilisateur::class,
                    'fields' => 'email',
                ])
            ],
            'data_class' => Utilisateur::class,
        ]);
    }
}
