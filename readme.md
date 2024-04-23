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
```bash  
  symfony new SoigneMoi --version="7.0.*" --webapp 
```  
Installation des Dépendances avec **Composer** :
```bash  
  cd SoigneMoi composer install 
```  
## Modification du ficher .env pour connecter la base de données
```bash  
DATABASE_URL="mysql://root@127.0.0.1:3306/soignemoi?serverVersion=8.0.32&charset=utf8mb4"  
```  
## Création de la base de données
```bash  
symfony console doctrine:database:create
```  
## Création des Entités  
  
#### Entité Utilisateur (sécurisé)  
  
```bash  
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
```bash 
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
```bash symfony console make:entity```
#### Exemple  pour Sejour et Utilisateur:
```bash 
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
```bash  
symfony console make:migration
```  
#### Exécution de la migration  
```bash  
symfony console doctrine:migrations:migrate
```  
## Création du contrôleur d'inscription des utilisateurs (patients)  
```bash  
symfony console make:controller  
Choose a name for your controller class (e.g. OrangeChefController):  
 > InscriptionController  
 created: src/Controller/InscriptionController.php  created: templates/inscription/index.html.twig  
  Success! 
```
## Création du formulaire des utilisateurs (patients)  
#### Formulaire de création de comptes pour les utilisateurs  
```bash  
symfony console make:form  
The name of the form class (e.g. GentlePuppyType):  
 > InscriptionUtilisateurType  
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):  
 > UtilisateurUtilisateur  
  
 created: src/Form/InscriptionUtilisateurType.php  Success! 
 ```  
#### Lier le contrôleur `InscriptionController`au  formulaire `InscriptionUtilisateurType`  
```bash  
$utilisateur = new Utilisateur(); $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);    
 return $this->render('inscription/index.html.twig', [    
    'titre_inscription' => 'Inscription',    
    'formulaireUtilisateurs' => $form->createView(),  
```  
Pour utiliser **Bootstrap** pour l'affichage graphique des formulaires, modifier le fichier ```config/packages/twig.yaml```  
et ajouter :
```bash  
twig:     
  form_themes: ['bootstrap_5_layout.html.twig']
```  
#### Création du formulaire (Exemple du formulaire d'inscription)  
```bash  
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
```bash  
{{ form_start(formulaireUtilisateurs) }} {{ form_row(formulaireUtilisateurs.nom) }} {{ form_row(formulaireUtilisateurs.prenom) }} {{ form_row(formulaireUtilisateurs.adresse_postale) }} {{ form_row(formulaireUtilisateurs.email) }} {{ form_row(formulaireUtilisateurs.password) }} {{ form_row(formulaireUtilisateurs.submit) }} {{ form_end(formulaireUtilisateurs) }}  
```  
## Enregistrement du formulaire des utilisateurs (patients) en base de données
Depuis le contrôleur InscriptionController.php,  ne pas oublier les injections de dépendances dans la fonction  
`Request $request, EntityManagerInterface $entityManager`

- Soumission, Enregistrement et Envoi des données du formulaire en base de données
```bash  
if ($form->isSubmitted() && $form->isValid()){    
    // persister les données dans la table utilisateur    
  $entityManager->persist($utilisateur);    
    // exécuter la requête    
$entityManager->flush(); }  
```  
Exemple complet:
```bash  
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
```bash  
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
```bash  
framework:    
    default_locale: fr translator:    
        default_path: '%kernel.project_dir%/translations' fallbacks:    
            - fr providers: 
```  
## Utilisation des contraintes (email unique, mot de passe complexe, etc...) avec le composant `validator` de Symfony 7
*https://symfony.com/doc/current/validation.html#constraints*

Dans le formulaire `InscriptionUtilisateurType.php` ajout de contraintes `use Symfony\Component\Validator\Constraints\Length;`

Pour le mot de passe :
```bash 
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
```bash 
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
```bash 
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
```bash 
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
```bash 
symfony console make:controller

Choose a name for your controller class (e.g. GentlePizzaController):
 > Connexion          

 created: src/Controller/ConnexionController.php
 created: templates/connexion/index.html.twig

           
  Success!
```
Activation du `FormLoginAuthenticator` en ajoutant la clé du tableau `form_login`  dans `config/packages/security.yaml`
```bash
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
```bash
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
```bash
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
```bash
symfony console make:controller

 Choose a name for your controller class (e.g. GentlePizzaController):
 > CompteController

 created: src/Controller/CompteController.php
 created: templates/compte/index.html.twig

  Success! 
```
Modification de la vue `compte\index.html.twig` en utilisant une condition si l'utilisateur est connecté ou non
```bash
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
```bash
{# Redirection de l'utilisateur vers sont espace membre #}  
<input type="hidden" name="_target_path" value="{{ path('app_compte') }}">
```
## Création du chemin de déconnexion utilisateur `Logging Out`

*https://symfony.com/doc/current/security.html#logging-out*
Modification du `config/packages/security.yaml` en y ajoutant la route pour la déconnexion
```bash
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
```bash
#[Route('/deconnexion', name: 'app_deconnexion', methods: ['GET'])]
    public function deconnexion() : never
    {
        // Cette méthode peut rester vide, elle ne sera jamais exécutée
    }
```
Modification du `config/packages/security.yaml` pour empêcher l'accès à la route `/compte` si l'utilisateur n'est pas connecté (dans ce cas, il sera redirigé vers la page de connexion)
```bash
    access_control:
        - { path: ^/compte, roles: ROLE_USER }
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }
```

Modification dans le `base.html.twig`avec condition si l'utilisateur est connecté ou non
```bash
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

```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash
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
```bash  
symfony console make:test
```
```bash  
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
```bash
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
```bash
PHPUnit 9.6.18 by Sebastian Bergmann and contributors.

Testing
.                                                                   1 / 1 (100%)

Time: 00:00.023, Memory: 6.00 MB

OK (1 test, 1 assertion)
```
#### Création d'un test fonctionnel pour le formulaire d'inscription:
Exécution de la commande pour lancer l’assistant de création de test:
```bash  
symfony console make:test
```
Dans la liste je choisis ``WebTestCase`` qui correspond à un comportement qu'un navigateur web peut avoir (*sauf qu'il n’exécute pas je JavaScript*) puis via l'assistant je crée la classe `FormulaireInscriptionUtilisateurTest.php` dans `tests`:
```bash  
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

```bash 
symfony console doctrine:database:create --env=test

Created database `soignemoi_test` for connection named default
```

Ajout des tables qui se trouvent dans la base de données de production avec les flags `-n` (non interactif) et `--env=test`: 
```bash
symfony console doctrine:migrations:migrate -n --env=test
```

Exemple de test unitaire pour le formulaire d'inscription `FormulaireInscriptionUtilisateurTest.php`:
```bash
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
```bash
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
```bash
composer require easycorp/easyadmin-bundle
```
Création du premier tableau de bord avec la commande :
`symfony console make:admin:dashboard`

```bash
 Which class name do you prefer for your Dashboard controller? [DashboardController]:
 > DashboardController

 In which directory of your project do you want to generate "DashboardController"? [src/Controller/Admin/]:
 > src/Controller/Admin/


                                                                                                                        
 [OK] Your dashboard class has been successfully generated.
```

Modification du `config/packages/security.yaml` pour empêcher l'accès à la route `/admin` si l'utilisateur n'a pas le rôle `ROLE_ADMIN` (dans ce cas, il sera redirigé vers la page de connexion)
```bash
    access_control:
        - { path: ^/compte, roles: ROLE_USER }
        - { path: ^/admin, roles: ROLE_ADMIN }
```
Lié l'entité `Utilisateur` à `EasyAdmin` en créant un `CRUD Controllers`:

*https://symfony.com/bundles/EasyAdminBundle/current/crud.html*

`symfony console make:admin:crud`

```bash
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
```bash
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
```bash
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
```bash
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
```bash
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

```bash
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
```bash
yield MenuItem::linkToCrud('Médecins', 'fas fa-stethoscope', Medecin::class);
```
Configuration du Crud Controller de l'entité `Medecin` dans le tableau de bord `MedecinCrudController.php`:
```bash
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
```bash
public function __toString(): string
    {
        return $this->specialite;
    }
```
 


