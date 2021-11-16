<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211115125032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom CHANGE title title VARCHAR(255) DEFAULT \'Titre de votre bannière\' NOT NULL, CHANGE message message VARCHAR(1000) DEFAULT \'Nous utilisons des cookies pour personnaliser la navigation de l\'\'utilisateur ainsi que les publicités affichées sur le site. Si vous cliquez sur “accepter”, vous autorisez la collecte d’information concernant votre navigation.\' NOT NULL, CHANGE color color VARCHAR(255) DEFAULT \'light\' NOT NULL, CHANGE layout layout INT DEFAULT 1 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE layout layout INT NOT NULL');
    }
}
