<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503080451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528E2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite_medecin (id)');
        $this->addSql('CREATE INDEX IDX_8885528E2195E0F0 ON rendez_vous_utilisateur (specialite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528E2195E0F0');
        $this->addSql('DROP INDEX IDX_8885528E2195E0F0 ON rendez_vous_utilisateur');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP specialite_id');
    }
}
