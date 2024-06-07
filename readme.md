# Présentation du Projet SoigneMoi

SoigneMoi, est un hôpital de la région lilloise (dans le nord de la France), cet hôpital n’a pas beaucoup de clients par manque d’efficacité. Ils sont assez lents dans l’accueil des patients, mais également dans la prise en charge. Les praticiens, qui doivent effectuer des opérations, n’ont pas d’agenda informatisé, de ce fait, toute la gestion des plannings est faite à la main.  
L’hôpital ne pouvant plus continuer en ce sens, ils ont décidé d’investir afin de proposer des outils permettant de corriger toutes les faiblesses actuelles. Pour répondre à ce besoin, ils ont mandaté une entreprise, Develop-Solution, dont vous faites partie pour développer les applications nécessaires.

Après consultation avec les équipes de SoigneMoi, il a été défini les besoins suivants :

#### Application Web :
- Possibilité de création de comptes utilisateur
- Un utilisateur peut sélectionner une date de séjour ainsi qu’un motif afin que l’hôpital puisse préparer au mieux son accueil
- L’utilisateur possède sur son espace, un historique des séjours que l’utilisateur a effectué.

#### Application mobile :
- Application à destination des médecins
- Il est possible qu’un patient ait besoin de prescription
- Un médecin peut saisir sur son application mobile des prescriptions pour un patient, il donne également un avis sur le statut du patient

#### Application bureautique :
- Application à destination des secrétaires de l’hôpital
- Une / Un secrétaire a accès à toutes les admissions à l’hôpital du jour.
- Gestion des entrées et sortie de l’hôpital

## Technologies utilisées

Ce site web a été développé en utilisant les technologies suivantes :

- Symfony 7 / PHP 8.3 / EasyAdmin 4 : pour la gestion du contenu du site
- HTML / CSS / JavaScript : pour la mise en page et les interactions/animations de l'utilisateur
- Bootstrap 5 : pour la création d'un design réactif et mobile-friendly

## Projet crée par

- Yoni-Alexandre Brault : Concepteur Développeur / Designer


## Création du Projet SoigneMoi avec Symfony 7 (PHP 8.3)

Création du Projet :
```php  
  symfony new SoigneMoi --version="7.0.*" --webapp 
```  
Installation des Dépendances avec **Composer** :
```php  
  cd SoigneMoi 
```  
```php  
  composer install 
```  
## Modification du ficher .env pour connecter la base de données
```php  
DATABASE_URL="mysql://root@127.0.0.1:3306/soignemoi?serverVersion=8.0.32&charset=utf8mb4"  
```  
## Création de la base de données
```php  
symfony console doctrine:database:create
```  
## Création des Entités

#### Entité Utilisateur (sécurisé)

```php  
symfony console make:user  
The name of the security user class (e.g. User) [User]:  > Utilisateur  
  
Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]  
 > yes  
Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:  
 > email  
Does this app need to hash/check user passwords? (yes/no) [yes]:  
 > yes
 ```  
- Champs de l'entité :
    - Les champs **email** et **password** sont créés lors de la création du **make:user**
- nom : `nom`, type : `string`, longueur : `255`
- prenom : `prenom`, type : `string`, longueur : `255`
- adresse_postale : `adresse_postale`, type : `text`

#### Commande de création des entités
```php 
symfony console make:entity
```

#### Entité Sejour
- Nom de l'entité : Sejour

Champs de l'entité :
- Champ : ```date_debut```, type : ```datetime```, null en BDD : ```non```
- Champ : ```date_fin```, type : ```datetime```, null en BDD : ```non```
- Champ : ```motif```, type : ```string```, longueur : ```255```, null en BDD : ```non```

#### Entité Medecin
- Nom de l'entité : Medecin

Champs de l'entité :
- Champ : ```nom```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```prenom```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```specialite```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```matricule```, type : ```string```, longueur : ```255```, null en BDD : ```non```

#### Entité SpecialiteMedecin
- Nom de l'entité : SpecialiteMedecin

Champs de l'entité :
- Champ : ```specialite```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```slug```, type : ```string```, longueur : ```255```, null en BDD : ```non```

#### Entité Prescription
- Nom de l'entité : Prescription

Champs de l'entité :
- Champ : ```libelle```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```date```, type : ```datetime```, null en BDD : ```non```
- Champ : ```description```, type : ```text```, null en BDD : ```non```
- Champ : ```nom_prenom_medecin```, type : ```string```, longueur : ```255```, null en BDD : ```non```


#### Entité Medicament
- Nom de l'entité : Medicament

Champs de l'entité :
- Champ : ```nom```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```posologie```, type : ```string```, longueur : ```255```, null en BDD : ```non```
- Champ : ```date_debut_traitement```, type : ```datetime```, null en BDD : ```non```
- Champ : ```date_fin_traitement```, type : ```datetime```, null en BDD : ```non```

#### PlanningMedecin
- Nom de l'entité : PlanningMedecin

Champs de l'entité :
- Champ : ```date```, type : ```datetime```, null en BDD : ```non```
- Champ : ```nombre_patients_max```, type : ```integer```, longueur : ```255```, null en BDD : ```non```

## Définition des Relations

#### Création des relations entre les Entités
```php symfony console make:entity```
#### Exemple  pour Sejour et Utilisateur:
```php 
Class name of the entity to create or update (e.g. BraveKangaroo):  
 > Sejour  
 Your entity already exists! So let's add some new fields!  
 New property name (press <return> to stop adding fields): > utilisateur  
 Field type (enter ? to see all types) [string]: > relation  
 What class should this entity be related to?: > Utilisateur  
What type of relationship is this?  
 ------------ -------------------------------------------------------------------------- Type         Description ------------ -------------------------------------------------------------------------- ManyToOne    Each Sejour relates to (has) one Utilisateur. Each Utilisateur can relate to (can have) many Sejour objects.  
 OneToMany    Each Sejour can relate to (can have) many Utilisateur objects. Each Utilisateur relates to (has) one Sejour.  
 ManyToMany   Each Sejour can relate to (can have) many Utilisateur objects. Each Utilisateur can also relate to (can also have) many Sejour objects.  
 OneToOne     Each Sejour relates to (has) exactly one Utilisateur. Each Utilisateur also relates to (has) exactly one Sejour. ------------ --------------------------------------------------------------------------  
 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]: > ManyToOne  
 Is the Sejour.utilisateur property allowed to be null (nullable)? (yes/no) [yes]: >yes  
 Do you want to add a new property to Utilisateur so that you can access/update Sejour objects from it - e.g. $utilisateur->getSejours()? (yes/no) [yes]: >yes  
 A new property will also be added to the Utilisateur class so that you can access the related Sejour objects from it.  
 New field name inside Utilisateur [sejours]: >sejours  
 updated: src/Entity/Sejour.php updated: src/Entity/Utilisateur.php
```  
#  
- Relation entre `Sejour` et `Utilisateur` : **ManyToOne**
- Chaque `Sejour` est lié à (possède) un `Utilisateur`.
- Chaque `Utilisateur` peut être lié à (peut avoir) plusieurs objets `Sejour`.
    - Nom de l'entité : Sejour
        - Champs de l'entité : `utilisateur`, type : `relation (ManyToOne)`, classe cible : `Utilisateur`
#  
- Relation entre `Sejour` et `Medecin` : **ManyToOne**
- Chaque `Sejour` est lié à (possède) un `Medecin`.
- Chaque `Medecin` peut être lié à (peut avoir) plusieurs objets `Sejour`.
    - Nom de l'entité : Sejour
        - Champs de l'entité : `medecin`, type : `relation (ManyToOne)`, classe cible : `Medecin`

- Relation entre `Medecin` et `Specialite` : **ManyToOne**
- Chaque `Medecin` est lié à (possède) une `Specialite`.
- Chaque `Specialite` peut être lié à (peut avoir) plusieurs objets `Medecin`.
    - Nom de l'entité : Medecin
        - Champs de l'entité : `specialite`, type : `relation (ManyToOne)`, classe cible : `SpecialiteMedecin`
#  
- Relation entre `Medecin` et `Utilisateur` : **ManyToOne**
- Chaque `Medecin` est lié à (possède) un `Utilisateur`.
- Chaque `Utilisateur` peut être lié à (peut avoir) plusieurs objets `Medecin`.
    - Nom de l'entité : Medecin
        - Champs de l'entité : `utilisateur`, type : `relation (ManyToOne)`, classe cible : `Utilisateur`
#  
- Relation entre `Prescription` et `Medecin` : **ManyToOne**
- Chaque `Prescription` est lié à (possède) un `Medecin`.
- Chaque `Medecin` peut être lié à (peut avoir) plusieurs objets `Prescription`.
    - Nom de l'entité : Prescription
        - Champs de l'entité : `medecin`, type : `relation (ManyToOne)`, classe cible : `Medecin`
#  
- Relation entre `Medicament` et `Prescription` : **ManyToOne**
- Chaque `Medicament` est lié à (possède) un `Prescription`.
- Chaque `Prescription` peut être lié à (peut avoir) plusieurs objets `Medicament`.
    - Nom de l'entité : Medicament
        - Champs de l'entité : `prescription`, type : `relation (ManyToOne)`, classe cible : `Prescription`
#  
- Relation entre `PlanningMedecin` et `Medecin` : **ManyToOne**
- Chaque `PlanningMedecin` est lié à (possède) un `Medecin`.
- Chaque `Medecin` peut être lié à (peut avoir) plusieurs objets `PlanningMedecin`.
    - Nom de l'entité : PlanningMedecin
        - Champs de l'entité : `medecin`, type : `relation (ManyToOne)`, classe cible : `Medecin`
#  
#### Création de la migration
```php  
symfony console make:migration
```  
#### Exécution de la migration
```php  
symfony console doctrine:migrations:migrate
```  
## Création du contrôleur d'inscription des utilisateurs (patients)
```php  
symfony console make:controller  
Choose a name for your controller class (e.g. OrangeChefController):  
 > InscriptionController  
 created: src/Controller/InscriptionController.php  created: templates/inscription/index.html.twig  
  Success! 
```
## Création du formulaire des utilisateurs (patients)
#### Formulaire de création de comptes pour les utilisateurs
```php  
symfony console make:form  
The name of the form class (e.g. GentlePuppyType):  
 > InscriptionUtilisateurType  
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):  
 > UtilisateurUtilisateur  
  
 created: src/Form/InscriptionUtilisateurType.php  Success! 
 ```  
#### Lier le contrôleur `InscriptionController`au  formulaire `InscriptionUtilisateurType`
```php  
$utilisateur = new Utilisateur(); $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);    
 return $this->render('inscription/index.html.twig', [    
    'titre_inscription' => 'Inscription',    
    'formulaireUtilisateurs' => $form->createView(),  
```  
Pour utiliser **Bootstrap** pour l'affichage graphique des formulaires, modifier le fichier ```config/packages/twig.yaml```  
et ajouter :
```php  
twig:     
  form_themes: ['bootstrap_5_layout.html.twig']
```  
#### Création du formulaire (Exemple du formulaire d'inscription)
```php  
public function buildForm(FormBuilderInterface $builder, array $options): void {    
    $builder    
  ->add('email', EmailType::class, [    
            'label' => 'Adresse email',    
            'attr' => [    
                'placeholder' => 'Entrez votre adresse email'    
  ]    
        ])    
        ->add('password', PasswordType::class,[    
            'label' => 'Mot de passe',    
            'attr' => [    
                'placeholder' => 'Entrez votre mot de passe'    
  ]    
         ])    
        ->add('nom', TextType::class, [    
            'label' => 'Nom',    
            'attr' => [    
                'placeholder' => 'Entrez votre nom'    
  ]    
        ])    
        ->add('prenom', TextType::class, [    
            'label' => 'Prénom',    
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
            'label' => 'S\'inscrire',    
        ])    
; }  
```  
Dans le fichier de la vue associée au formulaire
```php  
{{ form_start(formulaireUtilisateurs) }} {{ form_row(formulaireUtilisateurs.nom) }} {{ form_row(formulaireUtilisateurs.prenom) }} {{ form_row(formulaireUtilisateurs.adresse_postale) }} {{ form_row(formulaireUtilisateurs.email) }} {{ form_row(formulaireUtilisateurs.password) }} {{ form_row(formulaireUtilisateurs.submit) }} {{ form_end(formulaireUtilisateurs) }}  
```  
## Enregistrement du formulaire des utilisateurs (patients) en base de données
Depuis le contrôleur InscriptionController.php,  ne pas oublier les injections de dépendances dans la fonction  
`Request $request, EntityManagerInterface $entityManager`

- Soumission, Enregistrement et Envoi des données du formulaire en base de données
```php  
if ($form->isSubmitted() && $form->isValid()){    
    // persister les données dans la table utilisateur    
  $entityManager->persist($utilisateur);    
    // exécuter la requête    
$entityManager->flush(); }  
```  
Exemple complet:
```php  
public function index(Request $request, EntityManagerInterface $entityManager): Response {    
    // Création d'un nouvel utilisateur    
  $utilisateur = new Utilisateur();    
    // Création du formulaire et liaison avec l'objet utilisateur    
  $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);    
        
    // Récupération des données du formulaire grâce à la requête HTTP    
  $form->handleRequest($request);    
    
    if ($form->isSubmitted() && $form->isValid()){    
        // persister les données dans la table utilisateur    
  $entityManager->persist($utilisateur);    
        // exécuter la requête vers la base de donneés    
  $entityManager->flush();    
    
        return $this->redirectToRoute('app_connexion');    
    }    
    
    return $this->render('inscription/index.html.twig', [    
        'titre_inscription' => 'Inscription',    
        'formulaireUtilisateurs' => $form->createView(),    
]); }  
```  
## Encodage des mots de passe du formulaire des utilisateurs (patients) en base de données
#### RepeatedType *(https://symfony.com/doc/current/reference/forms/types/password.html#hash-property-path)* et hash du mot de passe
Depuis le formulaire `InscriptionUtilisateurType.php` :
```php  
->add('motDePasse', RepeatedType::class, [    
    'type' => PasswordType::class,    
    'first_options' => [    
        'attr' => [    
            'placeholder' => 'Entrez votre mot de passe'    
  ],    
        'label' => 'Mot de passe',    
 // permet de transiter le mot de passe saisi dans le formulaire jusqu'au contrôleur de manière crypté // Se réfère au security.yaml -> password_hashers  'hash_property_path' => 'password'    
  ],    
    'second_options' => [    
        'label' => 'Confirmez votre mot de passe',    
        'attr' => [    
            'placeholder' => 'Confirmez votre mot de passe'    
  ]    
    ],    
// pour dire à Symfony de ne pas aller chercher un champ (ici que je nomme 'motDePasse') dans l'entité Utilisateur pour le mot de passe répété (qui n'existe pas)'mapped' => false, ])  
```  
Si les mots de passe ne correspondent pas,  on entrera pas dans la condition `$form->isValid()` du `InscriptionController.php`

