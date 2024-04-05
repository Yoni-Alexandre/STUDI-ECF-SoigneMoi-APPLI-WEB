<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ModificationMotdePasseUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ancien_mot_de_passe', PasswordType::class, [
                'label' => 'Ancien mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez votre ancien mot de passe'
                ],
                'mapped' => false,
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
                        'placeholder' => 'Entrez votre nouveau mot de passe'
                    ],
                    'label' => 'Nouveau mot de passe',
                    // permet de transiter le mot de passe saisi dans le formulaire jusqu'au contrôleur de manière crypté
                    // Se réfère au security.yaml -> password_hashers
                    // 'password' se réfère au nom de la propriété dans l'entité 'Utilisateur' qui se nomme 'password"
                    'hash_property_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmez votre nouveau mot de passe'
                    ]
                ],
                // pour dire à Symfony de ne pas aller chercher un champ (ici que je nomme 'motDePasse') dans l'entité Utilisateur pour le mot de passe répété (qui n'existe pas)
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier mon mot de passe',
                'attr' => [
                    'class' => 'btn btn-primary mt-2 mb-5'
                ]
            ])
            # Au moment ou le formulaire est soumis, je veux écouter l'événement et comparer les deux mots de passe
            # Récupération du mot de passe saisi par l'utilisateur connecté
            # Récupération du mot de passe actuel en BDD
            # Si les mots de passe ne correspondent pas, envoyer une erreur
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {

                # Récupération du formulaire
                $form = $event->getForm();

                # Récupération de l'utilisateur connecté
                $utilisateur =$form->getConfig()->getOptions()['data'];

                # Récupération du 'UserPasswordHasherInterface' du contrôleur 'CompteController'
                $passwordHasher = $form->getConfig()->getOptions()['password_hashers'];

                # Récupérer le mot de passe saisi par l'utilisateur (nommé 'ancien_mot_de_passe') et vérification que le mot de passe en clair correspond au mot de passe en BDD
                $isValid = $passwordHasher->isPasswordValid(
                    $utilisateur,
                    $form->get('ancien_mot_de_passe')->getData());

                # Gestion des erreurs
                if (!$isValid){
                    $form->get('ancien_mot_de_passe')->addError(new FormError('Le mot de passe saisi est incorrect'));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
            # Par défault le 'password_hashers' est à null
            'password_hashers' => null
        ]);
    }
}
