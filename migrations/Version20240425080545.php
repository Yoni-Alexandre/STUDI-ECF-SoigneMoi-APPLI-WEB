<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425080545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD medecin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur ADD CONSTRAINT FK_8885528E4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('CREATE INDEX IDX_8885528E4F31A84 ON rendez_vous_utilisateur (medecin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP FOREIGN KEY FK_8885528E4F31A84');
        $this->addSql('DROP INDEX IDX_8885528E4F31A84 ON rendez_vous_utilisateur');
        $this->addSql('ALTER TABLE rendez_vous_utilisateur DROP medecin_id');
    }
}