Modification de la langue du message d'erreur quand les mots de passe ne correspondent pas dans `config/packages/translation.yaml`
```php  
framework:    
    default_locale: fr translator:    
        default_path: '%kernel.project_dir%/translations' fallbacks:    
            - fr providers: 
```  
## Utilisation des contraintes (email unique, mot de passe complexe, etc...) avec le composant `validator` de Symfony 7
*https://symfony.com/doc/current/validation.html#constraints*

Dans le formulaire `InscriptionUtilisateurType.php` ajout de contraintes `use Symfony\Component\Validator\Constraints\Length;`

Pour le mot de passe :
```php 
->add('motDePasse', RepeatedType::class, [  
    'type' => PasswordType::class,  
    'constraints' => [  
      new Length([  
          'min' => 8,  
          'minMessage' => 'Votre mot de passe doit contenir au moins 8 caractères'  
  ])  
    ],  
    'first_options' => [  
        'attr' => [  
            'placeholder' => 'Entrez votre mot de passe'  
  ],
   ...
```
Pour le nom :
```php 
->add('nom', TextType::class, [  
    'label' => 'Nom',  
    'constraints' => [  
        new Length([  
            'min' => 2,  
            'max' => 25,  
            'minMessage' => 'Votre nom doit contenir au moins 2 caractères',  
        ])  
    ],
    ...
```
Pour le prénom :
```php 
    ->add('prenom', TextType::class, [  
    'label' => 'Prénom',  
    'constraints' => [  
        new Length([  
            'min' => 2,  
            'max' => 25,  
            'minMessage' => 'Votre prénom doit contenir au moins 2 caractères',  
        ])  
    ],
    ...
```
#### UniqueEntity
*https://symfony.com/doc/current/reference/constraints/UniqueEntity.html*

Pour vérifier que l'entrée d'une donnée dans le formulaire soit bien unique, il faut modifier le tableau d'options de la fonction `configureOptions()` du `InscriptionUtilisateurType.php`

Ici j'utiliserais comme entrée unique en base de données, **l'Email**:
```php 
public function configureOptions(OptionsResolver $resolver): void  
{  
    $resolver->setDefaults([  
        'constraints' => [  
            new UniqueEntity([  
                'entityClass' => Utilisateur::class,  
                'fields' => ['email'],  
            ])  
        ],  
        'data_class' => Utilisateur::class,  
    ]);  
}
```
## Création du formulaire de connexion et l'espace utilisateur

*https://symfony.com/doc/current/security.html#form-login*

Création du contrôleur  **ConnexionController.php**
```php 
symfony console make:controller

Choose a name for your controller class (e.g. GentlePizzaController):
 > Connexion          

 created: src/Controller/ConnexionController.php
 created: templates/connexion/index.html.twig

           
  Success!
```
Activation du `FormLoginAuthenticator` en ajoutant la clé du tableau `form_login`  dans `config/packages/security.yaml`
```php
firewalls:  
    dev:  
        pattern: ^/(_(profiler|wdt)|css|images|js)/  
        security: false  
    main:  
        form_login:
			# app_connexion est le nom de la route de mon contrôleur 'ConnexionController'.  
			# Si je modifie la route dans mon contrôleur, je dois aussi la modifier ici.
			login_path: app_connexion  
			check_path: app_connexion
```

Je modifie ensuite le contrôleur de connexion `ConnexionController.php`
```php
class ConnexionController extends AbstractController  
{  
    #[Route('/connexion', name: 'app_connexion')]  
  public function index(AuthenticationUtils $authenticationUtils): Response  
    {  
        // Récupération des erreurs d'authentification (s'il y en a)  
		$error = $authenticationUtils->getLastAuthenticationError();  
  
        // Récupération du dernier nom d'utilisateur (email) saisi (s'il y en a) et permet de l'afficher à nouveau dans le formulaire si l'utilisateur s'est trompé de mot de passe  
		$lastUsername = $authenticationUtils->getLastUsername();  
  
        return $this->render('connexion/index.html.twig', [  
            'last_username' => $lastUsername,  
            'error' => $error  
		]);  
    }  
}
```
Je modifie ensuite la vue associée au contrôleur pour utiliser les variables pour gérer l'erreur si l'utilisateur n'existe pas et connecter l'utilisateur (en mode développement le `Symfony Profiler` permet de voir si l'on est bien connecté):
```php
{% extends 'base.html.twig' %}

{% block title %}SoigneMoi - Bienvenue sur la page {{ titre_connexion }}{% endblock %}

{% block body %}
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ titre_connexion }}</h1>

            {% if error %}
                <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
            {% endif %}

            <form action="{{ path('app_connexion') }}" method="post">
                <label for="username">Adresse email:</label>
                <input class="form-control" type="text" id="username" name="_username" value="{{ last_username }}">

                <label for="password ">Mot de passe:</label>
                <input class="form-control" type="password" id="password" name="_password">

                {# If you want to control the URL the user is redirected to on success
                <input type="hidden" name="_target_path" value="/account"> #}

                <button class="btn btn-primary mt-3" type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</div>
{% endblock %}
```
Création d'un contrôleur pour faire l'interface entre l'espace utilisateur privé et les vues à affichées en fonction de l'utilisateur
```php
symfony console make:controller

 Choose a name for your controller class (e.g. GentlePizzaController):
 > CompteController

 created: src/Controller/CompteController.php
 created: templates/compte/index.html.twig

  Success! 
```
Modification de la vue `compte\index.html.twig` en utilisant une condition si l'utilisateur est connecté ou non
```php
{% extends 'base.html.twig' %}

{% block title %}SoigneMoi - Bienvenue sur la page {{ titre_compte }}{% endblock %}

{% block body %}
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ titre_compte }}</h1>
            {% if app.user is not null %}
                <p>Vous êtes connecté en tant que {{ app.user.prenom ~ ' ' ~ app.user.nom }}</p>
            {% else %}
                <p>Vous n'êtes pas connecté.</p>
            {% endif %}
            <p>Vous pouvez vous déconnecter en cliquant sur le bouton ci-dessous</p>
            <a href="{{ path('app_deconnexion') }}" class="btn btn-primary">Me déconnecter</a>
        </div>
    </div>
</div>


{% endblock %}


{% endblock %}
```
Modification de la vue de connexion`connexion\index.html.twig`pour la redirection vers `compte\index.html.twig` si le login est validé
```php
{# Redirection de l'utilisateur vers sont espace membre #}  
<input type="hidden" name="_target_path" value="{{ path('app_compte') }}">
```
## Création du chemin de déconnexion utilisateur `Logging Out`

*https://symfony.com/doc/current/security.html#logging-out*
Modification du `config/packages/security.yaml` en y ajoutant la route pour la déconnexion
```php
        main:
            form_login:
                # app_connexion est le nom de la route de mon contrôleur 'ConnexionController'.
                # Si je modifie la route dans mon contrôleur, je dois aussi la modifier ici.
                login_path: app_connexion
                check_path: app_connexion
            # Chemin de déconnexion de l'utilisateur (app_deconnexion définit dans ConnexionController.php)
            logout:
                path: app_deconnexion
```
Création dans le contrôleur de connexion `ConnexionController.php`, une route pour la déconnexion
```php
#[Route('/deconnexion', name: 'app_deconnexion', methods: ['GET'])]
    public function deconnexion() : never
    {
        // Cette méthode peut rester vide, elle ne sera jamais exécutée
    }
```
Modification du `config/packages/security.yaml` pour empêcher l'accès à la route `/compte` si l'utilisateur n'est pas connecté (dans ce cas, il sera redirigé vers la page de connexion)
```php
    access_control:
        - { path: ^/compte, roles: ROLE_USER }
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }
```

Modification dans le `base.html.twig`avec condition si l'utilisateur est connecté ou non
```php
                                <!-- VUE MOBILE DANS LE MENU BURGER -->
                                <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR EST CONNECTE-->
                                {% if app.user %}
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_compte') }}"><button class="btn btn-primary mt-3" type="submit">Mon compte</button></a>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_deconnexion') }}"><button class="btn btn-primary mt-3" type="submit">Se déconnecter</button></a>
                                </li>
                                <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR N'EST PAS CONNECTE-->
                                {% else %}
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_connexion') }}"><button class="btn btn-primary mt-3" type="submit">Se connecter</button></a>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_inscription') }}"><button class="btn btn-primary mt-3" type="submit">S'inscrire</button></a>
                                </li>
                                {% endif %}
                            </ul>
                        </div>
                        <!-- VUE DESKTOP EN DEHORS DU MENU BURGER -->
                        <div class="d-none d-lg-block">
                            <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR EST CONNECTE-->
                            {% if app.user %}
                                <a href="{{ path('app_compte') }}"><button class="btn btn-primary" type="submit">Mon compte</button></a>
                                <a href="{{ path('app_deconnexion') }}"><button class="btn btn-primary" type="submit">Se déconnecter</button></a>
                            <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR N'EST PAS CONNECTE-->
                            {% else %}
                                <a href="{{ path('app_connexion') }}"><button class="btn btn-primary" type="submit">Se connecter</button></a>
                                <a href="{{ path('app_inscription') }}"><button class="btn btn-primary" type="submit">S'inscrire</button></a>
                            {% endif %}
```

## Vérification des routes créées

Avec la commande `symfony console debug:router` cela me permet de savoir ou j'en suis des routes créées

```php
 -------------------------- -------- -------- ------ ----------------------------------- 
  Name                       Method   Scheme   Host   Path                               
 -------------------------- -------- -------- ------ ----------------------------------- 
  _preview_error             ANY      ANY      ANY    /_error/{code}.{_format}           
  _wdt                       ANY      ANY      ANY    /_wdt/{token}                      
  _profiler_home             ANY      ANY      ANY    /_profiler/                        
  _profiler_search           ANY      ANY      ANY    /_profiler/search                  
  _profiler_search_bar       ANY      ANY      ANY    /_profiler/search_bar              
  _profiler_phpinfo          ANY      ANY      ANY    /_profiler/phpinfo                 
  _profiler_xdebug           ANY      ANY      ANY    /_profiler/xdebug                  
  _profiler_font             ANY      ANY      ANY    /_profiler/font/{fontName}.woff2   
  _profiler_search_results   ANY      ANY      ANY    /_profiler/{token}/search/results  
  _profiler_open_file        ANY      ANY      ANY    /_profiler/open                    
  _profiler                  ANY      ANY      ANY    /_profiler/{token}                 
  _profiler_router           ANY      ANY      ANY    /_profiler/{token}/router          
  _profiler_exception        ANY      ANY      ANY    /_profiler/{token}/exception       
  _profiler_exception_css    ANY      ANY      ANY    /_profiler/{token}/exception.css   
  app_accueil                ANY      ANY      ANY    /                                  
  app_compte                 ANY      ANY      ANY    /compte                            
  app_connexion              ANY      ANY      ANY    /connexion                         
  app_deconnexion            GET      ANY      ANY    /deconnexion                       
  app_inscription            ANY      ANY      ANY    /inscription                       
 -------------------------- -------- -------- ------ -----------------------------------
 ```
## Modification du mot de passe par l'utilisateur

Au lieu de créer un nouveau contrôleur pour gérer la modification du mot de passe, j'utiliserai le contrôleur déjà existant des comptes `CompteController.php` pour créer une nouvelle route `/compte/modifier-mot-de-passe` dans le contrôleur

Modification du contrôleur `CompteController.php`
```php
    #[Route('/compte', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig',[
            'titre_compte' => 'Mon compte'
        ]);
    }

    #[Route('/compte/modification-mot-de-passe', name: 'app_compte_modif-mdp')]
    public function motDePasse(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        # Récupération de l'utilisateur connecté
        $utilisateur = $this->getUser();
        # transmission de l'utilisateur connecté au formulaire
        $form = $this->createForm(ModificationMotdePasseUtilisateurType::class, $utilisateur, [
            # Ne pas oublier l'injection de dépendances pour le UserPasswordHasherInterface
            # On transmet le UserPasswordHasherInterface au formulaire
            'password_hashers' => $passwordHasher
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            dd($form->getData());
            return $this->redirectToRoute('app_compte');
        }

        return $this->render('compte/motDePasse.html.twig',[
            'formulaireMotDePasse' => $form->createView()
        ]);
    }
```
Création du formulaire `ModificationMotdePasseUtilisateurType` pour le changement de mot de passe
```php
symfony console make:form

 The name of the form class (e.g. DeliciousGnomeType):
 > ModificationMotdePasseUtilisateurType   

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Utilisateur
Utilisateur

 created: src/Form/ModificationMotdePasseUtilisateurType.php
           
  Success! 
```
Ajout des options du formulaire `ModificationMotDePasseUtilisateurType.php` de changement de mot de passe
```php
$builder
            ->add('ancien_mot_de_passe', PasswordType::class, [
                'label' => 'Ancien mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez votre ancien mot de passe'
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
                        'placeholder' => 'Entrez votre nouveau mot de passe'
                    ],
                    'label' => 'Nouveau mot de passe',
                    // permet de transiter le mot de passe saisi dans le formulaire jusqu'au contrôleur de manière crypté
                    // Se réfère au security.yaml -> password_hashers
                    // 'password' se réfère au nom du propriété dans l'entité 'Utilisateur' qui se nomme 'password"
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
```
Toujours dans le formulaire `ModificationMotDePasseUtilisateurType.php` (après les options), écoute de la soumission et comparaison des mots de passe et récupération du contrôleur` CompteController.php` du `UserPasswordHasherInterface`

Injection de dépendances du `UserPasswordHasherInterface` puis transfère dans le formulaire via le tableau d'options de la méthode `buildForm()`

*https://symfony.com/doc/current/forms.html#passing-options-to-forms*

*Extrait `CompteController.php`*
```php
#[Route('/compte/modification-mot-de-passe', name: 'app_compte_modif-mdp')]
    public function motDePasse(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        # Récupération de l'utilisateur connecté
        $utilisateur = $this->getUser();
        # transmission de l'utilisateur connecté au formulaire
        $form = $this->createForm(ModificationMotdePasseUtilisateurType::class, $utilisateur, [
            # Ne pas oublier l'injection de dépendances pour le UserPasswordHasherInterface
            # On transmet le UserPasswordHasherInterface au formulaire
            'password_hashers' => $passwordHasher
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           $entityManager->flush();
        }

        return $this->render('compte/motDePasse.html.twig',[
            'formulaireMotDePasse' => $form->createView()
        ]);
    }
```
*Extrait `ModificationMotDePasseUtilisateurType.php`*
```php
->add('submit', SubmitType::class, [
                'label' => 'Modifier ...

... FIN DES OPTIONS ...

            # Au moment ou le formulaire est soumis, je veux écouter l'événement et comparer les deux mots de passe
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
```
Déclaration dans le formulaire `ModificationMotDePasseUtilisateurType.php` de l'option:

`password_hashers' => $passwordHasher` déclarée dans le contrôleur `CompteController.php`

*Extrait `ModificationMotDePasseUtilisateurType.php`*
```php
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
            # Par défault le 'password_hashers' est à null
            'password_hashers' => null
        ]);
    }
```
Création de la vue `motDePasse.html.twig`
```php
{% block body %}
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Modifier votre mot de passe</h1>
                {{ form_start(formulaireMotDePasse) }}
                    {{ form_row(formulaireMotDePasse.ancien_mot_de_passe) }}
                    {{ form_row(formulaireMotDePasse.motDePasse) }}
                {{ form_end(formulaireMotDePasse) }}
            </div>
        </div>
    </div>
{% endblock %}
```
#### Notification du changement de mot de passe avec les `Flash Messages`
*https://symfony.com/doc/current/session.html#flash-messages*

Dans la condition de la validation du formulaire du contrôleur, ajouter les `Flash Messages`
```php
   if ($form->isSubmitted() && $form->isValid()){
        # persister les données dans la table utilisateur
        $entityManager->flush();
        # notification Flash Messages
        $this->addFlash(
            'success',
            'Votre mot de passe a bien été modifié');
    }
```
Pour que le message s'affiche partout, modifier le `base.html.twig`
```php
<!-- MESSAGE FLASH -->
        <div class="container">
            {% for label, messages in app.flashes %}
                {% for message in messages %}
                    <div class="alert mt-4 alert-{{ label }}">
                        {{ message }}
                    </div>
                {% endfor %}
            {% endfor %}
        </div>
```
#### Ajout de l' `include` en PHP
Ajout de l' `include` en PHP avec TWIG dans la partie vue de l'espace personnel pour éviter de répéter du code
`{% include 'compte/_menu.html.twig' %}`

## Tests unitaires `Unit Tests` et fonctionnels `Application Tests`

*https://symfony.com/doc/current/testing.html*

>" Test unitaire : Un test unitaire est une procédure automatisée visant à vérifier le bon fonctionnement individuel d'une petite unité de code, comme une fonction ou une méthode, en isolant son comportement du reste du système. "

>" Test fonctionnel : Un test fonctionnel est une procédure automatisée visant à vérifier le bon fonctionnement d'une fonctionnalité ou d'un ensemble de fonctionnalités d'un logiciel du point de vue de l'utilisateur, en simulant des scénarios d'utilisation réels. "

Installation via composer de la dépendance (*en mode développement*) `test-pack/phpunit`:  
``  
composer require --dev symfony/test-pack  
``  
puis test de la bonne installation via la commande ``php bin/phpunit``

#### Création d'un test unitaire pour tester la fonctionnalité `test-pack/phpunit`:
```php  
symfony console make:test
```
```php  
Which test type would you like?:
  [TestCase       ] basic PHPUnit tests
  [KernelTestCase ] basic tests that have access to Symfony services
  [WebTestCase    ] to run browser-like scenarios, but that don't execute JavaScript code
  [ApiTestCase    ] to run API-oriented scenarios
  [PantherTestCase] to run e2e scenarios, using a real-browser or HTTP client and a real web server
 > TestCase
TestCase

Choose a class name for your test, like:
 * UtilTest (to create tests/UtilTest.php)
 * Service\UtilTest (to create tests/Service/UtilTest.php)
 * \App\Tests\Service\UtilTest (to create tests/Service/UtilTest.php)

 The name of the test class (e.g. BlogPostTest):
 > TestDeFonctionnement 

 created: tests/TestDeFonctionnementTest.php
    
  Success! 
```
Création du fichier d'exemple de de test dans `tests/TestDeFonctionnementTest.php`
```php
<?php  
  
namespace App\Tests;  
  
use PHPUnit\Framework\TestCase;  
  
class TestDeFonctionnementTest extends TestCase  
{  
    public function testSomething(): void  
  {  
        $this->assertTrue(true);  
    }  
}
```
puis exécution de la commande `php bin/phpunit` le résultat sera `SUCCESS` car dans mon exemple la condition est à `true` dans la fonction `assertTrue()`
```php
PHPUnit 9.6.18 by Sebastian Bergmann and contributors.

Testing
.                                                                   1 / 1 (100%)

Time: 00:00.023, Memory: 6.00 MB

OK (1 test, 1 assertion)
```
#### Création d'un test fonctionnel pour le formulaire d'inscription:
Exécution de la commande pour lancer l’assistant de création de test:
```php  
symfony console make:test
```
Dans la liste je choisis ``WebTestCase`` qui correspond à un comportement qu'un navigateur web peut avoir (*sauf qu'il n’exécute pas je JavaScript*) puis via l'assistant je crée la classe `FormulaireInscriptionUtilisateurTest.php` dans `tests`:
```php  
 Which test type would you like?:
  [TestCase       ] basic PHPUnit tests
  [KernelTestCase ] basic tests that have access to Symfony services
  [WebTestCase    ] to run browser-like scenarios, but that don't execute JavaScript code
  [ApiTestCase    ] to run API-oriented scenarios
  [PantherTestCase] to run e2e scenarios, using a real-browser or HTTP client and a real web server
 > WebTestCase      
WebTestCase

Choose a class name for your test, like:
 * UtilTest (to create tests/UtilTest.php)
 * Service\UtilTest (to create tests/Service/UtilTest.php)
 * \App\Tests\Service\UtilTest (to create tests/Service/UtilTest.php)

 The name of the test class (e.g. BlogPostTest):
 > FormulaireInscriptionUtilisateurTest

 created: tests/FormulaireInscriptionUtilisateurTest.php
           
  Success!
```
Les étapes suivantes seront :
1. Création d'une base de données fictives de test (soignemoi_test)
2. Création d'un client pour simuler une requête HTTP
3. Remplir les champs du formulaire
4. Test et suivi de la redirection
5. Vérifier si dans la page de redirection (message flash), le message:
>" Votre compte est bien créé. Vous pouvez vous connecter."

