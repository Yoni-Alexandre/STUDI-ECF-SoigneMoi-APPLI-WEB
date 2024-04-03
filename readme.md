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

## Création du Projet SoigneMoi avec Symfony 7

1. Création du Projet :
   ```bash
   symfony new SoigneMoi --version="7.0.*" --webapp
   ```

2. Installation des Dépendances avec **Composer** :
   ```bash
   cd SoigneMoi
   composer install
   ```

##  Modification du ficher .env pour connecter la base de données
```bash
DATABASE_URL="mysql://root@127.0.0.1:3306/soignemoi?serverVersion=8.0.32&charset=utf8mb4"
```
##  Création de la base de données
```bash
symfony console doctrine:database:create
```
## Création des Entités

#### Entité Utilisateur (sécurisé)

```bash
symfony console make:user

The name of the security user class (e.g. User) [User]:
 > Utilisateur

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
    -  Champ : ```date_fin_traitement```, type : ```datetime```, null en BDD : ```non```

#### PlanningMedecin
- Nom de l'entité : PlanningMedecin
- Champs de l'entité :
    - Champ : ```date```, type : ```datetime```, null en BDD : ```non```
    - Champ : ```nombre_patients_max```, type : ```integer```, longueur : ```255```, null en BDD : ```non```

## Définition des Relations

#### Création des relations entre les Entités
```bash 
symfony console make:entity
```
#### Exemple  pour Sejour et Utilisateur:
```bash 
Class name of the entity to create or update (e.g. BraveKangaroo):
 > Sejour

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > utilisateur

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Utilisateur

What type of relationship is this?
 ------------ --------------------------------------------------------------------------
  Type         Description
 ------------ --------------------------------------------------------------------------
  ManyToOne    Each Sejour relates to (has) one Utilisateur.
               Each Utilisateur can relate to (can have) many Sejour objects.

  OneToMany    Each Sejour can relate to (can have) many Utilisateur objects.
               Each Utilisateur relates to (has) one Sejour.

  ManyToMany   Each Sejour can relate to (can have) many Utilisateur objects.
               Each Utilisateur can also relate to (can also have) many Sejour objects.

  OneToOne     Each Sejour relates to (has) exactly one Utilisateur.
               Each Utilisateur also relates to (has) exactly one Sejour.
 ------------ --------------------------------------------------------------------------

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Sejour.utilisateur property allowed to be null (nullable)? (yes/no) [yes]:
 >yes

 Do you want to add a new property to Utilisateur so that you can access/update Sejour objects from it - e.g. $utilisateur->getSejours()? (yes/no) [yes]:
 >yes

 A new property will also be added to the Utilisateur class so that you can access the related Sejour objects from it.

 New field name inside Utilisateur [sejours]:
 >sejours

 updated: src/Entity/Sejour.php
 updated: src/Entity/Utilisateur.php
```
#
- Relation entre `Sejour` et `Utilisateur` : **ManyToOne**
- Chaque `Sejour` est lié à (possède) un `Utilisateur`.
- Chaque `Utilisateur` peut être lié à (peut avoir) plusieurs objets `Sejour`.
    - Nom de l'entité : Sejour
        - Champs de l'entité : `utilisateur`, type : `relation (ManyToOne)`, classe cible : `Utilisateur`
#
-   Relation entre `Sejour` et `Medecin` : **ManyToOne**
- Chaque `Sejour` est lié à (possède) un `Medecin`.
- Chaque `Medecin` peut être lié à (peut avoir) plusieurs objets `Sejour`.
    - Nom de l'entité : Sejour
        - Champs de l'entité : `medecin`, type : `relation (ManyToOne)`, classe cible : `Medecin`
#
-   Relation entre `Medecin` et `Utilisateur` : **ManyToOne**
- Chaque `Medecin` est lié à (possède) un `Utilisateur`.
- Chaque `Utilisateur` peut être lié à (peut avoir) plusieurs objets `Medecin`.
    - Nom de l'entité : Medecin
        - Champs de l'entité : `utilisateur`, type : `relation (ManyToOne)`, classe cible : `Utilisateur`
#
-   Relation entre `Prescription` et `Medecin` : **ManyToOne**
- Chaque `Prescription` est lié à (possède) un `Medecin`.
- Chaque `Medecin` peut être lié à (peut avoir) plusieurs objets `Prescription`.
    - Nom de l'entité : Prescription
        - Champs de l'entité : `medecin`, type : `relation (ManyToOne)`, classe cible : `Medecin`
#
-   Relation entre `Medicament` et `Prescription` : **ManyToOne**
- Chaque `Medicament` est lié à (possède) un `Prescription`.
- Chaque `Prescription` peut être lié à (peut avoir) plusieurs objets `Medicament`.
    - Nom de l'entité : Medicament
        - Champs de l'entité : `prescription`, type : `relation (ManyToOne)`, classe cible : `Prescription`
#
-   Relation entre `PlanningMedecin` et `Medecin` : **ManyToOne**
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

 created: src/Controller/InscriptionController.php
 created: templates/inscription/index.html.twig

  Success! 
```
## Création du formulaires des utilisateurs (patients)
#### Formulaire de création de comptes pour les utilisateurs
```bash
symfony console make:form

The name of the form class (e.g. GentlePuppyType):
 > InscriptionUtilisateurType

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Utilisateur
Utilisateur

 created: src/Form/InscriptionUtilisateurType.php
           
  Success! 
```
#### Lier le contrôleur `InscriptionController`au  formulaire `InscriptionUtilisateurType`
```bash
$utilisateur = new Utilisateur();  
$form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);  
  
return $this->render('inscription/index.html.twig', [  
    'titre_inscription' => 'Inscription',  
    'form' => $form->createView(),
```
Pour utiliser **Bootstrap** pour l'affichage graphique des formulaires, modifier le fichier ```config/packages/twig.yaml```
et ajouter :
```bash
twig:   
  form_themes: ['bootstrap_5_layout.html.twig']
```
#### Création du formulaire (Exemple du formulaire d'inscription)
```bash
public function buildForm(FormBuilderInterface $builder, array $options): void  
{  
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
    ;  
}
```
Dans le fichier de la vue associée au formulaire
```bash
{{ form_start(form) }}  
{{ form_row(form.nom) }}  
{{ form_row(form.prenom) }}  
{{ form_row(form.adresse_postale) }}  
{{ form_row(form.email) }}  
{{ form_row(form.password) }}  
{{ form_row(form.submit) }}  
{{ form_end(form) }}
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
  $entityManager->flush();  
}
```
Exemple complet:
```bash
public function index(Request $request, EntityManagerInterface $entityManager): Response  
{  
    // Création d'un nouvel utilisateur  
  $utilisateur = new Utilisateur();  
    // Création du formulaire et liaison avec l'objet utilisateur  
  $form = $this->createForm(InscriptionUtilisateurType::class, $utilisateur);  
  
    $form->handleRequest($request);  
  
    if ($form->isSubmitted() && $form->isValid()){  
        // persister les données dans la table utilisateur  
  $entityManager->persist($utilisateur);  
        // exécuter la requête  
  $entityManager->flush();  
    }  
  
    return $this->render('inscription/index.html.twig', [  
        'titre_inscription' => 'Inscription',  
        'formulaireUtilisateurs' => $form->createView(),  
    ]);  
}
```


