<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005144843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE taille DROP type_id');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(100) NOT NULL, ADD prenom VARCHAR(100) NOT NULL, ADD telephone VARCHAR(100) NOT NULL, ADD adresse VARCHAR(100) NOT NULL, ADD code_postal VARCHAR(100) NOT NULL, ADD ville VARCHAR(100) NOT NULL, ADD pays VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE taille ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone, DROP adresse, DROP code_postal, DROP ville, DROP pays');
    }
}