est bien présent.

Création de la base de données fictives de test avec le flag `--env=test` ce qui donnéra `soignemoi_test`:

```php 
symfony console doctrine:database:create --env=test

Created database `soignemoi_test` for connection named default
```

Ajout des tables qui se trouvent dans la base de données de production avec les flags `-n` (non interactif) et `--env=test`:
```php
symfony console doctrine:migrations:migrate -n --env=test
```

Exemple de test unitaire pour le formulaire d'inscription `FormulaireInscriptionUtilisateurTest.php`:
```php
class FormulaireInscriptionUtilisateurTest extends WebTestCase
{
    public function testSomething(): void
    {
        /* 1. Création d'un faux client pour simuler une requête HTTP */
        $client = static::createClient();
        $client->request('GET', '/inscription');

        /* 2. Remplir les champs du formulaire d'inscription utilisateur */
        $client->submitForm("Inscription", [
            'inscription_utilisateur[nom]' => 'Brault',
            'inscription_utilisateur[prenom]' => 'Yoni-Alexandre',
            'inscription_utilisateur[adresse_postale]' => '1 rue STUDI',
            'inscription_utilisateur[email]' => 'studi@test.com',
            'inscription_utilisateur[motDePasse][first]' => '123456789',
            'inscription_utilisateur[motDePasse][second]' => '123456789',
        ]);
        /* 3. Test de la redirection*/
        $this->assertResponseRedirects('/connexion');
        /* Suivre la redirection */
        $client->followRedirect();

        /* 4. Vérifier que la page de redirection (message flash) est bien : "Votre compte est bien créé. Vous pouvez vous connecter." */
        /* Rechercher un élément (div) qui contient le message */
        $this->assertSelectorExists('div:contains("Votre compte est bien créé. Vous pouvez vous connecter.")');
    }
}
```
Execution du test unitaire avec la commande `php bin/phpunit`:
```php
php bin/phpunit
PHPUnit 9.6.18 by Sebastian Bergmann and contributors.

Testing 
.                                                                   1 / 1 (100%)

Time: 00:00.840, Memory: 42.00 MB

OK (1 test, 3 assertions)
```
## Interface d'administration avec EasyAdmin
*https://symfony.com/bundles/EasyAdminBundle/current/index.html*

Installation du bundle `EasyAdmin` via composer:
```php
composer require easycorp/easyadmin-bundle
```
Création du premier tableau de bord avec la commande :
`symfony console make:admin:dashboard`

```php
 Which class name do you prefer for your Dashboard controller? [DashboardController]:
 > DashboardController

 In which directory of your project do you want to generate "DashboardController"? [src/Controller/Admin/]:
 > src/Controller/Admin/


                                                                                                                        
 [OK] Your dashboard class has been successfully generated.
```

Modification du `config/packages/security.yaml` pour empêcher l'accès à la route `/admin` si l'utilisateur n'a pas le rôle `ROLE_ADMIN` (dans ce cas, il sera redirigé vers la page de connexion)
```php
    access_control:
        - { path: ^/compte, roles: ROLE_USER }
        - { path: ^/admin, roles: ROLE_ADMIN }
```
Lié l'entité `Utilisateur` à `EasyAdmin` en créant un `CRUD Controllers`:

*https://symfony.com/bundles/EasyAdminBundle/current/crud.html*

`symfony console make:admin:crud`

```php
 Which Doctrine entity are you going to manage with this CRUD controller?:
  [0] App\Entity\Medecin
  [1] App\Entity\Medicament
  [2] App\Entity\PlanningMedecin
  [3] App\Entity\Prescription
  [4] App\Entity\Sejour
  [5] App\Entity\Utilisateur
 > 5
5

 Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
 > 

 Namespace of the generated CRUD controller [App\Controller\Admin]:
 >

                                                                                                                        
 [OK] Your CRUD controller class has been successfully generated.
```
Modification de la classe `DashboardController.php` pour créer un lien avec l'entité `Utilisateur` dans le tableau de bord `DashboardController.php`:
```php
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UtilisateurCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SOIGNEMOI Administration' );
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
    }
}
```

Personnalisation de l'affichage via les options du CRUD Controller Configuration dans le tableau de bord `UtilisateurCrudController.php`:
*https://symfony.com/bundles/EasyAdminBundle/current/crud.html#crud-controller-configuration*
```php
class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ;
    }
    ...
```
Configuration des champs à afficher dans le tableau de bord `UtilisateurCrudController.php`:
```php
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
        ];
    }
```
```php
public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom')->setLabel('Nom'),
            TextField::new('prenom')->setLabel('Prénom'),
            // onlyOnIndex() signifie que ce champ ne sera affiché que dans la liste des utilisateurs (sur EasyAdmin) et pas dans la modification de l'utilisateur
            // pour éviter que l'administrateur modifie les Emails des utilisateurs
            EmailField::new('email')->setLabel('Email')->onlyOnIndex(),
        ];
    }
```
Ajout du CRUD Controller pour les Médecins
`symfony console make:admin:crud`

```php
Which Doctrine entity are you going to manage with this CRUD controller?:
  [0] App\Entity\Medecin
  [1] App\Entity\Medicament
  [2] App\Entity\PlanningMedecin
  [3] App\Entity\Prescription
  [4] App\Entity\Sejour
  [5] App\Entity\Utilisateur
 > 0
0

 Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
 > 

 Namespace of the generated CRUD controller [App\Controller\Admin]:
 >

                                                                                                                        
 [OK] Your CRUD controller class has been successfully generated.   
```
Modification de la classe `DashboardController.php` pour créer un lien avec l'entité `Medecin` dans le tableau de bord `DashboardController.php`:
```php
yield MenuItem::linkToCrud('Médecins', 'fas fa-stethoscope', Medecin::class);
```
Configuration du Crud Controller de l'entité `Medecin` dans le tableau de bord `MedecinCrudController.php`:
```php
public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Nom d'affichage de l'entité au singulier et au pluriel
            ->setEntityLabelInSingular('Médecin')
            ->setEntityLabelInPlural('Médecins')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prénom'),
            AssociationField::new('specialite', 'Spécialité'),
            TextField::new('matricule', 'Matricule'),
        ];
    }
```
Ajout de la méthode toString() dans l'entité `Medecin.php` pour afficher pouvoir afficher la spécialité du médecin dans le tableau de bord `MedecinCrudController.php`:
```php
public function __toString(): string
    {
        return $this->specialite;
    }
```

## Gestion des rendez-vous

