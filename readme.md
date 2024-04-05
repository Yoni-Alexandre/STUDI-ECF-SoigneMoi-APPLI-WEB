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

- Yoni-Alexandre Brault : Développeur / Designer


## Création du Projet SoigneMoi avec Symfony 7

1. Création du Projet :
   ```bash  
symfony new SoigneMoi --version="7.0.*" --webapp ```
2. Installation des Dépendances avec **Composer** :
   ```bash  
cd SoigneMoi  composer install ```
## Modification du ficher .env pour connecter la base de données
```bash  
DATABASE_URL="mysql://root@127.0.0.1:3306/soignemoi?serverVersion=8.0.32&charset=utf8mb4"  
```  
## Création de la base de données
```bash  
symfony console doctrine:database:create```  
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
 > yes```  
- Champs de l'entité :  
  - Les champs **email** et **password** sont créés lors de la création du **make:user**  
 - nom : `nom`, type : `string`, longueur : `255`  
 - prenom : `prenom`, type : `string`, longueur : `255`  
 - adresse_postale : `adresse_postale`, type : `text`  
  
#### Commande de création des entités  
```bash symfony console make:entity```  
  
#### Entité Sejour  
- Nom de l'entité : Sejour  
- Champs de l'entité :  
  - Champ : ```date_debut```, type : ```datetime```, null en BDD : ```non```  
 - Champ : ```date_fin```, type : ```datetime```, null en BDD : ```non```  
 - Champ : ```motif```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
  
#### Entité Medecin  
- Nom de l'entité : Medecin  
- Champs de l'entité :  
  - Champ : ```nom```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```prenom```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```specialite```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```matricule```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
  
#### Entité Prescription  
- Nom de l'entité : Prescription  
- Champs de l'entité :  
  - Champ : ```libelle```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```date```, type : ```datetime```, null en BDD : ```non```  
 - Champ : ```description```, type : ```text```, null en BDD : ```non```  
 - Champ : ```nom_prenom_medecin```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
  
  
#### Entité Medicament  
- Nom de l'entité : Medicament  
- Champs de l'entité :  
  - Champ : ```nom```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```posologie```, type : ```string```, longueur : ```255```, null en BDD : ```non```  
 - Champ : ```date_debut_traitement```, type : ```datetime```, null en BDD : ```non```  
 - Champ : ```date_fin_traitement```, type : ```datetime```, null en BDD : ```non```  
  
#### PlanningMedecin  
- Nom de l'entité : PlanningMedecin  
- Champs de l'entité :  
  - Champ : ```date```, type : ```datetime```, null en BDD : ```non```  
 - Champ : ```nombre_patients_max```, type : ```integer```, longueur : ```255```, null en BDD : ```non```  
  
## Définition des Relations  
  
#### Création des relations entre les Entités  
```bash symfony console make:entity```  
#### Exemple  pour Sejour et Utilisateur:  
```bash Class name of the entity to create or update (e.g. BraveKangaroo):  
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
 updated: src/Entity/Sejour.php updated: src/Entity/Utilisateur.php```  
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
symfony console make:migration```  
#### Exécution de la migration  
```bash  
symfony console doctrine:migrations:migrate```  
## Création du contrôleur d'inscription des utilisateurs (patients)  
```bash  
symfony console make:controller  
Choose a name for your controller class (e.g. OrangeChefController):  
 > InscriptionController  
 created: src/Controller/InscriptionController.php  created: templates/inscription/index.html.twig  
  Success! ```  
## Création du formulaire des utilisateurs (patients)  
#### Formulaire de création de comptes pour les utilisateurs  
```bash  
symfony console make:form  
The name of the form class (e.g. GentlePuppyType):  
 > InscriptionUtilisateurType  
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):  
 > UtilisateurUtilisateur  
  
 created: src/Form/InscriptionUtilisateurType.php  Success! ```  
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
  form_themes: ['bootstrap_5_layout.html.twig']```  
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

