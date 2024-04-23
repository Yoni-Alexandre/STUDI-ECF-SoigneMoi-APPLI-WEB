<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