Pour que l'utilisateur, depuis son espace personnel, puisse prendre un rendez-vous, j'ai crée un contrôleur `RendezVousController.php` avec les fonctionnalités de pouvoir ajouter et annuler un rendez-vous associé à l'utilisateur connecté et à l'id du médecin puis une redirection vers la liste des rendez-vous sera faite :
```php
<?php

namespace App\Controller;

use App\Entity\RendezVousUtilisateur;
use App\Form\RendezVousUtilisateurType;
use App\Repository\MedecinRepository;
use App\Repository\RendezVousUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousController extends AbstractController
{
    #[Route('/compte/rendez-vous', name: 'app_rendez-vous')]
    public function rdv(Security $security, RendezVousUtilisateurRepository $rendezVousUtilisateurRepository): Response
    {
        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdvs = $rendezVousUtilisateurRepository->findBy(['utilisateur' => $utilisateur]);

        return $this->render('rendez_vous/rendezVous.html.twig',[
            'rdvs' => $rdvs,
        ]);
    }
    #[Route('rendez_vous/ajouter/{medecinId}', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager, Security $security, $medecinId, MedecinRepository $medecinRepository): Response
    {
        $rdv = new RendezVousUtilisateur();

        // Récupération et attribution du médecin à partir de l'ID dans l'URL
        $medecin = $medecinRepository->find($medecinId);
        $rdv->setMedecin($medecin);

        // Utilisation du service de sécurité de Symfony pour obtenir l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        $rdv->setUtilisateur($utilisateur);

        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($rdv);
            $entityManager->flush();
            // redirection vers la page des rendez-vous de l'utilisateur
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
            'medecinId' => $medecinId,
        ]);
    }


    #[Route('rendez_vous/modifier/{id}', name: 'app_rendez-vous_modifier')]
    public function modifierRendezVous(Request $request, EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/modifierRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
        ]);
    }

    #[Route('rendez_vous/supprimer/{id}', name: 'app_rendez-vous_supprimer')]
    public function supprimerRendezVous(EntityManagerInterface $entityManager, RendezVousUtilisateur $rdv): Response
    {
        $entityManager->remove($rdv);
        $entityManager->flush();
        return $this->redirectToRoute('app_rendez-vous');
    }
}
```
Sa vue associée pour remplir le formulaire :
```php
{% extends 'base.html.twig' %}

{% block title %}SoigneMoi - Bienvenue sur la page d'ajout de rendez-vous{% endblock %}

{#   {% block navbar %}{% endblock %} #}

{% block body %}
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Ajouter un rendez-vous</h1>

                {{ form_start(formulaireRdv) }}
                {{ form_row(formulaireRdv.date) }}
                {# {{ form_row(formulaireRdv.heure) }} #}
                {# {{ form_row(formulaireRdv.utilisateur) }} #}
                {{ form_row(formulaireRdv.motifDeSejour) }}
                {{ form_row(formulaireRdv.medecin) }}

                {{ form_end(formulaireRdv) }}

            </div>
        </div>
    </div>
{% endblock %}
```
et le formulaire pour remplir les champs des rendez-vous en base de données :
```php
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

```

#### Status des rendez-vous
J'ai tout d'abord ajouté un nouveau champ `status` à mon entité `RendezVousUtilisateur.php`
```php
#[ORM\Column(length: 255, nullable: true)]
private ?string $status = null;
```

J'ai modifié le contrôleur pour définir l'état du rendez-vous :
Mise à jour de la méthode ajouterRendezVous dans RendezVousController.php. Plus précisément, j'ai ajouté la ligne ``$rdv->setStatus('à venir');`` juste avant d'appeler ``$form->handleRequest($request);``. Cela garantit que chaque nouveau ``RendezVousUtilisateur`` est initialisé avec le statut 'à venir'.
```php
$rdv->setStatus('à venir');
```

Ensuite j'ai mis à jour la vue ``rendezVous.html.twig`` pour modifier le design en utilisant Bootstrap pour la mise en forme des informations de rendez-vous en cartes, et j'ai appliqué des couleurs différentes pour chaque statut de rendez-vous.
```php
        <h3>Rendez-vous à venir</h3>
           <div class="row">
               {% for rdv in rdvs|filter(rdv => rdv.status == 'à venir') %}
                  {{ include('rendez_vous/_rendez-vous.html.twig', {'rdv': rdv, 'cardColor': 'bg-primary text-white'}) }}
                {% endfor %}
           </div>

        <h3 class="mt-5">Rendez-vous en cours</h3>
           <div class="row">
               {% for rdv in rdvs|filter(rdv => rdv.status == 'en cours') %}
                  {{ include('rendez_vous/_rendez-vous.html.twig', {'rdv': rdv, 'cardColor': 'bg-warning text-dark'}) }}
               {% endfor %}
            </div>

        <h3 class="mt-5">Rendez-vous effectué</h3>
           <div class="row">
              {% for rdv in rdvs|filter(rdv => rdv.status == 'effectué') %}
                  {{ include('rendez_vous/_rendez-vous.html.twig', {'rdv': rdv, 'cardColor': 'bg-success text-white'}) }}
              {% endfor %}
        </div>
```
la vue de l' `include`
```php
<div class="col-md-4 mb-4">
    <div class="card {{ cardColor }}">
        <div class="card-body">
            <h5 class="card-title">{{ rdv.date|date('d/m/Y') }} à {{ rdv.date|date('H:i') }}</h5>
            <h6 class="card-subtitle mb-2">{{ rdv.utilisateur.nom }} {{ rdv.utilisateur.prenom }}</h6>
            <p class="card-text">{{ rdv.medecin }}</p>
            <a href="{{ path('app_rendez-vous_supprimer', {'id': rdv.id}) }}" class="btn btn-light">Annuler</a>
        </div>
    </div>
</div>
```
Ajout de la vérification du statut de chaque rendez-vous avant de les afficher à l'utilisateur

Mise à jour du statut de chaque rendez-vous selon que la date du rendez-vous est "effectué", "en cours", "à venir"

```php
        // Création d'un objet DateTime qui contient la date et l'heure actuelle
        $actuelle = new \DateTime();

        // Boucle qui parcourt chaque rendez-vous dans le tableau $rdvs
        foreach ($rdvs as $rdv) {
            // Obtention de la date du rendez-vous actuel et la stocke dans une variable $dateRDV
            $dateRDV = $rdv->getDate();

            // Vérification si la date du rendez-vous est passée et si le statut du rendez-vous n'est pas déjà "effectué".
            if ($dateRDV < $actuelle && $rdv->getStatus() != 'effectué') {
                // Change le statut du rendez-vous à "effectué"
                $rdv->setStatus('effectué');

              // Vérifie si la date du rendez-vous est la même que la date actuelle et si le statut du rendez-vous n'est pas déjà "en cours"
            } elseif ($dateRDV == $actuelle && $rdv->getStatus() != 'en cours') {
                // Change le statut du rendez-vous à "en cours"
                $rdv->setStatus('en cours');
            } // sinon le statut reste 'à venir' par défaut

            // Prépare le rendez-vous pour être enregistré (ou mise à jour) dans la base de données.
            $entityManager->persist($rdv);
        }
        // Flush dans la base de données les opérations préparées avec $entityManager->persist($rdv);
        $entityManager->flush();
```
#### Ajout de la correspondance entre les rendez-vous des utilisateurs et les plannings des médecins
Ajout de la fonction `disponibiliteMedecin()` dans le repository `PlanningMedecinRepository` pour retourner les créneaux d'un medecin spécifique
```php
public function disponibiliteMedecin(\DateTimeInterface $date, Medecin $medecin)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p.nombre_patients_max - COUNT(r) as available')
            ->leftJoin('p.rendezVousUtilisateurs', 'r')
            ->andWhere('p.medecin = :medecin')
            ->andWhere('p.date = :date')
            ->setParameter('medecin', $medecin)
            ->setParameter('date', $date)
            ->groupBy('p.id')
            ->getQuery();

        $result = $query->getOneOrNullResult();
        return ($result == null || $result['available'] > 0);
    }
```
Modification du formulaire `RendezVousUtilisateurType.php` pour ajouter les créneaux disponibles en utilisant la fonction `disponibiliteMedecin()`

Lorsqu'un utilisateur souhaitera prendre un rendez-vous, il ne verra que les créneaux disponibles pour le médecin sélectionné
```php
$planningMedecinRepo = $options['planningMedecinRepository'];
        $placeDisponible = $planningMedecinRepo->disponibiliteMedecins($builder->getData()->getMedecin());

        $choices = [];
        foreach($placeDisponible as $place)
        {
            if ($place instanceof \DateTime) {
                $choices[$place->format('Y-m-d H:i')] = $place;
            } else {
                
            }
        } 

        $builder

            ->add('date', ChoiceType::class, [
                'choices' => $choices,
                'choice_label' => function($date){
                    return $date->format('Y-m-d H:i');
                },
                'label' => 'Choisissez un créneau',
            ])
```
Vérification des places disponibles avant d'entrer dans le formulaire dans le contrôleur RendezVousController.php

La fonction `ajouterRendezVous()` crée un nouvel objet de rendez-vous pour l'utilisateur qui est actuellement connecté, elle trouve le médecin dans la base de données à l'aide de son identifiant, puis vérifie la disponibilité d'un créneau horaire pour ce médecin.
S'il est disponible, la fonction `ajouterRendezVous()` crée un formulaire pour le rendez-vous.
Si le formulaire est soumis et valide, elle vérifie si suffisamment de places sont disponibles pour le nombre de places demandées.
Si oui, elle met à jour le nombre de places disponibles et enregistre les détails du rendez-vous dans la base de données.
Pour finir, la fonction renvoie un message de validation ou non du rendez-vous et redirige l'utilisateur.
```php
#[Route('rendez_vous/ajouter/{medecinId}', name: 'app_rendez-vous_ajouter')]
    public function ajouterRendezVous(Request $request, EntityManagerInterface $entityManager, Security $security, $medecinId, MedecinRepository $medecinRepository, PlanningMedecinRepository $planningMedecinRepository): Response
    {
        // Crée un nouvel objet RendezVousUtilisateur
        $rdv = new RendezVousUtilisateur();
        // Récupère l'utilisateur actuellement connecté
        $utilisateur = $security->getUser();
        // Associe le rendez-vous à cet utilisateur
        $rdv->setUtilisateur($utilisateur);

        // Trouve un médecin spécifique dans la base de données en utilisant son ID
        $medecin = $medecinRepository->find($medecinId);
        // Associe le rendez-vous avec le médecin trouvé
        $rdv->setMedecin($medecin);

        /// Utilise le PlanningMedecinRepository pour vérifier les créneaux disponibles pour le médecin spécifié
        $disponibiliteMedecins = $planningMedecinRepository->disponibiliteMedecins($medecin);
        // Si aucun créneau n'est disponible, il envoie un message flash à l'utilisateur et le redirige vers une autre page
        if (empty($disponibiliteMedecins)) {
            $this->addFlash('danger', 'Il n\'y a plus de disponibilité pour ce médecin.');
            // Rediriger vers la page précédente ou une autre page appropriée.
            return $this->redirectToRoute('app_rendez-vous');
        }
        
        // Par défaut, le statut du rendez-vous est "à venir"
        $rdv->setStatus('à venir');

        // Crée un formulaire pour le rendez-vous utilisant RendezVousUtilisateurType comme classe de formulaire.
        $form = $this->createForm(RendezVousUtilisateurType::class, $rdv);
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et si toutes les données du formulaire sont valides
        if ($form->isSubmitted() && $form->isValid()){
            // Récupère les données du formulaire
            $rdv = $form->getData();
            // Récupère la date du rendez-vous
            $date = $rdv->getDate();
            // Si une date a été sélectionnée, le code vérifie s'il y a des créneaux disponibles pour cette date
            if ($date !== null) {
                // On récupère le planning associé à la date et au médecin
                $planningMedecin = $planningMedecinRepository->findOneBy([
                    'date' => $date,
                    'medecin' => $rdv->getMedecin()
                ]);
                // Si aucun planning n'est associé à cette date et médecin, on refuse la réservation
                if (!$planningMedecin) {
                    $this->addFlash('danger', 'Il n\'y a plus de places disponibles pour ce créneau.');
                    return $this->redirectToRoute('app_rendez-vous');
                }
                // Récupère toutes les places disponibles et le nombre de places que l'utilisateur souhaite réserver
                $totalPlacesDisponibles = $planningMedecin->getNombrePatientsMax();
                $placesReservees = $rdv->getNombrePlacesReservees();
                // Vérifie si suffisamment de places sont disponibles. Si ce n'est pas le cas, affiche un message d'erreur et redirige vers app_rendez-vous
                if ($totalPlacesDisponibles < $placesReservees) {
                    $this->addFlash('danger', 'Il n\'y a pas assez de places disponibles pour ce créneau.');
                    return $this->redirectToRoute('app_rendez-vous');
                }

                // Met à jour le nombre de places restantes
                $planningMedecin->setNombrePatientsMax($totalPlacesDisponibles - $placesReservees);
                // Persiste le planningMedecin dans la base de données
                $entityManager->persist($planningMedecin);

                $entityManager->persist($rdv);
                $entityManager->flush();
                // redirection vers la page des rendez-vous de l'utilisateur
                return $this->redirectToRoute('app_rendez-vous');
                // S'il n'y a pas de place disponible pour cette date, un message flash est généré.
            } else {
                $this->addFlash('danger', 'Il n\'y a plus de place disponible à cette date pour ce médecin.');
            }
        } else {
            // S'il n'y a pas de date sélectionnée, un autre message flash est généré.
            $this->addFlash('warning', 'Il n\'y a plus de place disponible à cette date pour ce médecin.');
        }

        return $this->render('rendez_vous/ajouterRendezVous.html.twig',[
            'formulaireRdv' => $form->createView(),
            'medecinId' => $medecinId,
        ]);
    }
```
J'ai ajouté une méthode `getNombrePlacesRestantes()` dans l'entité `PlanningMedecin`. 
Cette méthode parcourt tous les rendez-vous associés à un planning de médecin et calcule le nombre total de réservations. 
Ensuite, elle soustrait ce total du nombre maximal de patients pour déterminer le nombre de places restantes.

```php
    public function getNombrePlacesRestantes(): int
    {
        $totalReservations = 0;
        foreach ($this->getRendezVousUtilisateurs() as $rendezVous) {
            $totalReservations += $rendezVous->getNombrePlacesReservees();
        }
        return $this->getNombrePatientsMax() - $totalReservations;
    }
```

Ensuite, dans le contrôleur `CompteController`, j'ai récupéré tous les médecins et leurs plannings. 
Pour chaque planning, j'ai calculé les places restantes en appelant la méthode précédemment ajoutée. 
J'ai passé ces informations à la vue sous forme d'un tableau contenant les médecins, leurs plannings et le nombre de places restantes.

```php
    #[Route('/compte', name: 'app_compte')]
    public function index(MedecinRepository $medecinRepository): Response
    {
        $medecins = $medecinRepository->findAll();
        $medecinsDonnees = [];

        foreach ($medecins as $medecin) {
            $plannings = $medecin->getPlanningMedecins();
            foreach ($plannings as $planning) {
                $medecinsDonnees[] = [
                    'medecin' => $medecin,
                    'planning' => $planning,
                    'places_restantes' => $planning->getNombrePlacesRestantes(),
                ];
            }
        }

        return $this->render('compte/index.html.twig', [
            'titre_compte' => 'Mon compte',
            'medecinsDonnees' => $medecinsDonnees
        ]);
    }
```

Pour finir, j'ai mis à jour la vue `index.html.twig` pour afficher les places restantes pour chaque rendez-vous. 
J'ai utilisé une boucle pour parcourir les données des médecins et affiché le nombre de places restantes dans chaque carte de rendez-vous.

