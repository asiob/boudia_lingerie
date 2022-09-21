<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920195943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD couleur_id INT NOT NULL, DROP couleur');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C31BA576 ON produit (couleur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C31BA576');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP INDEX IDX_29A5EC27C31BA576 ON produit');
        $this->addSql('ALTER TABLE produit ADD couleur VARCHAR(100) NOT NULL, DROP couleur_id');
    }
}
