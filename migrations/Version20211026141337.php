<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026141337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cookie ADD id_site_id INT NOT NULL');
        $this->addSql('ALTER TABLE cookie ADD CONSTRAINT FK_8AE0BA662820BF36 FOREIGN KEY (id_site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_8AE0BA662820BF36 ON cookie (id_site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cookie DROP FOREIGN KEY FK_8AE0BA662820BF36');
        $this->addSql('DROP INDEX IDX_8AE0BA662820BF36 ON cookie');
    }
}