```twig
                    {% for medecinDonnee in medecinsDonnees %}
                        <div class="col">
                            <div class="card mb-3 text-left ybRDV-Cards" style="max-width: 18rem;">
                                <div class="card-header bg-white text-dark">
                                    <div class="d-flex align-items-center">
                                        {% if medecinDonnee.medecin.photo %}
                                            <img src="/assets/photos/{{ medecinDonnee.medecin.photo }}" alt="Photo du praticien" class="rounded-circle" style="width: 50px; height: 50px;">
                                        {% else %}
                                            <img src="{{ asset('assets/images/SOIGNEMOI-logo.png') }}" alt="Photo par défaut" class="rounded-circle" style="width: 50px; height: 50px;">
                                        {% endif %}
                                        <div class="ms-3">
                                            <p class="card-text mb-0">Praticien : {{ medecinDonnee.medecin.prenom }} {{ medecinDonnee.medecin.nom }}</p>
                                            <p class="card-text">Spécialité : {{ medecinDonnee.medecin.specialite }}</p>
                                            <hr class="my-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center text-white rounded-bottom-corners ybRDV-Cards">
                                    <h5 class="card-title">
                                        Place(s) restante(s) : {{ medecinDonnee.places_restantes }}
                                    </h5>
                                    <a href="{{ path('app_rendez-vous_ajouter', {'medecinId': medecinDonnee.medecin.id}) }}" class="btn btn-primary">Prendre rendez-vous</a>
                                </div>
                            </div>
                        </div>
```

## Re-factorisation du code
Ayant des méthodes et des routes dans certains contrôleurs qui ne correspondent plus forcément au contrôleur initial (notamment pour les rendez-vous),
j'ai re-factorisé le code en créant de nouveaux contrôleurs pour y injecter les méthodes et les routes qui ne correspondent plus aux anciens contrôleurs.
Mes contrôleurs seront plus clairs et plus faciles à maintenir.

### Ajouts de nouveaux contrôleurs pour les rendez-vous et déplacement des fonctions
- `ajouterRendezVous()` dans le contrôleur `RendezVousAjoutController.php`
- `modifierRendezVous()` dans le contrôleur `RendezVousModificationController.php`
- `supprimerRendezVous()` dans le contrôleur `RendezVousAnnulationController.php`
  du contrôleur principal `RendezVousController.php` pour que les contrôleurs soient plus lisibles.

### Modification d'entités pour correspondre aux fonctionnalités demandées dans le devoir
- Modification de l'entité `Avis.php`, `Prescription.php` et `Medicaments.php` en ayant une relation `ManyToOne` pour les associer entre elles ainsi que les médecins et patients.

##### Avis.php
```php
<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Medecin $medecin = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(targetEntity: Prescription::class, inversedBy: 'avis')]
    private ?Prescription $prescription = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
    public function getPrescription(): ?Prescription
    {
        return $this->prescription;
    }
    public function setPrescription(?Prescription $prescription): self
    {
        $this->prescription = $prescription;

        return $this;
    }
}
```
##### Prescription.php
```php
<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutTraitement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinTraitement = null;

    #[ORM\ManyToOne(inversedBy: 'prescription')]
    private ?Medicament $medicament = null;

    #[ORM\ManyToOne(inversedBy: 'prescription')]
    private ?Medecin $medecin = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'prescription')]
    private Collection $avis;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getDateDebutTraitement(): ?\DateTimeInterface
    {
        return $this->dateDebutTraitement;
    }

    public function setDateDebutTraitement(\DateTimeInterface $dateDebutTraitement): static
    {
        $this->dateDebutTraitement = $dateDebutTraitement;

        return $this;
    }

    public function getDateFinTraitement(): ?\DateTimeInterface
    {
        return $this->dateFinTraitement;
    }

    public function setDateFinTraitement(\DateTimeInterface $dateFinTraitement): static
    {
        $this->dateFinTraitement = $dateFinTraitement;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): static
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvis(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setPrescription($this);
        }

        return $this;
    }

    public function removeAvis(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getPrescription() === $this) {
                $avi->setPrescription(null);
            }
        }

        return $this;
    }
}
```

Modification des CRUDController associés

##### AvisCrudController.php
```php
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
````
##### PrescriptionCrudController.php
```php
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
````
Organisation dans EasyAdmin des CrudControllers à l'aide de `yield MenuItem::section()` pour les regrouper par catégories

```php
yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::section('Médecins');
        yield MenuItem::linkToCrud('Médecins', 'fas fa-stethoscope', Medecin::class);
        yield MenuItem::linkToCrud('Spécialités', 'fas fa-heartbeat', SpecialiteMedecin::class);
        yield MenuItem::linkToCrud('Plannings', 'fas fa-calendar', PlanningMedecin::class);
        yield MenuItem::section('Rendez-Vous');
        yield MenuItem::linkToCrud('Rendez-Vous', 'fas fa-calendar', RendezVousUtilisateur::class);
        yield MenuItem::section('Gestion des avis et prescriptions');
        yield MenuItem::linkToCrud('Avis', 'fas fa-comment-medical', Avis::class);
        yield MenuItem::linkToCrud('Prescription', 'fas fa-file-medical', Prescription::class);
        yield MenuItem::section('Médicaments');
        yield MenuItem::linkToCrud('Médicament', 'fas fa-pills', Medicament::class);
```
## Création de Fixtures

Pour éviter de créer à la main des données de test dans la base de données, j'ai utilisé la librairie `orm-fixtures` pour générer des données aléatoires pour les entités `Utilisateur`, `Medecin`, `SpecialiteMedecin`, `PlanningMedecin`, `Prescription`, `Medicament`, `Avis`
J'ai installé la librairie `orm-fixtures` et `fakerphp/faker` pour générer des données aléatoires dans les fixtures

Installation en mode développement de la librairie `orm-fixtures` avec la commande

`composer require --dev orm-fixtures`

L'installation créera un répertoire `DataFixtures` dans le répertoire `src` pour y stocker les fixtures

Installation en mode développement de la librairie `fakerphp/faker` pour générer des données aléatoires dans les fixtures

`composer require --dev fakerphp/faker`

Configuration du fichier `AppFixtures.php` dans le répertoire `src/DataFixtures` pour générer des données aléatoires pour les entités `Utilisateur`, `Medecin`, `SpecialiteMedecin`, `PlanningMedecin`, `Prescription`, `Medicament`, `Avis`

```php
<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\PlanningMedecin;
use App\Entity\Prescription;
use App\Entity\SpecialiteMedecin;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName);
            $utilisateur->setPrenom($faker->firstName);
            $utilisateur->setEmail($faker->email);

            $plainPassword = "any_temp_password";
            $encodedPassword = $this->passwordEncoder->hashPassword($utilisateur, $plainPassword);

            $utilisateur->setPassword($encodedPassword);
            $utilisateur->setRoles(['ROLE_USER']);
            $utilisateur->setAdressePostale($faker->address);

            $manager->persist($utilisateur);
        }

        // Création d'un utilisateur admin
        $admin = new Utilisateur();
        $admin->setNom('Admin');
        $admin->setPrenom('Admin');
        $admin->setEmail('yoni-brault@blanche-de-castille.fr');
        $plainPassword = "Y_a=B7-5&?2:2?>";
        $encodedPassword = $this->passwordEncoder->hashPassword($utilisateur, $plainPassword);
        $admin->setPassword($encodedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setAdressePostale('1 rue de la Paix, 75000 Paris');
        $manager->persist($admin);

        // Création de spécialités
        $specialites = [];
        for ($i = 0; $i < 10; $i++) {
            $specialite = new SpecialiteMedecin();
            $specialite->setSpecialite($faker->word);
            $specialite->setSlug($faker->slug);
            $manager->persist($specialite);
            $specialites[] = $specialite;
        }

        // Création de médecins
        $medecins = [];
        for ($i = 0; $i < 10; $i++) {
            $medecin = new Medecin();
            $medecin->setNom($faker->lastName);
            $medecin->setPrenom($faker->firstName);
            $medecin->setMatricule($faker->randomNumber(8));

            $randomSpecialite = $specialites[array_rand($specialites)];
            $medecin->setSpecialite($randomSpecialite);

            $manager->persist($medecin);
            $medecins[] = $medecin;
        }

        // Création des plannings
        $plannings = [];
        for ($i = 0; $i < 10; $i++) {
            $planning = new PlanningMedecin();
            $planning->setDate($faker->dateTimeBetween('now', '+1 month'));
            $planning->setMedecin($medecins[array_rand($medecins)]);

            $manager->persist($planning);
            $plannings[] = $planning;
        }

        // Création des médicaments
        $medicaments = [];
        for ($i = 0; $i < 10; $i++) {
            $medicament = new Medicament();
            $medicament->setNom($faker->word);
            $medicament->setPosologie($faker->sentence);

            $manager->persist($medicament);
            $medicaments[] = $medicament;
        }

        // Création des Préscriptions
        $prescriptions = [];
        for ($i = 0; $i < 10; $i++) {
            $prescription = new Prescription();
            $prescription->setNom($faker->word);
            $prescription->setDateDebutTraitement($faker->dateTimeBetween('now', '+1 month'));
            $prescription->setDateFinTraitement($faker->dateTimeBetween('+1 month', '+2 month'));
            $prescription->setMedicament($medicaments[array_rand($medicaments)]);

            $manager->persist($prescription);
            $prescriptions[] = $prescription;
        }

        // Création des Avis Médecins
        $avisMedecin = [];
        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis->setLibelle($faker->sentence);
            $avis->setDate($faker->dateTimeBetween('now', '+1 month'));
            $avis->setDescription($faker->paragraph);
            $avis->setMedecin($medecins[array_rand($medecins)]);
            $avis->setUtilisateur($utilisateur);
            $avis->setPrescription($prescriptions[array_rand($prescriptions)]);

            $manager->persist($avis);
            $avisMedecin[] = $avis;
        }

        $manager->flush();
    }
}
```
La commande pour lancer les fixtures : `php bin/console doctrine:fixtures:load`

## Exposer une API avec API Platform en lecture et écriture pour les Médecins

*https://api-platform.com/docs/distribution/*

API Platform est une API "Auto découvrable" qui fait partie des critères pour être une API RESTful.
Création d'une API REST avec API Platform pour les médecins pour pouvoir saisir depuis leur mobile, une prescription et un avis qu'il donne à un patient pour l'ajouter à son dossier.
Un avis aura un libelle (un titre de l'avis), une date, une description, le nom et le prénom du médecin.
Une préscription aura une liste de médicament, une posologie, une date de début de traitement ainsi qu'une date de fin de traitement, la fate de fin pourra être modifié par le médecin si il juge que le patient est soigné.

Installation de API Platform avec la commande
`composer require api`

Après l'installation de API Platform, je modifie le prefix `/api` en `/apiMedecins` pour les routes de l'API dans le fichier `config/routes/api_platform.yaml`

```php 
api_platform:
    resource: .
    type: api_platform
    prefix: /apiMedecins
```

Ensuite j'indique les entités à exposer dans l'API (sérialisant en JSON) dans l'entête des annotations des entités `Avis.php` et `Prescription.php`

`#[ApiResource]` (en n'oubliant pas d'importer la classe `ApiResource` dans `ApiPlatform\Metadata\ApiResource` de API Platform).

Tous les sous objets de l'entité `Avis.php` doivent avoirs dans leur entête d'annotation `#[ApiResource]` pour ne pas avoir de référence circulaire (boucle).

Une référence circulaire se produit lorsqu'un objet contient une référence à un autre objet (sous objet de l'objet initial) qui contient une référence à l'objet d'origine.

Entité `Avis.php`
```php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
#[ApiResource]
class Avis
{
  ...
}
```
et les objets (Sous objet de Avis) `Medecin.php`, `Utilisateur.php`, `Prescription.php`

`Medecin.php`
```php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
#[ApiResource] 
class Medecin
{
  ...
}
```

`Utilisateur.php`
```php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource]

class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    ...
}
```

`Prescription.php`
```php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
#[ApiResource]
class Prescription
{
  ...
}
```

#### Gestion des expositions des routes de l'API

*https://api-platform.com/docs/core/operations/*

Il est possible avec API Plateform de préciser si les valeurs par défaut ne conviennent pas (Tout est autorisé par défaut).

Exemples:
- *Avoir une exposition en GET et pas en POST*
- *Accès à la route seulement pour les utilisateurs connectés ou juste les médecins, etc.*
- *Limiter certaines opérations à certains rôles*
- *Création de groupes de sérialisation pour les entités*

Je crée les groupes de "sérialisation" `avis:read` et "désérialisation" `avis:write` en utilisant la convention de séparateur `:` pour les `Avis`, `Prescription` et `Medicament` pour ne pas exposer toutes les données de l'entité.

`#[ApiResource(normalizationContext: normalizationContext: ['groups' => ['avis:read']]), denormalizationContext: ['groups' => ['avis:write']])]`

et j'importe la classe `ApiResource` dans `ApiPlatform\Metadata\ApiResource` de API Platform.

J'utilise aussi l'attribut `uriTemplate` pour personnaliser la route de l'API, car par défaut API Platform utilise l'iri de l'entité pour les routes de l'API et ajoute un pluriel ce qui donnait pour "Avis" -> "Aviss" avec deux "s".
J'ajoute aussi l'attribut `security` pour limiter l'accès à la route seulement pour les utilisateurs connectés.avec un message d'erreur personnalisé.
```php
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/avis/{id}',
            normalizationContext: ['groups' => ['avis:read']]),
        
        new GetCollection(
            uriTemplate: '/avis',
            normalizationContext: ['groups' => ['avis:read']],
            security: "is_granted('ROLE_ADMIN')",
            securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource"),

        new Post(
            uriTemplate: '/avis',
            denormalizationContext: ['groups' => ['avis:write']],
            security: "is_granted('ROLE_ADMIN')",
            securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource"),

        new Delete(
            uriTemplate: '/avis/{id}',
            security: "is_granted('ROLE_ADMIN')",
            securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource")
    ],
    normalizationContext: ['groups' => ['avis:read']],
    denormalizationContext: ['groups' => ['avis:write']]
)]
```
Puis j'ajoute le groupe de sérialisation `avis:read` et désérialisation `avis:write` dans les autres entités qui ont une relation avec l'entité `Avis` pour éviter les références circulaires et pour ne pas exposer toutes les données de l'entité.
J'en profite aussi pour personnaliser aussi les groupes de chaque entité

