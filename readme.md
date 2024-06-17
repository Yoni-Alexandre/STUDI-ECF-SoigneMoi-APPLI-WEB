# Procédure de Connexion WEB et MOBILE

## Application WEB

### Web
Pour se connecter à l’application Web, se rendre sur https://soignemoi.neoliaweb.fr/connexion et utiliser les identifiants ci-dessous :
- Email : ***********@neoliaweb.fr
- Mot de passe : ********

### Local
Pour installer en local l’application Web, il faut tout d’abord avoir installé les prérequis suivants :
- PHP 8.2
- Symfony CLI
- Composer
- MySQL
- Serveur Web Local (Laragon par exemple)

Ensuite, aller sur un terminal et exécuter les commandes ci-dessous :
```bash
git clone https://github.com/Yoni-Alexandre/STUDI-ECF-SoigneMoi-APPLI-WEB.git
```
```bash
cd STUDI-ECF-SoigneMoi-APPLI-WEB
```
```bash
composer install
```
```bash
symfony console doctrine:database:create
```
```bash
cd migrations
```
```bash
rm *.php
```
```bash
cd ..
```
```bash
symfony console make:migration
```
```bash
symfony.exe console doctrine:migrations:migrate
```
```bash
php bin/console doctrine:fixtures:load
```
```bash
php bin/console lexik:jwt:generate-keypair
```
```bash
symfony serve -d
```

### Test unitaire
Pour créer un utilisateur pour le test unitaire, modifier le fichier `FormulaireInscriptionUtilisateurTest.php`.
Execution du test unitaire avec la commande :
```bash
php bin/phpunit
```

## Application Mobile
Pour la version Mobile de l’application SoigneMoi, utiliser les identifiants ci-dessous :
- Email : ***********@neoliaweb.fr
- Mot de passe : ********

l'application mobile, est directement connectée à l'application WEB 

Prérequis :
- Windows PowerShell (Pour Windows)
- Git
- Android Studio (avec l’émulateur de téléphone configuré)
- Visual Studio Code avec les extensions Flutter
- Le Flutter SDK

Ensuite, démarrer Android Studio puis l’émulateur de téléphone et aller sur un terminal pour exécuter les commandes ci-dessous :
```bash
git clone https://github.com/Yoni-Alexandre/studi_ecf_soignemoi_appli_mobile.git
```
```bash
cd studi_ecf_soignemoi_appli_mobile
```
```bash
flutter run
```

## Postman pour l’API

### Authentification (POST)
Pour l’authentification en POST :
https://soignemoi.neoliaweb.fr/auth
- Format JSON :
```json
{
  "email": "***********@neoliaweb.fr",
  "password": "********"
}
```

### Avis (GET)
Pour obtenir les informations d’un avis en particulier en GET :
http://soignemoi.neoliaweb.fr/apiMedecins/avis/11

### Collection Avis (GET)
Pour obtenir les informations en collection avec GET :
http://soignemoi.neoliaweb.fr/apiMedecins/avis

### Ecrire (POST)
Pour écrire les informations avec la méthode POST :
http://soignemoi.neoliaweb.fr/apiMedecins/avis
