<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531074923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, medecin_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, prescription_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, date DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8F91ABF04F31A84 (medecin_id), INDEX IDX_8F91ABF0FB88E14F (utilisateur_id), INDEX IDX_8F91ABF093DB413D (prescription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, specialite_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_1BDA53C6FB88E14F (utilisateur_id), INDEX IDX_1BDA53C62195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, posologie LONGTEXT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_medecin (id INT AUTO_INCREMENT NOT NULL, medecin_id INT DEFAULT NULL, date DATETIME NOT NULL, nombre_patients_max INT NOT NULL, INDEX IDX_C6B70E2D4F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, medicament_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, date_debut_traitement DATE NOT NULL, date_fin_traitement DATE NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_1FBFB8D9AB0D61F7 (medicament_id), INDEX IDX_1FBFB8D94F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_utilisateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, specialite_id INT DEFAULT NULL, planning_medecin_id INT DEFAULT NULL, date DATETIME NOT NULL, motif_de_sejour LONGTEXT NOT NULL, status VARCHAR(255) DEFAULT NULL, nombre_places_reservees INT NOT NULL, INDEX IDX_8885528EFB88E14F (utilisateur_id), INDEX IDX_8885528E4F31A84 (medecin_id), INDEX IDX_8885528E2195E0F0 (specialite_id), INDEX IDX_8885528E9D521BE4 (planning_medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite_medecin (id INT AUTO_INCREMENT NOT NULL, specialite VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, medecins_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse_postale VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B3DA00906 (medecins_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF04F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF093DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C62195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite_medecin (id)');
        $this->addSql('ALTER TABLE planning_medecin ADD CONSTRAINT FK_C6B70E2D4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D94F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528E4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528E2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite_medecin (id)');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528E9D521BE4 FOREIGN KEY (planning_medecin_id) REFERENCES planning_medecin (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DA00906 FOREIGN KEY (medecins_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF04F31A84');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0FB88E14F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF093DB413D');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6FB88E14F');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C62195E0F0');
        $this->addSql('ALTER TABLE planning_medecin DROP FOREIGN KEY FK_C6B70E2D4F31A84');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9AB0D61F7');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D94F31A84');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528EFB88E14F');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528E4F31A84');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528E2195E0F0');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528E9D521BE4');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DA00906');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE planning_medecin');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE rendez_vous_utilisateur');
        $this->addSql('DROP TABLE specialite_medecin');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