Exemple sur la classe Medecin.php :
```php
#[ApiResource(
    normalizationContext: ['groups' => ['medecin:read']],
    denormalizationContext: ['groups' => ['medecin:write']]
)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['medecin:read', 'medecin:write', 'avis:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['medecin:read', 'medecin:write', 'avis:read'])]
    private ?string $matricule = null;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(targetEntity: PlanningMedecin::class, mappedBy: 'medecin')]
    private Collection $planningMedecins;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpecialiteMedecin $specialite = null;
```
Idem pour les autres entités qui ont une relation avec l'entité `Avis`.

J'ajoute dans le fichier `security.yaml` (config/packages/security.yaml) l'autorisation à la route de l'API `apiMedecins/avis` provisoirement au role admin`- { path: ^/apiMedecin, roles: ROLE_ADMIN }`

Je fais un test dans via Postman de l'API pour voir si les données sont bien exposées en JSON en utilisant le verbe GET  et GET COLLECTION.

#### Méthode GET (retour via Postman)

`http://127.0.0.1:8000/apiMedecins/avis/3`

```php
{
    "@context": "/apiMedecins/contexts/Avis",
    "@id": "/apiMedecins/avis/3",
    "@type": "Avis",
    "libelle": "Eos sed voluptas ut aspernatur aut non.",
    "date": "2024-05-25T00:00:00+00:00",
    "description": "Id est iusto veniam assumenda ut est iusto. Occaecati iure alias aspernatur quia earum et. Qui at totam occaecati unde et reiciendis pariatur ipsum.",
    "medecin": {
        "@id": "/apiMedecins/medecins/67",
        "@type": "Medecin",
        "nom": "Laporte",
        "matricule": "97932691"
    }
}
```
#### Méthode GET COLLECTION (retour via Postman)

`http://127.0.0.1:8000/apiMedecins/avis/`

```php
{
    "@context": "/apiMedecins/contexts/Avis",
    "@id": "/apiMedecins/avis",
    "@type": "hydra:Collection",
    "hydra:totalItems": 16,
    "hydra:member": [
        {
            "@id": "/apiMedecins/avis/3",
            "@type": "Avis",
            "libelle": "Eos sed voluptas ut aspernatur aut non.",
            "date": "2024-05-25T00:00:00+00:00",
            "description": "Id est iusto veniam assumenda ut est iusto. Occaecati iure alias aspernatur quia earum et. Qui at totam occaecati unde et reiciendis pariatur ipsum.",
            "medecin": {
                "@id": "/apiMedecins/medecins/67",
                "@type": "Medecin",
                "nom": "Laporte",
                "matricule": "97932691"
            }
        },
        {
            "@id": "/apiMedecins/avis/4",
            "@type": "Avis",
            "libelle": "Aut sequi qui nam voluptate sit culpa numquam.",
            "date": "2024-05-17T00:00:00+00:00",
            "description": "In consequatur accusantium ducimus in. Id natus voluptates et expedita. Ipsam nostrum et veritatis expedita corrupti.",
            "medecin": {
                "@id": "/apiMedecins/medecins/63",
                "@type": "Medecin",
                "nom": "Perez",
                "matricule": "50971877"
            }
        }
        ...
```

Pour la méthode POST, j'utilise les iri des entités `Medecin`, `Utilisateur` et `Prescription` pour les associer à l'entité `Avis` dans le body de la requête.
Depuis Postman, je configure header pour que sa clé soit `Content-Type` et sa valeur `application/ld+json`

Je soumets la requête ci-dessous dans le Body en utilisant les iri pour les entités Medecin; Utilisateur et Préscription :

```php
{
  "libelle": "Test API",
  "date": "2024-05-15T14:28:46.849Z",
  "description": "TestPOST API",
  "medecin": "/apiMedecins/medecins/61",
  "utilisateur": "/apiMedecins/utilisateurs/123",
  "prescription": "/apiMedecins/prescriptions/11"
}
```
Si les informations ne s'affichent pas correctement et que le code est bon, il faut vider le cache de l'API avec la commande `php bin/console cache:clear` pour que les modifications soient prises en compte.

## Sécurité de l'API par authentification JWT

Pour l'application web j'utilise le système de sécurité de Symfony avec les rôles pour limiter l'accès à certaines routes.    
Je hash les mots de passe des utilisateurs avec l'algorithme par défaut pour sécuriser les mots de passe.

Pour l'API, j'utilise l'authentification JWT (JSON Web Token) pour sécuriser l'accès à l'API.

*https://api-platform.com/docs/core/jwt/#installing-lexikjwtauthenticationbundle*

```markdown
## ⚠️ Attention Important
Dans le fichier php.ini, décommenter l'extension sodium pour qu'elle soit active
"extension=sodium"
```

Installation du bundle `lexik/jwt-authentication-bundle` avec la commande :

`composer require lexik/jwt-authentication-bundle`

Avant de Créer une clé privée et publique pour l'API, il faut vérifier que OpenSSL est installé sur le serveur   
en utilisant cette commande :

`openssl version`

```markdown
## ⚠️ Attention Important
Pour un serveur Windows,

Si OpenSSL n'est pas installé ou s'il est dans une ancienne version (version actuelle 3.3.0), se rendre sur le site *https://www.openssl.org/source/* ou  *https://slproweb.com/products/Win32OpenSSL.html* pour télécharger et installer la dernière version d'OpenSSL.

Ajouter dans le variables d'environnements de Windows le chemin `C:\Program Files\OpenSSL-Win64\bin`
```
Création d'une clé privée et publique pour l'API avec la commande :

`symfony console lexik:jwt:generate-keypair`

un message validera la commande
`[OK] Done! `

Les clés seront créées dans le répertoire `config/jwt`. (Exclure du dépot git via le .gitignore)

Configuration du fichier `config/packages/security.yaml` pour l'authentification JWT en ajoutant dans `api` :

```php 
        api:
            pattern: ^/apiMedecins
            stateless: true
            provider: app_user_provider
            jwt: ~
```

Mettre à true `stateless: true` signifie que l'application est "SANS ETAT" donc l'application ne conserve pas de sessions pour l'authetification.
Il faut à chaque fois prouver dans l'entête que l'on est le bon utilisateur.

Cela est utile pour les API et les services où chaque requête doit être indépendante et contenir ses propres informations d'authentification.

Tous les firewalls dans un ordre précis, le firewall `main` a un motif `(pattern: ^/)` qui correspond à toutes les routes et est donc toujours utilisé, je mets `auth` au-dessus du firewall `main` pour qu'il soit pris en compte pour les routes commençant par /auth :

```php
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        auth:
            pattern: ^/auth
            stateless: true
            provider: app_user_provider
            json_login:
                check_path: /auth
                username_path: email
                password_path: password
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure
        api:
            pattern: ^/apiMedecins
            stateless: true
            provider: app_user_provider
            jwt: ~

        main:
            pattern: ^/
            form_login:
                # app_connexion est le nom de la route de mon contrôleur 'ConnexionController'.
                # Si je modifie la route dans mon contrôleur, je dois aussi la modifier ici.
                login_path: app_connexion
                check_path: app_connexion
            # Chemin de déconnexion de l'utilisateur (app_deconnexion définit dans ConnexionController.php
            logout:
                path: app_deconnexion
            lazy: true
            provider: app_user_provider
```

Ajout de la route `/auth` dans le fichier `config/routes.yaml` pour l'authentification JWT

```php
controllers:
    resource:
        path: ../src/Controller/
        namespace: App\Controller
    type: attribute
auth:
    path: /auth
    methods: ['POST']
```   

Le fichier `config/packages/lexik_jwt_authentication.yaml` est configuré automatiquement lors de l'installation pour l'authentification JWT

```php 
lexik_jwt_authentication:
    secret_key: '%env(resolve:JWT_SECRET_KEY)%'
    public_key: '%env(resolve:JWT_PUBLIC_KEY)%'
    pass_phrase: '%env(JWT_PASSPHRASE)%'
```    

Modification du fichier `/config/packages/api_platform.yaml` pour configurer l'authentification JWT pour l'API

```php 
api_platform:
    title: API SoigneMoi
    version: 1.0.0
    formats:
        jsonld: ['application/ld+json']
    docs_formats:
        jsonld: ['application/ld+json']
        jsonopenapi: ['application/vnd.openapi+json']
        html: ['text/html']
    defaults:
        stateless: true
        cache_headers:
            vary: ['Content-Type', 'Authorization', 'Origin']
        extra_properties:
            standard_put: true
            rfc_7807_compliant_errors: true
    keep_legacy_inflector: false
    use_symfony_listeners: true

    swagger:
        api_keys:
            JWT:
                name: Authorization
                type: header
``` 

Ajout dans le fichier security.yaml du firewall dédié à l'authetification JWT `auth`

```php
        auth:
            pattern: ^/auth
            stateless: true
            provider: app_user_provider
            json_login:
                check_path: /auth
                username_path: email
                password_path: password
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure
```

J'aurais pu gérer dans le même firewall que ^/apiMedecins mais pour plus de clarté j'ai séparé les deux.
```markdown
## ⚠️ Exemple de ce que pourrais donner les deux patterns dans le meme firewall
```
```php
        api:
            pattern: ^/(apiMedecins|auth)
            stateless: true
            provider: app_user_provider
            json_login:
                check_path: /auth
                username_path: email
                password_path: password
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure
            jwt: ~
```

Le fichier security.yaml en entier

```php
security:
    # https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords
    password_hashers:
        Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: 'auto'
    # https://symfony.com/doc/current/security.html#loading-the-user-the-user-provider
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\Utilisateur
                property: email
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            pattern: ^/
            form_login:
                # app_connexion est le nom de la route de mon contrôleur 'ConnexionController'.
                # Si je modifie la route dans mon contrôleur, je dois aussi la modifier ici.
                login_path: app_connexion
                check_path: app_connexion
            # Chemin de déconnexion de l'utilisateur (app_deconnexion définit dans ConnexionController.php
            logout:
                path: app_deconnexion
            lazy: true
            provider: app_user_provider

        auth:
            pattern: ^/auth
            stateless: true
            provider: app_user_provider
            json_login:
                check_path: /auth
                username_path: email
                password_path: password
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure
        api:
            pattern: ^/apiMedecins
            stateless: true
            provider: app_user_provider
            jwt: ~

    access_control:
        - { path: ^/apiMedecins, roles: ROLE_USER }
        - { path: ^/compte, roles: ROLE_USER }
        - { path: ^/admin, roles: ROLE_ADMIN }
        # Permet l'accès anonyme aux pages d'accueil et de connexion
        #- { path: ^/accueil, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        #- { path: ^/connexion, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        #- { path: ^/inscription, roles: IS_AUTHENTICATED_ANONYMOUSLY }

when@test:
    security:
        password_hashers:
            # By default, password hashers are resource intensive and take time. This is
            # important to generate secure password hashes. In tests however, secure hashes
            # are not important, waste resources and increase test times. The following
            # reduces the work factor to the lowest possible values.
            Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
                algorithm: auto
                cost: 4 # Lowest possible value for bcrypt
                time_cost: 3 # Lowest possible value for argon
                memory_cost: 10 # Lowest possible value for argon

```

Sur la page de la documentation de l'API (Pour ma part l'URI est configurée à /apiMedecins) une nouvelle section apparait en POST

![img.png](Readme/img.png)

Ce qui me permet de récupérer le token JWT pour l'authentification de l'API.
![img.png](Readme/Token.png)

Pour mes tests, je crée un firewall que je nomme api_public qui me permet d'y accéder sans être authentifié

```php
        # Temporaire pour les tests. Me permet de me connecter sans JWT à API Platform.
        api_public:
            pattern: ^/apiMedecins$
            security: false
        api:
            pattern: ^/apiMedecins
            stateless: true
            provider: app_user_provider
            jwt: ~
```

Maintenant je vais configurer les accès aux routes de l'API avec les rôles pour limiter l'accès à certaines routes.

```php
    access_control:
        - { path: ^/apiMedecins/, roles: ROLE_ADMIN }   # API avec accès administrateur (A changer - temporaire)
        - { path: ^/admin, roles: ROLE_ADMIN }          # Panneau d'aministration (admin et plus tard secretaires)
        - { path: ^/connexion, roles: PUBLIC_ACCESS }   # Page de connexion
        - { path: ^/apiMedecins, roles: PUBLIC_ACCESS } # APIs ouverte publique
        - { path: ^/auth, roles: PUBLIC_ACCESS }        # Appels relatifs à l'authentification (Login/logout)
        - { path: ^/$, roles: PUBLIC_ACCESS }           # Accueil
        - { path: ^/, roles: PUBLIC_ACCESS }            # Tous les autres chemins
```

## Frontend

#### Mise en place du Frontend (navbar et footer)

Pour le Frontend, j'utilise le moteur de template Twig de Symfony pour générer les pages HTML.

Je m'attaque tout d'abord à la page d'accueil en débutant par la "NavBar" et le "Footer" qui seront présents sur certaines pages du site.

Dans le fichier `base.html.twig`, je crée mes blocks pour la NavBar et le Footer. 

J'y ai intégré du HTML/CSS en utilisant Bootstrap et un fichier css personnel pour personnaliser au maximum.

J'utilise le CDN de Bootstrap pour les fichiers CSS et JS et celui de Font Awesome pour les icônes.
Pour le fichier perso CSS je place dans `assets/css/soigneMoi.css`.

```php
        {% block stylesheets %}
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('assets/css/soigneMoi.css') }}">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        {% endblock %}
```
Je crée ma navbar en utilisant les classes de Bootstrap et je la personnalise avec mon fichier CSS perso notamment au niveau des boutons.

Je conçois un menu burger pour les écrans mobiles en utilisant un exemple de navbar déjà tout fait dans la documentation de Bootstrap.

Dans cette Navbar j'utilise aussi des conditions TWIG pour rendre dynamique l'affichage en fonction que l'utilisateur soit connecté ou non.

```php
{% block navbar %}
            <!-- DEBUT : NAVBAR -->
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid d-flex justify-content-between">
                        <!-- LOGO -->
                        <a class="navbar-brand" href="{{ path('app_accueil') }}">
                            <img src="{{ asset('assets/images/soignemoi-logo.png') }}" alt="Logo" width="80" height="60" class="bi bi-heart-fill" />
                        </a>
                        <!-- BOUTON BURGER -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Déclencher la navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- MENU -->
                        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                            <ul class="navbar-nav text-center">
                                <li class="nav-item">
                                    <a class="nav-link ybMenu-bold" aria-current="page" href="{{ path('app_accueil') }}">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link ybMenu-bold" href="{{ path('app_accueil') }}">Nous contacter</a>
                                </li>

                                <!-- VUE MOBILE DANS LE MENU BURGER -->
                                <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR EST CONNECTE-->
                                {% if app.user %}
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_compte') }}"><button class="btn btn-primary mt-3" type="submit">Mon compte</button></a>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_deconnexion') }}"><button class="btn btn-primary mt-3" type="submit">Se déconnecter</button></a>
                                </li>
                                <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR N'EST PAS CONNECTE-->
                                {% else %}
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_connexion') }}"><button class="btn btn-primary mt-3" type="submit">Se connecter</button></a>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <a href="{{ path('app_inscription') }}"><button class="btn btn-primary mt-3" type="submit">S'inscrire</button></a>
                                </li>
                                {% endif %}
                            </ul>
                        </div>
                        <!-- VUE DESKTOP EN DEHORS DU MENU BURGER -->
                        <div class="d-none d-lg-block">
                            <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR EST CONNECTE-->
                            {% if app.user %}
                                <a href="{{ path('app_compte') }}"><button class="btn btn-primary" type="submit">Mon compte</button></a>
                                <a href="{{ path('app_deconnexion') }}"><button class="btn btn-primary" type="submit">Se déconnecter</button></a>
                            <!-- BOUTONS DE INTERFACE QUAND L'UTILISATEUR N'EST PAS CONNECTE-->
                            {% else %}
                                <a href="{{ path('app_connexion') }}"><button class="ybButton" type="submit"><i class="fas fa-user"></i>Se connecter</button></a>
                                <a href="{{ path('app_inscription') }}"><button class="ybButton" type="submit"><i class="fas fa-user"></i>S'inscrire</button></a>
                            {% endif %}

                        </div>
                    </div>
                </nav>
                <!-- FIN : NAVBAR -->
        {% endblock %}
```
Pour le footer, j'essaie de respecter au maximum le design de la maquette en utilisant les classes personnelles avec mon fichier CSS perso.

Je crée un footer qui comporte trois colonnes principales dans la section supérieure, où sont disposé le logo, les liens de services santé et les réseaux sociaux. 

Dans la section inférieure, il y a une autre ligne avec trois colonnes pour les mentions légales, les conditions générales d'utilisation et les données personnelles.

```php
        <!-- FOOTER -->
        {% block footer %}
            <footer class="ybFooter text-white text-center text-lg-start">
                <div class="ybContainer p-4 d-flex justify-content-between align-items-center">
                    <!-- LOGO -->
                    <div class="ybLogoContainer">
                        <a href="{{ path('app_accueil') }}">
                            <img src="{{ asset('assets/images/soignemoi-logo.png') }}" alt="Logo" class="img-fluid ybLogoFooter">
                        </a>
                    </div>
                    <!-- LIENS -->
                    <div class="ybServicesContainer text-center">
                        <h5 class="text-uppercase">SERVICES SANTÉ</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ path('app_accueil') }}" class="text-white text-decoration-none">Accueil</a></li>
                            <li><a href="{{ path('app_connexion') }}" class="text-white text-decoration-none">Me connecter</a></li>
                            <li><a href="{{ path('app_inscription') }}" class="text-white text-decoration-none">Créer un compte</a></li>
                        </ul>
                    </div>
                    <!-- RESEAUX SOCIAUX -->
                    <div class="ybSocialContainer text-right">
                        <h5 class="text-uppercase">NOUS SUIVRE</h5>
                        <a href="#" class="text-white me-4 ybSocialIcon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white me-4 ybSocialIcon">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-white me-4 ybSocialIcon">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="text-white me-4 ybSocialIcon">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
                <!-- MENTIONS LEGALES -->
                <div class="text-center p-3 ybFooterBottom">
                    <div class="ybContainer">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="text-white text-decoration-none">Mentions légales</a>
                            </div>
                            <div class="col">
                                <a href="#" class="text-white text-decoration-none">Conditions générales d'utilisation</a>
                            </div>
                            <div class="col">
                                <a href="#" class="text-white text-decoration-none">Données personnelles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        {% endblock %}
```
Je crée enfin le body de la page d'accueil en commencent pas le Hero qui est la première section de la page d'accueil.

La section Hero aura une image de fond, un titre et un sous-titre. 

J'utilise des classes de Bootstrap pour le positionnement des éléments.

```php

{% block body %}
    <div class="ybHeader">
        <div class="ybHeaderFond"></div>
        <div class="ybHeaderImage"></div>
        <div class="ybTexteHeader">
            <h1>SoigneMoi, l'excellence au <br> service de votre bien-être.</h1>
            <p>J’ai besoin de :</p>
        </div>
        <div class="ybBouton" style="left: 97px; top: 449px;">

            <span class="ybTexteBouton">A Propos</span>
        </div>
        <div class="ybBouton" style="left: 530px; top: 449px;">

            <span class="ybTexteBouton">Nous suivre</span>
        </div>
        <div class="ybBouton" style="left: 97px; top: 566px;">

            <span class="ybTexteBouton">Prendre un rendez-vous</span>
        </div>
        <div class="ybBouton" style="left: 530px; top: 566px;">

            <span class="ybTexteBouton">Trouver un praticien</span>
        </div>
    </div>

{% endblock %}
```

Et mon fichier perso CSS `soigneMoi.css` pour personnaliser les éléments de la section Hero.

```php
/***** DEBUT:ACCUEIL:HERO *****/
.ybHeader {
    position: relative;
    width: 100%;
    height: 786px;
    overflow: hidden;
}

.ybHeaderFond {
    box-sizing: border-box;
    position: absolute;
    width: 70%;
    height: 100%;
    top: 0;
    left: 0;
    background: linear-gradient(248.61deg, #003366 12.13%, #0066CC 43.23%);
    border-bottom: 4px solid #000000;
    box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 0px 0px 500px 0px;
    z-index: 1;
}

.ybHeaderImage {
    box-sizing: border-box;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: url('../images/Hero.png') no-repeat center center;
    background-size: cover;
    z-index: 0;
}

.ybTexteHeader {
    position: relative;
    z-index: 2;
    color: #FFFFFF;
    margin: 0 5%;
    top: 20%;
}

.ybTexteHeader h1 {
    font-weight: 700;
    font-size: 3rem;
    line-height: 1.2;
    margin: 0;
}

.ybTexteHeader p {
    font-weight: 400;
    font-size: 1.25rem;
    line-height: 1.4;
    margin: 10px 0 0;
}

.ybBouton {
    position: absolute;
    width: calc(100% - 20%);
    max-width: 407px;
    height: 72px;
    background-color: rgba(255, 255, 255, 0.8);
    border: 2px solid #003366;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 23px;
    display: flex;
    align-items: center;
    padding: 4px 24px;
    z-index: 2;
    left: 5%;
}

.ybTexteBouton {
    font-weight: 700;
    font-size: 1.5rem;
    color: #003366;
    margin: 0;
}

.ybLogoBouton {
    width: 40px;
    height: 40px;
    position: relative;
    margin-right: 10px;
}

.ybCercle {
    position: absolute;
    width: 40px;
    height: 40px;
    background: #003366;
    border: 1px solid #000000;
}

.ybFleche {
    position: absolute;
    width: 16px;
    height: 0;
    left: 12px;
    top: 20px;
    border: 2px solid #FFFFFF;
}
/***** FIN:ACCUEIL:HERO *****/
```

Dans mon fichier personnel CSS, je crée aussi des variables, ce qui me permet de changer les couleurs et les tailles de police plus facilement.

```php
/***** DEBUT:VARIABLES ******/
:root {
    --ybTitre-couleur: #003366;
    --ybFontSize16: 16;
    --ybFontSize24: 24;
    --ybBoxShadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
}
/***** FIN:VARIABLES ******/
```

Ajout de la section presentation de l'accueil en utilisant les classes bootstrap pour créer les cards : 

```php
{# DEBUT:ACCUEIL:PRESENTATION #}
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p>Chez SoigneMoi, nous avons inscrit la prévention au  cœur de nos actions et élargi notre offre de soins en apportant des  solutions toujours plus innovantes.
                    Conçue pour s’adapter aux nouveaux  comportements des patients et des citoyens,SoigneMoi est une plateforme digitale de services destinée à améliorer
                    l’accès aux soins, la santé et le bien-être.  À la maison comme en établissement de santé, Ramsay Services vous guide  pas à pas dans vos démarches, vous
                    informe en toute transparence sur  les étapes à venir, et vous accompagne à travers de multiples services pour vous apporter confort et tranquillité,
                    et préserver votre santé et votre bien-être au quotidien.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/images/PRESENTATION-image.png') }}" alt="Image d'un bloc opératoire" class="img-fluid">
            </div>
        </div>
    </div>
    {# FIN:ACCUEIL:PRESENTATION #}
```

et le carousel:

```php
    {# DEBUT:ACCUEIL:CAROUSEL #}
    <div class="container my-5">
        <div class="row align-items-start">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-01.png') }}" alt="First slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-02.png') }}" alt="First slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-03.png') }}" alt="First slide">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-03.png') }}" alt="Second slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-02.png') }}" alt="Second slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-01.png') }}" alt="Second slide">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-02.png') }}" alt="Third slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-03.png') }}" alt="Third slide">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <img class="d-block w-100" src="{{ asset('assets/images/CAROUSEL-image-01.png') }}" alt="Third slide">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {# FIN:ACCUEIL:CAROUSEL #}
```

J'ajoute ensuite les différentes sections que compose la page d'accueil en respectant le design de la maquette.

```php
{# DEBUT:ACCUEIL:BANDEAU:PUB #}
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h3 class="text-center fw-bold"><span class="ybCard-titre mt-5">Etre à vos cotés </span>pour votre santé c'est...</h3>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('assets/images/BANDEAU-image-01.png') }}" alt="Image d'une croix" class="img-fluid mx-auto d-block mt-5">
            </div>
            <div class="col-md-4">
                <p class="text-left mt-5">
                    Des expertises médicales à portée de main
                    Bénéficiez de services accessibles
                    en ligne, depuis votre smartphone
                    ou ordinateur.</p>
            </div>
        </div>
    </div>
    {# FIN:ACCUEIL:BANDEAU:PUB #}

    {# DEBUT:ACCUEIL:NEWSLETTER #}
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="card mb-5 h-100 d-flex flex-column justify-content-between ybCard-image mt-5">
                    <div class="card-body">
                        <h4 class="card-title text-left fw-bold mb-5">Restez informé sur les nouveautés de SoigneMoi Services</h4>
                        <p class="card-text text-left mb-5">
                            Suspendisse venenatis a ex eget lacinia. Sed
                            ultricies quis magna sit amet laoreet.
                            In congue rutrum nibh id pretium.
                            Vivamus rutrum sit amet velit nec ultrices.
                            Suspendisse venenatis a ex eget lacinia. Sed
                            ultricies quis magna sit amet laoreet.
                            In congue rutrum nibh id pretium.
                            Vivamus rutrum sit amet velit nec ultrices
                        </p>
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ path('app_inscription') }}">
                            <button class="ybButton w-50 mt-5" type="submit">
                                <i class="fas fa-user"></i> S'inscrire
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-5"></div>
            <div class="col-md-4 mb-5">
                <img src="{{ asset('assets/images/NEWSLETTER-image-01.png') }}" alt="Image d'une croix" class="img-fluid mx-auto d-block h-100 ybCard-image">
            </div>
        </div>
    </div>

    {# FIN:ACCUEIL:NEWSLETTER #}
```
Sur le même principe je modifie les pages de connexion et d'inscription en utilisant les classes de Bootstrap et personnelles pour le design en respectant la maquette. 

Pour la page des rendez-vous, je crée, pour l'entité `Medecin`, un champ `photo` (avec ses setter et getter) pour associer une photo à chaque médecin.

```php
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;
    
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
```

Ensuite, pour que les secrétaires puissent ajouter, lors de la création d'un médecin, une photo, je modifie mon CRUD Controller pour ajouter un `ImageField` dans le formulaire de création avec une création de noms aléatoire pour éviter de se retrouver avec plusieurs photos dont le nom serait le même.

```php
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prénom'),
            ImageField::new('photo', 'Photo')
                ->setBasePath('assets/photos/')
                ->setUploadDir('public/assets/photos/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('specialite', 'Spécialité'),
            TextField::new('matricule', 'Matricule'),
        ];
    }
```

Je modifie aussi mes "Fixture" en y ajoutant les photos `$medecin->setPhoto($faker->image('public/assets/photos', 320, 320, null, false));`

J'ajoute aussi une fonctionnalité, qui me permet avant chaque création de photos par les fixtures, de supprimer les photos déjà existantes pour éviter de se retrouver avec des photos en double.

```php
    // Suppression des images existantes
        $uploadImages = glob('public/assets/photos/*');
        foreach ($uploadImages as $uploadImage) {
            if (is_file($uploadImage)) {
                unlink($uploadImage);
            }
        }
```

Pour finir, je modifie la vue pour ajouter la photo qui correspond au médecin (qui est défini dans la logique du contrôleur des rendez-vous) :

```php
{% block stylesheets %}{% endblock %}
{% block javascripts %}{% endblock %}

<div class="card mb-3 text-left ybRDV-Cards" style="max-width: 18rem;">
    <div class="card-header bg-white text-dark">
        <div class="d-flex align-items-center">
                <img src="/assets/photos/{{ rdv.medecin.photo }}" alt="Photo du praticien" class="rounded-circle" style="width: 50px; height: 50px;">
            <div>
                <p class="card-text mb-0 mx-lg-3">Praticien : {{ rdv.medecin }}</p>
                <p class="card-text mx-lg-3">Spécialité : {{ rdv.medecin.specialite }}</p>
            </div>
        </div>
    </div>
    <div class="card-body text-center bg-primary text-white rounded-bottom-corners ybRDV-Cards">
        <h5 class="card-title">
            <i class="fas fa-calendar-alt"></i> {{ rdv.date|date('d/m/Y') }} <i class="fas fa-clock"></i> {{ rdv.date|date('H:i') }}
        </h5>
        <a href="{{ path('app_rendez-vous_supprimer', {'id': rdv.id}) }}" class="btn btn-danger">Annuler</a>
    </div>
</div>
```

Je crée une fiche de détails des rendez-vous lié à l'id du médecin en ajoutant un contrôleur `RendezVousFicheController.php` : 

```php
<?php

namespace App\Controller\RendezVous;

use App\Entity\RendezVousUtilisateur;
use App\Repository\MedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RendezVousFicheController extends AbstractController
{
    #[Route('/rendez_vous/fiche/{id}', name: 'app_rendez_vous_fiche')]
    public function index($id, EntityManagerInterface $entityManager, MedecinRepository $medecinRepository, ): Response
    {
        // Je récupère le rendez-vous en utilisant son ID
        $rdv = $entityManager->getRepository(RendezVousUtilisateur::class)->find($id);
        // Si le rendez-vous n'existe pas, j'envoie un message flash puis redirection vers la liste des rendez-vous
        if (!$rdv) {
            $this->addFlash('danger', 'Rendez-vous non trouvé.');
            return $this->redirectToRoute('app_rendez-vous');
        }

        return $this->render('rendez_vous/FicheRendezVous.html.twig', [
            'rdv' => $rdv,
        ]);
    }
}


```
et sa vue associée `FicheRendezVous.html.twig` :

```php
    <div class="container my-5 text-center">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                <h1 class="mb-5">Détail de votre rendez-vous</h1>

                <div class="card mb-3 text-left ybRDV-Cards mx-auto" style="max-width: 35rem;">
                            <div class="card-header bg-white text-dark">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="/assets/photos/{{ rdv.medecin.photo }}" alt="Photo du praticien" class="rounded-circle" style="width: 120px; height: 120px;">
                                    <div>
                                        <p class="card-text mb-0 mx-lg-3">Praticien : {{ rdv.medecin }}</p>
                                        <p class="card-text mx-lg-3">Spécialité : {{ rdv.medecin.specialite }}</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body text-white rounded-bottom-corners ybRDV-Cards">
                                <h5 class="card-title">
                                    <i class="fas fa-calendar-alt"></i> {{ rdv.date|date('d/m/Y') }} <i class="fas fa-clock"></i> {{ rdv.date|date('H:i') }}
                                </h5>
                                <a href="{{ path('app_rendez-vous_supprimer', {'id': rdv.id}) }}" class="btn btn-danger">Annuler</a>
                            </div>
                        </div>
                <div class="card mb-3 mx-auto" style="max-width: 35rem;">
                        <div class="card-body">
                            <h5 class="card-title">Patient</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ rdv.utilisateur.nom ~ ' ' ~ rdv.utilisateur.prenom }}</h6>
                        </div>
                    </div>
                <div class="card mb-3 mx-auto" style="max-width: 35rem;">
                        <div class="card-body">
                            <h5 class="card-title">Téléphone du lieu de consultation</h5>
                            <h6 class="card-subtitle mb-2 text-muted">01.02.03.04.05</h6>
                        </div>
                    </div>
                <div class="card mx-auto" style="max-width: 35rem;">
                        <div class="card-body">
                            <h5 class="card-title">Adresse du lieu de consultation</h5>
                            <h6 class="card-subtitle mb-2 text-muted">1, rue de la recherche</h6>
                            <h6 class="card-subtitle mb-2 text-muted">78150 Versailles</h6>
                        </div>
                    </div>
                    </div>


                <div class="col-12 col-md-4 d-none d-md-block">
                    <img src="{{ asset('assets/images/INSCRIPTION-image-01.png') }}" alt="Image droite du formulaire d'inscription" class="img-fluid mt-4" style="height: 770px;">
                </div>
            </div>
        </div>
```

# Sécurisation, déploiement et installation du serveur

## Nom de domaine

Achat du nom de domaine neoliaweb.fr chez **OVH**.

Création d'un sous-domaine `soignemoi` du nom de domaine `neoliaweb` et du **TLD** (*Top Level Domain*) `.fr`. 

Le **FQDN** (*Fully Qualified Domain Name*) sera `https://soignemoi.neoliaweb.fr` avec redirection **DNS** (*Domain Name Server*) en ajoutant en entrée le champs de pointage **A** du sous-domaine `soignemoi` vers l'**IP** du serveur **VPS**.

Le **FQDN** du projet sera : https://soignemoi.neoliaweb.fr 

## VPS

Achat du **VPS** (Virtual Private Server) chez **OVH**.

Installation de **Debian** en version 12.

## SSH

Génération d'une clé **SSH** pour le serveur VPS avec PuTTY Generator en utilisant l'algorithme de chiffrement asymétrique RSA (*Rivest-Shamir-Adleman*) et 4096 comme nombre de bits.

Connexion au serveur avec les identifiants fourni par **OVH**. 

## Sécurisation du serveur VPS

Depuis l'interface d'administration OVH, je configure le certificat **SSL/TLS** (*https*) pour le domaine neoliaweb.fr. 

Accès en **SSH** (Secure SHell) via **PuTTY** au **VPS** pour configurer les comptes et l'installation des composants nécessaires pour faire fonctionner le site web avec **Symfony**.

en premier lieu je procède à : 
- Modification du mot de passe d'origine avec la commande : 
	- `passwd`
- Mise à jour de la liste des dépôts avec la commande : 
	- `sudo apt-get update`
- Mise à jour des paquets avec la commande : 
	- `sudo apt-get upgrade`
- Ainsi que la mise à jour de la distribution Linux avec la commande : 
	- `sudo apt-get dist-upgrade`
- Modification du port d'écoute **SSH** par défaut (*port 22*) avec l’éditeur de texte **nano** : 
	- `sudo nano /etc/ssh/sshd_config`

Rechercher (*`CTRL + W` pour rechercher `#Port 22` - `#` annonce un commentaire*) et modifier le port.

Je redémarre ensuite le deamon ssh : 
- `sudo service ssh restart`

Modification des droits de utilisateur par défaut (*désactivation du SSH pour cet utilisateur qui a des droits root par défaut*) (*l'utilisateur root est désactivé par défaut chez OVH*) et création d'un utilisateur qui pourra se connecter en **SSH** et utiliser `su` (*subtitute user*) pour avoir des droits `root`

Je commence par créer un utilisateur avec la commande `sudo adduser nom_de_l_utilisateur` puis répondre aux questions qui suivent.

Je teste la connexion **SSH** avec ce nouvel utilisateur.
- `nom_de_l_utilisateur@ip/domaine_du_serveur_SSH -p le_port_SSH`

Je me reconnecte une nouvelle fois avec l'utilisateur par défaut avec les droits root pour désactiver son accès **SSH** dans le fichier de configuration

- `sudo nano /etc/ssh/sshd_config`

Faire la recherche de la ligne `#PermitRootLogin prohibit-password`, la dé commenter et modifier en mettant `no` pour empêcher que l'utilisateur `root` puisse se connecter en **SSH**:

- `PermitRootLogin no`

Je redémarre ensuite le **deamon ssh** : 

- `sudo service ssh restart`

Désactivation de l'accès **SSH** de l'utilisateur par défaut crée par **OVH** 

- `sudo nano /etc/ssh/sshd_config`

Et placer `DenyUsers nom_de_l_utilisateur_a_desactiver`, par exemple au dessus de la ligne de configuration du port.

Je sauvegarde et je redémarre le **deamon ssh**

Je me déconnecte et me reconnecte avec le nouvel utilisateur.
Je teste ensuite mon accès en **root** depuis mon utilisateur nouvellement crée :

- `su utilsateur_avec_droit_root`

Je vais Installer le paquet **Fail2ban**, pour éviter les `brut force` sur le *login/mot de passe* (*nombre de tentatives anormales d'échecs*) d'un utilisateur et bannira les adresses IP du/des attaquants.

Installation du paquet :

- `sudo apt-get install fail2ban`

Modification du fichier `jail.conf` (p*ar défaut la configuration de base est très bien*) :

- `nano /etc/fail2ban/jail.conf`

Mettre le `bantime` à `1h`, `maxretry` à `5` et `findtime` à `5m`,  si une mauvaise tentative d'accès est faite 5 fois pendant les 5 prochaines minutes un bannissement d'une heure sera effectué pour l'adresse IP de l'attaquant.

Les logs du serveur sont consultables `/var/logs`

## Installation des dépendances

- **Apache2** (*Serveur Web*)
- **MySQL** (*Base de données*)
- **PHP** (*Langage de programmation*)
- **GIT** (*Gestion de versions décentralisé*)

#### Installation Apache2

- `sudo apt install apache2 libapache2-mod-php`

Configuration au démarrage du serveur pour que Apache2 soit démarré :

- `sudo systemctl enable apache2`

Activation des modules avec `a2enmod` : 

- `rewrite` *Faire des URLs propres, réécriture d'URLs*,  

- `headers` *supporte les entête du site afin, par exemple fonctionnalités de cache, optimisation du chargement de page...*

- `expires` qui permet d'indiquer un délai d'expiration des pages dans le navigateur des utilisateurs

Activation : 
- `sudo a2enmod rewrite`
- `sudo a2enmod headers`
- `sudo a2enmod expires`

Puis redémarrer le service Apache :

- `sudo systemctl restart apache2`

#### Configuration Apache2

Vérification de la création du fichier de configuration `000-default.conf` dans `/etc/apache2/sites-available` qui permet de créer des `virtual hosts` (*sites Internet virtuels différents*)

Extrait du fichier `000-default.conf` qui écoute tout ce qui passe par le port 80 (*http*) (*pour l'écoute https ce sera le port 443*) et redirige vers le `DocumentRoot` le contenu de `/var/www/html`  ou se trouve `index.html` qui est la page créée par Apache lors de son installation pour vérifier le bon fonctionnement.
```
<VirtualHost *:80>
        
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html
        
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
       
</VirtualHost>
```
#### Installation de MySQL

MySQL n'étant pas de base dans la bibliothèque de paquets de Debian, je dois déclarer la source de la dépendance à la main.

Installation pour le chiffrage des données avec le paquet `gnupg` (*GNU Privacy Guard*)

- `sudo apt install gnupg` 

Installation de la dépendance **MySQL** 

Tout d'abord je me rends https://dev.mysql.com/downloads/repo/apt/ pour récupérer l'adresse de téléchargement du paquet en cliquant  sur **Download** 

puis en copiant l'adresse du lien (*Clic droit sur le lien / Copier le lien*) `No thanks, just start my download` -> https://dev.mysql.com/get/mysql-apt-config_0.8.30-1_all.deb que je pourrais ensuite coller dans **PuTTY** et télécharger le paquet pour le stocker dans un dossier temporaire `/tmp` avec `wget`

- `cd /tmp`
- `sudo wget https://dev.mysql.com/get/mysql-apt-config_0.8.30-1_all.deb` 

"*Dépackager / décompresser*" le paquet avec l'option `-i` (*pour installation*)  en utilisant `dpkg` (Intégrera ensuite dans la liste des paquets Debian) 

- `sudo dpkg -i mysql-apt-config_0.8.30-1_all.deb`

Répondre aux questions en laissant par défaut.

Mettre à jour la liste des paquets

- `sudo apt-get update`

Installation avec `apt` du serveur **MySQL**

- `sudo apt install mysql-server`

Répondre aux questions (*Mot de passe, Encryptage du mot de passe*)

Vérification de la bonne installation de **MySQL**

- `sudo systemctl status mysql`

En vérifiant que le service soit actif 

```
● mysql.service - MySQL Community Server
     Loaded: loaded (/lib/systemd/system/mysql.service; enabled; preset: enabled)
     Active: active (running) since Fri 2024-06-07 07:40:06 UTC; 24s ago
       Docs: man:mysqld(8)
             http://dev.mysql.com/doc/refman/en/using-systemd.html
   Main PID: 12361 (mysqld)
     Status: "Server is operational"
      Tasks: 36 (limit: 2295)
     Memory: 435.5M
        CPU: 1.316s
     CGroup: /system.slice/mysql.service
             └─12361 /usr/sbin/mysqld

Jun 07 07:40:05 vps-118b4dcc systemd[1]: Starting mysql.service - MySQL Community Server...
Jun 07 07:40:06 vps-118b4dcc systemd[1]: Started mysql.service - MySQL Community Server.
```
#### Configuration de MySQL

Sécurisation de l'installation (*Entrer le mot de passe de la base de données inscrit plus haut*)

- `mysql_secure_installation`

Répondre aux questions 

```
Securing the MySQL server deployment.

Enter password for user root:

VALIDATE PASSWORD COMPONENT can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD component?

Press y|Y for Yes, any other key for No: Y

There are three levels of password validation policy:

LOW    Length >= 8
MEDIUM Length >= 8, numeric, mixed case, and special characters
STRONG Length >= 8, numeric, mixed case, special characters and dictionary                  file

Please enter 0 = LOW, 1 = MEDIUM and 2 = STRONG: 2
Using existing password for root.

Estimated strength of the password: 100
Change the password for root ? ((Press y|Y for Yes, any other key for No) : N

 ... skipping.
By default, a MySQL installation has an anonymous user,
allowing anyone to log into MySQL without having to have
a user account created for them. This is intended only for
testing, and to make the installation go a bit smoother.
You should remove them before moving into a production
environment.

Remove anonymous users? (Press y|Y for Yes, any other key for No) : Y
Success.

Normally, root should only be allowed to connect from
'localhost'. This ensures that someone cannot guess at
the root password from the network.

Disallow root login remotely? (Press y|Y for Yes, any other key for No) : Y
Success.

By default, MySQL comes with a database named 'test' that
anyone can access. This is also intended only for testing,
and should be removed before moving into a production
environment.


Remove test database and access to it? (Press y|Y for Yes, any other key for No) : Y
 - Dropping test database...
Success.

 - Removing privileges on test database...
Success.

Reloading the privilege tables will ensure that all changes
made so far will take effect immediately.

Reload privilege tables now? (Press y|Y for Yes, any other key for No) : Y
Success.

All done!
```
Connexion à **MySQL** pour vérification

```
mysqladmin -u root -p version

Enter password:

mysqladmin  Ver 8.4.0 for Linux on x86_64 (MySQL Community Server - GPL)
Copyright (c) 2000, 2024, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Server version          8.4.0
Protocol version        10
Connection              Localhost via UNIX socket
UNIX socket             /var/run/mysqld/mysqld.sock
Uptime:                 12 min 8 sec

Threads: 2  Questions: 18  Slow queries: 0  Opens: 151  Flush tables: 3  Open tables: 70  Queries per second avg: 0.024
```
#### Installation de PHP




